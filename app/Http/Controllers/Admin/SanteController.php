<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeclarationSante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        DB::beginTransaction();

        try {

            // 🔎 Récupération
            $sante = DeclarationSante::findOrFail($id);

            // ✅ Validation (important)
            $validated = $request->validate([
                'taille' => 'nullable|numeric',
                'poids' => 'nullable|numeric',
                'tensionMin' => 'nullable|string',
                'tensionMax' => 'nullable|string',

                'smoking' => 'nullable|in:Oui,Non',
                'alcohol' => 'nullable|in:Oui,Non',
                'sport' => 'nullable|string|max:255',

                'diabetes' => 'nullable|in:Oui,Non',
                'hypertension' => 'nullable|in:Oui,Non',
                'sickleCell' => 'nullable|in:Oui,Non',
                'kidneyFailure' => 'nullable|in:Oui,Non',
                'stroke' => 'nullable|in:Oui,Non',
                'cancer' => 'nullable|in:Oui,Non',

                'treatment' => 'nullable|string',
                'interChirugiale' => 'nullable|string|max:255',
            ]);

            // ✅ Update
            $sante->update([
                'taille' => $validated['taille'] ?? null,
                'poids' => $validated['poids'] ?? null,
                'tensionMin' => $validated['tensionMin'] ?? null,
                'tensionMax' => $validated['tensionMax'] ?? null,

                'smoking' => $validated['smoking'] ?? null,
                'alcohol' => $validated['alcohol'] ?? null,
                'sport' => $validated['sport'] ?? null,

                'diabetes' => $validated['diabetes'] ?? 'Non',
                'hypertension' => $validated['hypertension'] ?? 'Non',
                'sickleCell' => $validated['sickleCell'] ?? 'Non',
                'kidneyFailure' => $validated['kidneyFailure'] ?? 'Non',
                'stroke' => $validated['stroke'] ?? 'Non',
                'cancer' => $validated['cancer'] ?? 'Non',

                'treatment' => $validated['treatment'] ?? null,
                'interChirugiale' => $validated['interChirugiale'] ?? null,
            ]);

            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => 'back',
                'message' => 'Modifié avec succès !',
                'code' => 200
            ]);

        } catch (\Throwable $th) {

            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'urlback' => 'back',
                'message' => $th->getMessage(),
                'code' => 500
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
