<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ProduitService
{

    public function getProduits()
    {
        return Cache::remember('produits_api', 3600, function () {

            $response = Http::timeout(60)
                ->get(config('services.base_url_api') . '/enov/produits');

            if ($response->successful()) {
                return $response->json();
            }

            return [];
        });
    }


    public function getProduitByCode($codeProduit)
    {
        $produits = $this->getProduits();

        return collect($produits)->first(function ($produit) use ($codeProduit) {
            return $produit['CodeProduit'] == $codeProduit;
        });
    }

    public function getFormulesProduit($codeProduit)
    {
        $response = Http::timeout(60)
            ->withHeaders([
                'Authorization' => config('services.enov_api_token'),
                'Accept' => 'application/json'
            ])
            ->post(config('services.base_url_api') . '/enov/get-formul-product', [
                'CodeProduit' => $codeProduit
            ]);

        if ($response->successful()) {
            return $response->json();
        }

        return [];
    }
    public function getSingleFormulesByCode($codeProduit, $codeFormule)
    {
        $response = Http::timeout(60)
            ->withHeaders([
                'Authorization' => config('services.enov_api_token'),
                'Accept' => 'application/json'
            ])
            ->post(config('services.base_url_api') . '/enov/get-formul-product', [
                'CodeProduit' => $codeProduit
            ]);

        if ($response->successful()) {
            $data = $response->json();
            $formules = $data['getProduitByFormule'] ?? [];
            return collect($formules)->firstWhere('CodeProduitFormule', $codeFormule);
        }

        return null;
    }
}

