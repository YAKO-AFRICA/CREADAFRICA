<?php

namespace App\Http\Controllers\Admin;

use App\Models\TblDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Fpdi;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }





    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $idContrat = $request->contrat;
            $destinationPath = base_path(env('UPLOADS_PATH'));

            // =========================
            // 🔥 1. BULLETIN (fusion PDF)
            // =========================
            if ($request->hasFile('bulletin')) {

                $pdf = new Fpdi();

                foreach ($request->file('bulletin') as $file) {

                    // sécuriser : uniquement PDF
                    if ($file->getClientOriginalExtension() !== 'pdf') {
                        continue;
                    }

                    $pageCount = $pdf->setSourceFile($file->getPathname());

                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $tpl = $pdf->importPage($pageNo);
                        $pdf->addPage();
                        $pdf->useTemplate($tpl);
                    }
                }

                $fileName = $idContrat . '-bulletin-' . time() . '.pdf';
                $fullPath = $destinationPath . '/' . $fileName;

                $pdf->Output($fullPath, 'F');

                TblDocument::create([
                    'codecontrat' => $idContrat,
                    'filename' => $fileName,
                    'libelle' => 'Bulletin de souscription',
                    'saisiele' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                    'source' => "ES",
                ]);
            }

            // =========================
            // 📁 2. AUTRES DOCUMENTS
            // =========================
            $this->saveFiles($request, 'cni', 'Pièce justificatif d\'identité (CNI)', $idContrat, $destinationPath);
            $this->saveFiles($request, 'rib', 'RIB', $idContrat, $destinationPath);
            $this->saveFiles($request, 'reference_paiement', 'Réference de paiement', $idContrat, $destinationPath);
            $this->saveFiles($request, 'signature', 'Signature', $idContrat, $destinationPath);
            $this->saveFiles($request, 'photo', 'Photo', $idContrat, $destinationPath);
            $this->saveFiles($request, 'autres', 'Autres pièces', $idContrat, $destinationPath);

            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Enregistré avec succès!",
                'code' => 200,
            ]);

        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'urlback' => 'back',
                'message' => "Erreur système! " . $th->getMessage(),
                'code' => 500,
            ]);
        }
    }

    /**
     * 🔁 Fonction réutilisable
     */
    private function saveFiles($request, $inputName, $libelle, $idContrat, $destinationPath)
    {
        if ($request->hasFile($inputName)) {

            foreach ($request->file($inputName) as $file) {

                $fileName = $idContrat . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move($destinationPath, $fileName);

                TblDocument::create([
                    'codecontrat' => $idContrat,
                    'filename' => $fileName,
                    'libelle' => $libelle,
                    'saisiele' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                    'source' => "ES",
                ]);
            }
        }
    }
    public function storeDocPret(Request $request)
    {
        try {
        DB::beginTransaction();
        $idPret = $request->pret;
        $libelles = $request->input('libelles');
        $files = $request->file('files');

        foreach ($files as $key => $file) {
            $imageName = $idPret . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();

            // $destinationPath = public_path('documents/files');
            $destinationPath = base_path(env('UPLOADS_PATH'));
            $file->move($destinationPath, $imageName);
            $filePath = '../public_html/testenovapi/public/uploads/' . $imageName;

            // \dd($libelles[$key]);

            TblDocument::create([
                'codecontrat' => $idPret,
                'filename' => $imageName,
                'libelle' => $libelles[$key],
                'saisiele' => now(),
                'saisiepar' => Auth::user()->membre->idmembre,
                'source' => "ES",
            ]);
        }

        DB::commit();

        return response()->json([
            'type' => 'success',
            'urlback' => 'back',
            'message' => "Enregistré avec succès!",
            'code' => 200,
        ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => 'back',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        DB::beginTransaction();

        TblDocument::find($id)->delete();

        DB::commit();

        return response()->json([
            'type' => 'success',
            'urlback' => 'back',
            'message' => "Supprimé avec succès!",
            'code' => 200,
        ]);
    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'type' => 'error',
            'urlback' => 'back',
            'message' => "Erreur système! $th",
            'code' => 500,
        ]);
    }
    }
}
