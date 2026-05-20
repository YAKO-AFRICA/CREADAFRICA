<?php

namespace App\Http\Controllers\Admin;

use PDF;

use Carbon\Carbon;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Pret;
use App\Models\Membre;
use App\Models\Assurer;
use App\Models\Contrat;
use App\Models\Product;
use setasign\Fpdi\Fpdi;
use App\Models\Adherent;
use App\Models\TblVille;
use App\Models\TblAgence;
use App\Models\Profession;
use App\Models\TblSociete;
use App\Models\TblDocument;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use App\Models\TblProfession;
use App\Models\AssureGarantie;
use App\Models\ProduitGarantie;
use App\Models\DeclarationSante;
use App\Models\TblSecteurActivite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EpretController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user()->idmembre;
        $prets = Contrat::where('saisiepar', $user)->where('CodeProduit', 'loyemp')->orderBy('saisiele', 'desc')->get();

        return view('epret.index', compact('prets'));
    }

    public function simulateur()
    {

        return view('epret.simulateur');
    }

    public function storeSimulation(Request $request)
    {

        log::info($request->all());
        // Stockez les données dans la session
        session(['simulationData' => $request->all()]);

        return response()->json(['message' => 'Simulation data stored successfully']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::where('CodeProduit', 'loyemp')->first();

        $productGarantie = ProduitGarantie::where('CodeProduit','loyemp')->get();
        $villes =  TblVille::select('libelleVillle')->get();
        $professions =  Profession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  TblAgence::select('NOM_LONG')->get();

        $simulationData = session('simulationData', []);



        return view('epret.create', compact('product', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences','simulationData'));
    }


    // public function saveBeneficiarySession(Request $request)
    // {
    //     session()->forget('beneficiary');
    //     $data = $request->only(['nom', 'prenom', 'dateNaissance', 'lieuNaissance', 'capital', 'lieuResidence', 'numPhone', 'emailBenef']);
    //     session(['beneficiary' => $data]);

    //     return response()->json(['success' => true, 'message' => 'Bénéficiaire sauvegardé dans la session']);
    // }


    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {

            DB::beginTransaction();
            try {

                log::info($request->all());
                $key = now()->format('YmdHis');


                $sexe = $request->civilite === "Monsieur" ? "M" : "F";
                $datenaissance = Carbon::parse($request->datenaissance)->format('Y-m-d H:i:s');

                $idAdherent = Adherent::max('id') + 1;


                $idPret = Pret::max('id') + 1;
                $idContrat = Contrat::max('id') + 1;
                $idBenef = Beneficiaire::max('id') + 1;
                $idGarantie = AssureGarantie::max('id') + 1;
                $idGarantieTwo = $idGarantie + 1;
                $idAssurer = Assurer::max('id') + 1;

                $Adherent = Adherent::create([
                    'id' => $idAdherent,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $datenaissance,
                    'lieunaissance' => $request->lieunaissance,
                    'sexe' => $sexe,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidence,
                    'profession' => $request->profession,
                    'employeur' => $request->employeur,
                    'pays' => $request->pays,
                    'estmigre' => 0,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'telephone1' => $request->telephone1,
                    'mobile' => $request->mobile,
                    'codemembre' => 0,
                    'mobile1' => $request->mobile1,
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                    'refcontratsource' => $request->refcontratsource,
                    'cleintegration' => $key,
                    'id_maj' => $request->id_maj,
                    'connexe' => $request->connexe,
                    'contratconnexe' => $request->contratconnexe,
                    'capitalconnexe' => $request->capitalconnexe
                ]);

                Log::info("Adherent created with ID: " . $Adherent);

                $assurers = Assurer::create([
                    'id' => $idAssurer,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $datenaissance,
                    'codecontrat' => $idContrat,
                    'codeadherent' => $idAdherent,
                    'lieunaissance' => $request->lieunaissance,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece ?? null,
                    'lieuresidence' => $request->lieuresidence ?? null,
                    // 'filiation' => $assure['lienParente'],
                    'mobile' => $request->mobile ?? null,
                    'estmigre' => 0 ?? null,
                    'email' => $request->email ?? null,
                    'sexe' => $sexe,
                    'saisieLe' => now(),
                    'saisiepar' => auth::user()->membre->idmembre,
                    'cleintegration' => $key
                ]);

                Log::info("Assurer created with ID: " . $assurers);


                if($request->primeObseque != null){
                    $disableYako = 0;
                }else{
                    $disableYako = 1;
                }
                $commonData = [
                    'codeassure' => $idAssurer,
                    'codecontrat' => $idContrat,
                    'estmigre' => 0,
                    'refcontratsource' => $idPret,
                    'codeoperation' => 00,
                    'cleintegration' => $key,
                ];

                $garanties = [
                    [
                        'id' => $idGarantie,
                        'codeproduitgarantie' => "DECES",
                        'idproduitparantie' => 59,
                        'monlibelle' => 'DECES',
                        'prime' => 5000,
                        'primeaccesoire' => 0,
                        'primetotal' => 5000,
                        'type' => "Mixte",
                        'capitalgarantie' => "500000",
                    ],
                    [
                        'id' => $idGarantieTwo,
                        'codeproduitgarantie' => "YKEMP",
                        'idproduitparantie' => 153,
                        'monlibelle' => 'Yako Emprunteur',
                        'prime' => 0,
                        'primeaccesoire' => 0,
                        'primetotal' => 0,
                        'type' => "Mixte",
                        'capitalgarantie' => "0",
                    ],
                ];

                foreach ($garanties as $garantie) {
                    AssureGarantie::create(array_merge($garantie, $commonData))->save();
                }

                Log::info("AssureGarantie created with ID: " , $garanties);

                $typepret = $request->typPret;

                // Vérifie si l'utilisateur a sélectionné "Autre"
                if ($typepret === "" && $request->typPretAutre) {
                    $typepret = $request->typPretAutre;
                }


                $newPret = Pret::create([
                    'id' => $idPret,
                    'typepret' => $request->typPret,
                    'effetgarantie' => $request->loanDateMiseEnPlace,
                    'montantpret' => $request->montant,
                    'dateecheancedebut' => $request->firstDateEcheance,
                    'dateecheancefin' => $request->lasLoanDateRembour,

                    'remboursement' => $request->periodiciterRembou,
                    'numerocompte' => $request->numerocompte,

                    'txprimeunique' => $request->txprimeunique,
                    'txsurprime' => $request->txsurprime,
                    'txprimedef' => $request->txprimedef,

                    'prime' => $request->prime,

                    'primeht' => $request->prime,

                    'montantsurprime' => $request->montantsurprime,
                    'fraisaccessoires' => $request->fraisaccessoires,
                    'fraismedicaux' => $request->fraismedicaux,
                    'duree' => $request->dureeSimulation,

                    'taille' => $request->taille,
                    'poids' => $request->poids,

                    'partenaire' => Auth::user()->membre->codepartenaire,
                    'periodicite' => $request->periodiciterPrime,
                    'tension' => $request->tensionMin,
                    'fumezvous' => $request->smoking,
                    'nbcigarettejour' => $request->nbcigarettejour,
                    'buvezvous' => $request->alcohol,
                    'distraction' => $request->distractions,
                    'estinfirme' => $request->accident,

                    'saisiele' => now(),
                    'saisiepar' => Auth::user()->idmembre,
                    'codeagent' => Auth::user()->membre->codeagent,
                    'nomagent' => Auth::user()->membre->nom.''.Auth::user()->membre->prenom,
                    'encotation' => 0,
                    'etat' => 1,
                    'codeadherent' => $idAdherent,
                    'estmigre' => 0,
                    'primeobseque' => $request->primeObseque,
                    'capital' => $request->montant,
                    // 'beneficiaireaudeces' => $request->beneficiaireaudeces,
                    'personneressource' => $request->personneressource,
                    'contactpersonneressource' => $request->contactpersonneressource,
                    'personneressource2' => $request->personneressource2,
                    'contactpersonneressource2' => $request->contactpersonneressource2,
                    // 'rib' => $request->rib,
                    'estsportif' => $request->sport,
                    'sportpratique' => $request->typeSport,
                    'primerisque' => $request->prime,
                    'primeemprunteur' => $request->primeEmprunteur,
                    'numeroclient' => $idAdherent,
                    'typeadherent' => 'Individuel',
                    // 'nbadherent' => $request->nbadherent,
                    'unableyako' => 0,
                    'naturepret' => $request->naturePret,
                ]);

                $contrat = Contrat::create([
                    'id'                 => $idContrat,
                    'dateeffet'          => $request->loanDateMiseEnPlace,
                    'modepaiement'       => "ADF",
                    'organisme'          => 'AFC',
                    'prime'              => $request->prime,
                    'capital'            => $request->montant,
                    'fraisadhesion'      => 3000,
                    'etape'              => 1,
                    'numerocompte'       => $request->numerocompte,
                    'saisiele'           => now(),
                    'saisiepar'          => Auth::user()->idmembre,
                    'estMigre'           => 0,
                    'estpaye'            => 0,
                    'codeadherent'       => $idAdherent,
                    'codeconseiller'     => Auth::user()->membre->codeagent,
                    'nomagent'           => Auth::user()->membre->nom.''.Auth::user()->membre->prenom,
                    'duree'              => $request->dureeSimulation,
                    'periodicite'        => 'U',
                    'codeproduit'        => 'loyemp',
                    'primepricipale'     => $request->prime,
                    'libelleproduit'     => 'loyale emprunteur AFC',
                    // 'transmisle'         => now(),
                    'branche'            => 'BANKASS',
                    'partenaire'         => 'AFC',
                    'pretconnexe'        => $idPret,
                    'nomsouscipteur'     => $Adherent->prenom.' '.$Adherent->nom,
                    'cleintegration' => $key,
                    'personneressource' => $request->personneressource,
                    'contactpersonneressource' => $request->contactpersonneressource,
                    'personneressource2' => $request->personneressource2,
                    'contactpersonneressource2' => $request->contactpersonneressource2,
                    'Formule' => 'LOYEMP_CAC',
                ]);

                Log::info("Contrat created with newPretnewPretnewPretnewPret: " . $newPret);


                $idBenefPart = Beneficiaire::max('id') + 1;


                Beneficiaire::create([
                    'id' => $idBenefPart,
                    'nom' => "AFC",
                    'prenom' => "AFC",
                    'codecontrat' => $idContrat,
                    'codeadherent' => $idAdherent,
                    // 'datenaissance' => $datenaissanceBenef,
                    // 'codecontrat' => $idPret,
                    'codepret' => $idPret,
                    // 'codeadherent' => $idAdherent,
                    // 'lieunaissance' => $benefData['lieuNaissance'],
                    'lieuresidence' => "SIEGE",
                    // 'mobile' => $benefData['numPhone'],
                    // 'email' => $benefData['emailBenef'],
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                ])->save();



                $beneficiairesPret = Session::get('beneficiairesPret', []);

                Log::info("Beneficiaires reçus:", $beneficiairesPret);


                // Log::info("Beneficiaires reçus:", $beneficiairesPret);
                if ($request->primeObseque != null && $beneficiairesPret != null) {

                    foreach ($beneficiairesPret as $beneficiaire) {
                        $idBenefAdd = Beneficiaire::max('id') + 1;
                        $datenaissanceBenef = Carbon::parse($beneficiaire['date_naissance'])->format('Y-m-d H:i:s');
                        Beneficiaire::create([
                            'id' => $idBenefAdd,
                            'codepret' => $idPret,
                            'nom' => $beneficiaire['nom'],
                            'prenom' => $beneficiaire['prenom'],
                            'datenaissance' => $datenaissanceBenef,
                            'codecontrat' => $idContrat,
                            'codeadherent' => $idAdherent,
                            'lieunaissance' => $beneficiaire['lieu_naissance'],
                            'telephone' => $beneficiaire['telephone'],
                            'email' => $beneficiaire['email'],
                            'capital' => $beneficiaire['capital'],
                        ])->save();
                    }


                    Session::forget('beneficiairesPret');
                }

                $santeData = DeclarationSante::create([
                    'taille' => $request->input('taille'),
                    'poids' => $request->input('poids'),
                    'tensionMin' => $request->input('tensionMin'),
                    'tensionMax' => $request->input('tensionMax'),

                    'smoking' => $request->input('smoking', 'Non'),
                    'alcohol' => $request->input('alcohol', 'Non'),
                    'sport' => $request->input('sport', 'Non'),
                    // 'typeSport' => $request->input('typeSport'),

                    // 'distractions' => $request->input('distractions'),

                    'accident' => $request->input('accident', 'Non'),
                    'treatment' => $request->input('treatment', 'Non'),
                    'transSang' => $request->input('transSang', 'Non'),
                    'interChirugiale' => $request->input('interChirugiale', 'Non'),
                    'prochaineInterChirugiale' => $request->input('prochaineInterChirugiale', 'Non'),

                    'diabetes' => $request->input('diabetes', 'Non'),
                    'hypertension' => $request->input('hypertension', 'Non'),
                    'sickleCell' => $request->input('sickleCell', 'Non'),
                    'liverCirrhosis' => $request->input('liverCirrhosis', 'Non'),
                    'lungDisease' => $request->input('lungDisease', 'Non'),
                    'cancer' => $request->input('cancer', 'Non'),
                    'anemia' => $request->input('anemia', 'Non'),
                    'kidneyFailure' => $request->input('kidneyFailure', 'Non'),
                    'stroke' => $request->input('stroke', 'Non'),

                    'codePret' => $idPret,
                    'codeContrat' => $idContrat,

                    'created_at' => now(),
                ]);

                // Log::info($newPret);

                DB::commit();

                $bulletinData = $this->generateBulletinPret($idPret);


                return response()->json([
                    'type' => 'success',
                    'url' => $bulletinData['file_url'],
                    'urlback' => '',
                    // 'message' => "Enregistrer avec success !",
                    'code' => 200,
                ]);

            } catch (\Throwable $th) {
                DB::rollBack();

                Log::error("Erreur système: ", ['error' => $th]);
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur système! $th",
                    'code' => 500,
                ]);
            }
        }

        private function generateBulletinPret($idPret)
        {
            try {
                $pret = Pret::where('id', $idPret)->with('sante')->first();
                Log::info("pret trouver " . $pret);
                if (!$pret) {
                    return response()->json(['success' => false, 'message' => 'Prêt non trouvé.'], 404);
                }

                // Options pour DomPDF
                $options = new Options();
                $options->set('isRemoteEnabled', true);

                // Génération du bulletin PDF temporaire
                $pdf = PDF::loadView('epret.components.bulletin.adhesion', ['pret' => $pret]);

                // Création du dossier si nécessaire
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                // Sauvegarde temporaire du bulletin
                $tempBulletinPath = $bulletinDir . 'temp_bulletin_' . $pret->id . '_' . now()->timestamp . '.pdf';
                $pdf->save($tempBulletinPath);

                // Chemin vers le fichier CGU
                $cguFilePath = public_path('root/cgu/CguLoyemp.pdf');
                if (!file_exists($cguFilePath)) {
                    Log::error("Le fichier CGU est introuvable : " . $cguFilePath);
                    return [
                        'success' => false,
                        'message' => 'Fichier CGU introuvable.',
                    ];
                }

                // Initialiser FPDI pour fusionner les fichiers
                $finalPdf = new Fpdi();

                // Ajouter le bulletin au PDF final
                $bulletinPageCount = $finalPdf->setSourceFile($tempBulletinPath);
                for ($pageNo = 1; $pageNo <= $bulletinPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $bulletinTplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($bulletinTplIdx);
                }

                // Ajouter les pages du fichier CGU
                $cguPageCount = $finalPdf->setSourceFile($cguFilePath);
                for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $cguTplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($cguTplIdx);
                }

                // Nom final du fichier fusionné
                $finalBulletinPath = $bulletinDir . 'adhesion_bulletin_' . $pret->id . '.pdf';
                $finalPdf->Output($finalBulletinPath, 'F');

                // Supprimer le fichier temporaire du bulletin après fusion
                if (file_exists($tempBulletinPath)) {
                    unlink($tempBulletinPath);
                }

                // Générer l'URL du fichier
                $fileUrl = asset("documents/bulletin/adhesion_bulletin_{$pret->id}.pdf");

                // Log de l'URL générée
                Log::info("Bulletin généré avec succès : " . $fileUrl);

                DB::commit();

                return [
                    'success' => true,
                    'file_url' => $fileUrl,
                ];
            } catch (\Exception $e) {
                // Enregistrer une erreur dans les logs
                Log::error("Erreur lors de la génération du bulletin : " . $e->getMessage());

                return [
                    'success' => false,
                    'message' => $e->getMessage(),
                ];
            }
        }

        public function printBulletin(Request $request, $idPret)

        {
            try {
                // Récupérer les données nécessaires au bulletin
                $pret = Pret::where('id', $idPret)->with('sante')->first();
                if (!$pret) {
                    return response()->json(['success' => false, 'message' => 'Prêt non trouvé.'], 404);
                }

                // Options pour DomPDF
                $options = new Options();
                $options->set('isRemoteEnabled', true);

                // Génération du bulletin PDF temporaire
                $pdf = PDF::loadView('epret.components.bulletin.adhesion', ['pret' => $pret]);

                // Création du dossier si nécessaire
                $bulletinDir = public_path('documents/bulletin/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                // Sauvegarde temporaire du bulletin
                $tempBulletinPath = $bulletinDir . 'temp_bulletin_' . $pret->id . '_' . now()->timestamp . '.pdf';
                $pdf->save($tempBulletinPath);

                // Chemin vers le fichier CGU
                $cguFilePath = public_path('root/cgu/CguLoyemp.pdf');
                if (!file_exists($cguFilePath)) {
                    Log::error("Le fichier CGU est introuvable : " . $cguFilePath);
                    return response()->json(['success' => false, 'message' => 'Fichier CGU introuvable.'], 404);
                }

                // Initialiser FPDI pour fusionner les fichiers
                $finalPdf = new Fpdi();
                $finalPdf->AddPage();

                // Ajouter le bulletin au PDF final
                $bulletinPageCount = $finalPdf->setSourceFile($tempBulletinPath);
                if ($bulletinPageCount > 0) {
                    $bulletinTplIdx = $finalPdf->importPage(1);
                    $finalPdf->useTemplate($bulletinTplIdx);
                } else {
                    Log::error("Erreur lors de l'importation du bulletin : Aucune page trouvée.");
                    return response()->json(['success' => false, 'message' => 'Erreur dans le fichier bulletin.'], 500);
                }

                // Ajouter les pages du fichier CGU
                $cguPageCount = $finalPdf->setSourceFile($cguFilePath);
                for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                    $finalPdf->AddPage();
                    $cguTplIdx = $finalPdf->importPage($pageNo);
                    $finalPdf->useTemplate($cguTplIdx);
                }

                // Nom final du fichier fusionné
                $finalBulletinPath = $bulletinDir . 'adhesion_bulletin_' . $pret->id . '.pdf';
                $finalPdf->Output($finalBulletinPath, 'F');

                // Supprimer le fichier temporaire du bulletin après fusion
                if (file_exists($tempBulletinPath)) {
                    unlink($tempBulletinPath);
                }

                return response()->make(file_get_contents($finalBulletinPath), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($finalBulletinPath) . '"'
                ]);

            } catch (\Exception $e) {
                Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e->getMessage()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur s\'est produite lors de la génération du bulletin.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }



        public function generateBu()
        {
            try {

                // $pret = Pret::where('id', '1637')->with('sante', 'beneficiaires')->first();
                $contrat = Contrat::where('id', '46')->first();


                // Chargement de la vue avec les données
                $pdf = PDF::loadView('productions.components.bullettin.assurcompte', ['contrat' => $contrat]);

                // Option 1 : Retourner directement le PDF pour téléchargement
                return $pdf->stream('bulletin_proposition.pdf');

            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => $e->getMessage(),
                ];
            }
        }



        public function addDocDefaud(Request $request)
{
    try {
        DB::beginTransaction();

        $pret = Pret::where('saisiepar', Auth::user()->idmembre)
            ->latest('saisiele')
            ->first();

        $contrat = Contrat::where('saisiepar', Auth::user()->idmembre)
            ->latest('saisiele')
            ->first();

        abort_if(!$pret || !$contrat, 404, 'Prêt ou contrat introuvable.');

        $idPret     = $pret->id;
        $idContrat  = $contrat->id;

        $labelMap = [
            'bulletin'  => 'Bulletin de souscription',
            'cni'       => 'Pièce justificatif d\'identité (CNI)',
            'rib'       => 'RIB',
            'signature' => 'Signature',
            'photo'     => 'Photo',
            'autres'    => 'Autres pièces',
        ];

        $destinationPath = base_path(env('UPLOADS_PATH'));
        $uploadsPrefix   = config('filesystems.uploads_path');

        $allFiles = $request->file('files', []);  // ['bulletin' => [...], 'cni' => [...], ...]

        foreach ($allFiles as $groupKey => $groupFiles) {
            // groupFiles peut être null si aucun fichier uploadé pour ce groupe
            if (empty($groupFiles)) {
                continue;
            }

            $libelle = $labelMap[$groupKey] ?? $groupKey;

            foreach ($groupFiles as $file) {
                if (!$file->isValid()) {
                    continue;
                }

                $imageName = $idPret . '-' . now()->timestamp . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move($destinationPath, $imageName);

                TblDocument::create([
                    'codecontrat' => $idContrat,
                    'codePret'    => $idPret,
                    'filename'    => $imageName,
                    'libelle'     => $libelle,
                    'saisiele'    => now(),
                    'saisiepar'   => Auth::user()->membre->idmembre,
                    'source'      => 'ES',
                ]);
            }
        }

        DB::commit();

        return response()->json([
            'type'    => 'success',
            'urlback' => route('prod.show', $idContrat),
            'message' => 'Enregistré avec succès!',
            'code'    => 200,
        ]);

    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'type'    => 'error',
            'urlback' => 'back',
            'message' => 'Erreur système! ' . $th->getMessage(),
            'code'    => 500,
        ]);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        set_time_limit(300);
        $productGarantie = ProduitGarantie::where('CodeProduit','loyemp')->get();

        $pret = Pret::where('id',$id)->firstOrFail();

        // dd($pret);

        return view('epret.show', compact('pret', 'productGarantie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $product = Product::where('CodeProduit', 'loyemp')->first();

        $pret = Pret::where('id', $id)->with('adherent', 'assures', 'beneficiaires')->first();
        $productGarantie = ProduitGarantie::where('CodeProduit',$pret->codeproduit)->get();
        $villes =  TblVille::get();
        $professions =  TblProfession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  TblAgence::select('NOM_LONG')->get();
        return view('epret.edit', compact('pret', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences','product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        try {

            $newPret = Pret::where('id', $id)->update([

                'naturepret' => $request->naturePret,
                'typepret' => $request->typPret,
                'effetgarantie' => $request->loanDateMiseEnPlace,
                'dateecheancefin' => $request->lasLoanDateRembour,
                'periodicite' => $request->periodiciterPrime,
                'remboursement' => $request->periodiciterRembou,
                'dateecheancedebut' => $request->firstDateEcheance,
                // 'surprime' => $request->surprime,

            ]);


            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => '',
                'message' => "enregistrer avec success !",
                'code' => 200,
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Erreur système: ", ['error' => $th]);
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }


    public function transmettrePret($id)
    {
        DB::beginTransaction();
        try {
                $pret = Pret::find($id);

                if ($pret) {


                    $idAdherent = $pret->codeadherent;
                    $idContrat = Contrat::max('id') + 1;

                    $adherent = Adherent::find($idAdherent);
                    $pretDoc = TblDocument::where('codePret', $id)->get();

                    $benef = Beneficiaire::where('codepret', $id)->get();

                    $assures = Assurer::where('codeadherent', $idAdherent)->get();


                        $contrat = Contrat::create([
                            'id'                 => $idContrat,
                            'dateeffet'          => $pret->effetgarantie,
                            'modepaiement'       => "SOLDE",
                            'organisme'          => 'AFC',
                            'prime'              => $pret->prime,
                            'capital'            => $pret->montantpret,
                            'fraisadhesion'      => $pret->primerisque,
                            'etape'              => 2,
                            'numerocompte'       => $pret->numerocompte,
                            'saisiele'           => $pret->saisiele,
                            'saisiepar'          => $pret->saisiepar,
                            'estMigre'           => 0,
                            'estpaye'            => 0,
                            'codeadherent'       => $idAdherent,
                            'codeconseiller'     => $pret->codeagent,
                            'nomagent'           => $pret->nomagent,
                            'duree'              => $pret->duree,
                            'periodicite'        => 'U',
                            'codeproduit'        => 'loyemp',
                            'primepricipale'     => $pret->prime,
                            'libelleproduit'     => 'loyale emprunteur AFC',
                            'transmisle'         => $pret->saisiele,
                            'branche'            => 'BANKASS',
                            'partenaire'         => 'AFC',
                            'refcontratsource'   => $id,
                            'pretconnexe'        => $id,
                            'nomsouscipteur'     => $adherent->prenom.' '.$adherent->nom,
                        ]);

                        foreach ($benef as $beneficiaire) {
                            $beneficiaire->update([
                                'codecontrat' => $idContrat,
                                'codeadherent' => $idAdherent,
                            ]);
                        }

                        foreach ($pretDoc as $doc) {
                            $doc->update([
                                'codecontrat' => $idContrat,
                            ]);
                        }

                        foreach ($assures as $assure) {
                            $assure->update([
                                'codecontrat' => $idContrat,
                            ]);
                        }

                        $pret->update(
                            [
                                'etat' => 2,
                                'estmigre' => 1
                            ]
                        );


                    DB::commit();

                    return response()->json([
                        'type' => 'success',
                        'urlback' => \route('epret.index'),
                        'message' => "Transmis avec succès!",
                        'code' => 200,
                    ]);
                } else {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => 'back',
                        'message' => "Erreur erreur de transmission !",
                        'code' => 200,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try
        {
            $pret = Pret::find($id);
            if ($pret) {

                $pret->delete();

                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Suppression effectuée avec succès!",
                    'code' => 200,
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


    public function convertPretToContrat()
    {

        Log::info("demarrage convertion");

        DB::beginTransaction();
        try {

            $prets = Pret::where('partenaire', 'AFC')->get();

            // Log::info("prets " . $prets);

            if ($prets->isEmpty()) {
                return response()->json([
                    'type' => 'info',
                    'message' => "Aucun prêt à convertir",
                    'code' => 200,
                ]);
            }

            $convertedCount = 0;
            $errors = [];

            foreach ($prets as $pret) {
                try {
                    // Vérification supplémentaire pour éviter les doublons
                    $contratExists = Contrat::where('pretconnexe', $pret->id)->exists();
                    if ($contratExists) {
                        Log::info("Prêt ID {$pret->id} deja converti");
                        $errors[] = "Prêt ID {$pret->id} déjà converti";
                        continue;
                    }

                    $idAdherent = $pret->codeadherent;
                    $idContrat = Contrat::max('id') + 1;

                    $adherent = Adherent::find($idAdherent);
                    if (!$adherent) {
                        $errors[] = "Adherent non trouvé pour le prêt ID {$pret->id}";
                        continue;
                    }

                    $pretDoc = TblDocument::where('codePret', $pret->id)->get();
                    $benef = Beneficiaire::where('codepret', $pret->id)->get();
                    $assures = Assurer::where('codeadherent', $idAdherent)->get();

                    $contrat = Contrat::create([
                        'id'                 => $idContrat,
                        'dateeffet'          => $pret->effetgarantie,
                        'modepaiement'       => "ADF",
                        'organisme'          => 'AFC',
                        'prime'              => $pret->prime,
                        'capital'            => $pret->montantpret,
                        'fraisadhesion'      => '3000',
                        'etape'              => 1,
                        'numerocompte'       => $pret->numerocompte,
                        'saisiele'           => $pret->saisiele,
                        'saisiepar'          => $pret->saisiepar,
                        'estMigre'           => 0,
                        'estpaye'            => 0,
                        'codeadherent'       => $idAdherent,
                        'codeconseiller'     => $pret->codeagent,
                        'nomagent'           => $pret->nomagent,
                        'duree'              => $pret->duree,
                        'periodicite'        => 'U',
                        'codeproduit'        => 'loyemp',
                        'primepricipale'     => $pret->prime,
                        'libelleproduit'     => 'loyale emprunteur AFC',
                        'transmisle'         => $pret->saisiele,
                        'branche'            => 'BANKASS',
                        'partenaire'         => 'AFC',
                        'refcontratsource'   => $pret->id,
                        'pretconnexe'        => $pret->id,
                        'nomsouscipteur'     => $adherent->prenom.' '.$adherent->nom,
                    ]);

                    // Mise à jour des bénéficiaires
                    foreach ($benef as $beneficiaire) {
                        $beneficiaire->update([
                            'codecontrat' => $idContrat,
                            'codeadherent' => $idAdherent,
                        ]);
                    }

                    // Mise à jour des documents
                    foreach ($pretDoc as $doc) {
                        $doc->update([
                            'codecontrat' => $idContrat,
                        ]);
                    }

                    // Mise à jour des assurés
                    foreach ($assures as $assure) {
                        $assure->update([
                            'codecontrat' => $idContrat,
                        ]);
                    }

                    // Mise à jour du prêt
                    $pret->update([
                        'etat' => 2,
                        'estmigre' => 1,
                    ]);

                    Log::info("Prêts ID {$pret->id} converti avec успех contrat ID {$contrat->id}");

                    $convertedCount++;

                } catch (\Exception $e) {
                    $errors[] = "Erreur conversion prêt ID {$pret->id}: " . $e->getMessage();
                }
            }

            DB::commit();

            Log::info("Conversion de {$convertedCount} prets effectuée");

            $message = "$convertedCount contrat(s) créé(s) avec succès";
            if (!empty($errors)) {
                $message .= ". Erreurs: " . implode(", ", $errors);
            }

            return response()->json([
                'type' => $convertedCount > 0 ? 'success' : 'error',
                'urlback' => "",
                'message' => $message,
                'code' => 200,
                'converted_count' => $convertedCount,
                'errors' => $errors,
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système: " . $th->getMessage(),
                'code' => 500,
            ]);
        }
    }

    public function migratePret()
    {
        $prets = Pret::where('partenaire', 'AFC')->get();
        $nbrPretAConvert = $prets->count();
        return view('epret.conversion-liste', compact('prets', 'nbrPretAConvert'));
    }
}


