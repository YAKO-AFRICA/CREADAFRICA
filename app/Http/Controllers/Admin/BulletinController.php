<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Contrat;
use App\Models\Membre;
use App\Models\Product;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd; // Utilisez Imagick si disponible
use BaconQrCode\Renderer\Image\SvgImageBackEnd; // Alternative SVG
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use setasign\Fpdi\Fpdi;

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function demoBulletin(request $request)
     {
        try {

            $contrat = Contrat::where('id', 89)->first();

            // Chargement de la vue avec les données
            $pdf = Pdf::loadView('productions.components.bullettin.ykeBulletin', [
                'contrat' => $contrat
            ]);

            // Option 1 : Retourner directement le PDF pour téléchargement
            return $pdf->stream('bulletin_adhesion.pdf');

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function printBulletin()
    {
        // $prestation = TblPrestation::where('id', $id)->first();
        // Génération de QR Code en base64

        // $pdf = Pdf::loadView('productions.components.bullettin.ykeBulletin');
        // $pdf = Pdf::loadView('productions.components.bullettin.basicBulletin');
        // $pdf = Pdf::loadView('productions.components.bullettin.pfaINDbulletin');
        $pdf = Pdf::loadView('productions.components.bullettin.LprevoBulletin');
        // $pdf = Pdf::loadView('productions.components.bullettin.Doihoobulletintest');
        // $pdf = Pdf::loadView('productions.components.bullettin.CadenceEduPlusbulletintest');

        $fileName = 'cadencebulletin.pdf';
        return $pdf->stream($fileName);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contrat = Contrat::find($id);
        return view('productions.components.bullettin.basicBulletin', compact('contrat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   


    public function generate(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            $contrat = Contrat::find($id);

            $pret = $contrat->pret;

            $renderer = new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            );

            // $qrContent = "Signature Electronique\n";
            // $qrContent .= "Date: " . $contrat->saisiele . "\n";
            // $qrContent .= "Réf. Contrat: " . $contrat->id;

            $qrContent = url("production/showQrCode/" . $contrat->id);
            
            $writer = new Writer($renderer);
        
            $qrCodeImage = $writer->writeString($qrContent);
            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeImage);


            $imageUrl = env('SIGN_API') . "api/get-signature/" . $id . "/E-SOUSCRIPTION";
            $imageSrc = null;
            try {
                $response = Http::timeout(5)->get($imageUrl);

                if ($response->successful()) {
                    $data = $response->json();

                    // Vérifie si 'error' existe et est à true
                    if (isset($data['error']) && $data['error'] === true) {
                        Log::info('Signature non trouvée pour le contrat ID: ' . $contrat->id);
                    } else {
                    
                        $imageData = $response->body(); 
                        $base64Image = base64_encode($imageData);
                        $imageSrc = 'data:image/png;base64,' . $base64Image;
                    }
                } else {
                    Log::error('Erreur HTTP lors de l\'appel de l\'API signature. Code de retour : ' , $response->json());
                }
            } catch (\Exception $e) {
                Log::error('Exception lors de la récupération de la signature : ' . $e->getMessage());
            }

            if($contrat)
            {
                // Options pour Dompdf
                $options = new Options();
                $options->set('isRemoteEnabled', true);
            
                // Générer le bulletin PDF avec Dompdf
                if($contrat->codeproduit == "loyemp"){
                    $pdf = Pdf::loadView('epret.components.bulletin.adhesion', [
                        'pret' => $contrat->pret,
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc
                    ]);
                    $cguFile = public_path('root/cgu/CguLoyemp.pdf');

                }else if($contrat->codeproduit == "YKE_2018"){
                    $pdf = PDF::loadView('productions.components.bullettin.ykeBulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc
                    ]);
                    $cguFile = public_path('root/cgu/cg_yke.pdf');

                }else if($contrat->codeproduit == "YKE_2008"){
                    $pdf = PDF::loadView('productions.components.bullettin.ykeBulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc
                    ]);
                    $cguFile = public_path('root/cgu/cg_yke.pdf');

                }else if($contrat->codeproduit == "CADENCE")
                {
                    $pdf = PDF::loadView('productions.components.bullettin.Cadencebulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc
                    ]);
                    $cguFile = public_path('root/cgu/cadenceCgu.pdf');
                    
                }else if($contrat->codeproduit == "PFA_IND"){
                    $pdf = PDF::loadView('productions.components.bullettin.pfaINDbulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc
                    ]);
                    $cguFile = public_path('root/cgu/cg_yke.pdf');
                }else if($contrat->codeproduit == "DOIHOO"){
                    $pdf = PDF::loadView('productions.components.bullettin.Doihoobulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc
                    ]);
                    $cguFile = public_path('root/cgu/doihoo_cgu.pdf');
                }else if($contrat->codeproduit == "CAD_EDUCPLUS"){
                    $pdf = PDF::loadView('productions.components.bullettin.CadenceEduPlusbulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc,
                    ]);
                    $cguFile = public_path('root/cgu/CADENCEpLUS.pdf');
                    
                }else if($contrat->codeproduit == "LPREVO")
                {
                    $pdf = PDF::loadView('productions.components.bullettin.LprevoBulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc,
                    ]);
                    $cguFile = public_path('root/cgu/CGLPREVO.pdf');

                }else{

                    $pdf = PDF::loadView('productions.components.bullettin.basicBulletin', [
                        'contrat' => $contrat,
                        'qrCodeBase64' => $qrCodeBase64,
                        'imageSrc' => $imageSrc
                    ]);
                    $cguFile = public_path('root/cgu/CGPLanggnant.pdf');
                }
            
                // Répertoire pour enregistrer les fichiers temporaires
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }
            
                $bulletinFileName = $bulletinDir . 'temp_bulletin_' . $contrat->id . '.pdf';
                $pdf->save($bulletinFileName);
            
                // Fusionner les PDF avec FPDI
                $finalPdf = new Fpdi();
            
                // Ajouter toutes les pages du bulletin
                $bulletinPageCount = $finalPdf->setSourceFile($bulletinFileName);
                for ($pageNo = 1; $pageNo <= $bulletinPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $tplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($tplIdx);
                }
            
                // Ajouter toutes les pages du fichier CGU
                $cguPageCount = $finalPdf->setSourceFile($cguFile);
                for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $tplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($tplIdx);
                }
            
                // Nom final du fichier
                $finalFileName = $bulletinDir . $contrat->codeproduit .'_bulletin_'. $contrat->id . '.pdf';
            
                // Enregistrer le PDF final
                $finalPdf->Output($finalFileName, 'F');
            
                // Supprimer le fichier temporaire du bulletin
                unlink($bulletinFileName);

                DB::commit();
            
                // Retourner le PDF final en tant que réponse
                return response()->file($finalFileName, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($finalFileName) . '"'
                ]);
            } else {
                DB::rollBack();
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la generation du bullettin!",
                    'code' => 500,
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    public function dowloadYkeBulletinEtCGU($produit)
    {
        try {

            $idContrat = Contrat::max('id') + 1;
            $userMembre = Membre::where('idmembre', Auth::user()->idmembre)->first();
            $infoProduct = Product::where('CodeProduit', $produit)->first();

            if($produit == "DOIHOO"){
                $prefix = '68111105104111111';
            } else if ($produit == "CAD_EDUCPLUS") {
                $prefix = '679710069100117';
            } else if ($produit == "YKE_2018" || $produit == "YKE_2008") {
                $prefix = '8901001011692018';
            } else if ($produit == "CADENCE") {
                $prefix = '679710010111099';
            } else if ($produit == "LPREVO") {
                $prefix = '65838301000110';
            } else {
                $prefix = '679710069100117';
            }

            // On récupère le nombre de contrats existants avec ce préfixe et ce produit
            $increment = Contrat::where('numBullettin', 'like', $prefix . '%')
                ->where('codeproduit', $produit)
                ->count() + 1;

            do {
                $numBullettin = $prefix . $increment;
                $numExist = Contrat::where('numBullettin', $numBullettin)->exists();
                $increment++;
            } while ($numExist);

            $contrat = Contrat::create([
                'id' => $idContrat,
                'codeproduit' => $produit,
                'libelleproduit' => $infoProduct->MonLibelle ?? '',
                'nomagent' => $userMembre->nom . ' ' . $userMembre->prenom,
                'branche' => $userMembre->branche,
                'partenaire' => $userMembre->partenaire ?? '',
                'cleintegration' => now()->format('YmdHis'),
                'numBullettin' => $numBullettin,
                'etape' => 0, // saisie inachevée impression bulletrin
                'saisiele' => now(),
                'saisiepar' => Auth::user()->idmembre
            ]);

            // Options pour DomPDF
            $options = new Options();
            $options->set('isRemoteEnabled', true);

            // Générer le PDF du bulletin

            if($produit == "YKE_2018"){
                $pdf = PDF::loadView('productions.components.bullettin.ykeBulletinBlanc', ['contrat' => $contrat])
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);

                // Répertoire et fichiers
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                $bulletinTempFile = $bulletinDir . 'temp_bulletin.pdf';
                $finalPdfFile = $bulletinDir . 'Bulletin_Blank.pdf';
                $cguFile = public_path('root/cgu/cg_yke.pdf');

            }else if($produit == "CAD_EDUCPLUS"){

                $pdf = PDF::loadView('productions.components.bullettin.CadenceEduPlusbulletinBlanc',['contrat' => $contrat] )
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);

                // Répertoire et fichiers
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                $bulletinTempFile = $bulletinDir . 'temp_bulletin.pdf';
                $finalPdfFile = $bulletinDir . 'Bulletin_Blank.pdf';
                $cguFile = public_path('root/cgu/CADENCEpLUS.pdf');
                
            } else if($produit == "DOIHOO"){
                $pdf = PDF::loadView('productions.components.bullettin.DoihoobulletinBlanc',['contrat' => $contrat] )
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);

                // Répertoire et fichiers
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                $bulletinTempFile = $bulletinDir . 'temp_bulletin.pdf';
                $finalPdfFile = $bulletinDir . 'Bulletin_Blank.pdf';
                $cguFile = public_path('root/cgu/doihoo_cgu.pdf');
            }else if($produit == "LPREVO"){
                $pdf = PDF::loadView('productions.components.bullettin.LprevoBulletinBlanc', ['contrat' => $contrat] )
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);

                // Répertoire et fichiers
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                $bulletinTempFile = $bulletinDir . 'temp_bulletin.pdf';
                $finalPdfFile = $bulletinDir . 'Bulletin_Blank.pdf';
                $cguFile = public_path('root/cgu/CGLPREVO.pdf');
            }else {
                 $pdf = PDF::loadView('productions.components.bullettin.ykeBulletinBlanc' )
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);

                // Répertoire et fichiers
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                $bulletinTempFile = $bulletinDir . 'temp_bulletin.pdf';
                $finalPdfFile = $bulletinDir . 'Bulletin_Blank.pdf';
                $cguFile = public_path('root/cgu/cg_yke.pdf');
            }
            
            // Sauvegarde du bulletin
            $pdf->save($bulletinTempFile);

            // Fusion avec FPDI
            $fpdi = new Fpdi();

            $bulletinPageCount = $fpdi->setSourceFile($bulletinTempFile);
            for ($pageNo = 1; $pageNo <= $bulletinPageCount; $pageNo++) {
                $fpdi->AddPage();
                $tplIdx = $fpdi->importPage($pageNo);
                $fpdi->useTemplate($tplIdx);
            }

            // Ajouter pages CGU
            $pageCount = $fpdi->setSourceFile($cguFile);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $fpdi->AddPage();
                $tplIdx = $fpdi->importPage($pageNo);
                $fpdi->useTemplate($tplIdx);
            }

            // Sauvegarde finale
            $fpdi->Output($finalPdfFile, 'F');

            // Supprimer temporaire
            if (file_exists($bulletinTempFile)) {
                unlink($bulletinTempFile);
            }

            // Retourner le PDF final
            return response()->file($finalPdfFile, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($finalPdfFile) . '"'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'message' => 'Erreur lors de la génération du PDF : ' . $th->getMessage(),
                'code' => 500,
            ]);
        }
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
        //
    }
}
