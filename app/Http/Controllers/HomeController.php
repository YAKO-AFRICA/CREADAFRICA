<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('calculHomeData');
    }


    // $data = Cache::remember("dashboard_data_$userId", now()->addMinutes(30), function () use ($userId) {
    public function calculHomeData()
    {
        $userId = auth()->user()->idmembre;
        $year = now()->year;

        $contratsYear = Contrat::where('saisiepar', $userId)
            ->whereYear('saisiele', $year);

        $contratsTransmisYear = Contrat::where('saisiepar', $userId)
            ->whereYear('saisiele', $year)->whereNotNull('transmisle')->count();

        /* ========================
        COUNTS RAPIDES
        ========================*/
        $counts = Contrat::selectRaw("
                COUNT(*) as total,
                SUM(etape = 2) as transmis_actif,
                SUM(etape = 3) as acceptes,
                SUM(etape = 4) as rejetes
            ")
            ->where('saisiepar', $userId)
            ->whereYear('saisiele', $year)
            ->first();

        /* ========================
        PRIME
        ========================*/
        $primeYearCumule = (clone $contratsYear)
            ->where('etape', 3)
            ->sum('primepricipale');

        $primeMonthCumule = (clone $contratsYear)
            ->where('etape', 3)
            ->whereMonth('accepterle', now()->month)
            ->sum('primepricipale');

        /* ========================
        CHART SEMAINE (GROUP BY)
        ========================*/
        $weekData = Contrat::selectRaw("
                DATE(transmisle) as date,
                COUNT(*) as total
            ")
            ->where('saisiepar', $userId)
            ->whereBetween('transmisle', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('date')
            ->pluck('total','date');

        $weekAccept = Contrat::selectRaw("
                DATE(accepterle) as date,
                COUNT(*) as total
            ")
            ->where('saisiepar', $userId)
            ->where('etape',3)
            ->whereBetween('accepterle', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('date')
            ->pluck('total','date');

        $chartWeekTransmis = [];
        $chartWeekAcceptes = [];

        for($i=0;$i<7;$i++){
            $day = now()->startOfWeek()->addDays($i)->format('Y-m-d');
            $chartWeekTransmis[] = $weekData[$day] ?? 0;
            $chartWeekAcceptes[] = $weekAccept[$day] ?? 0;
        }

        /* ========================
        CHART MOIS (GROUP BY)
        ========================*/
        $monthData = Contrat::selectRaw("
            MONTH(transmisle) as month,
            COUNT(*) as total")
            ->where('saisiepar', $userId)
            ->whereYear('transmisle', now()->year)
            ->groupBy('month')
            ->pluck('total','month');

        $monthAccept = Contrat::selectRaw("
                MONTH(accepterle) as month,
                COUNT(*) as total
            ")
            ->where('saisiepar', $userId)
            ->where('etape',3)
            ->whereYear('accepterle', now()->year)
            ->groupBy('month')
            ->pluck('total','month');

        $chartMonthTransmis = [];
        $chartMonthAcceptes = [];

        for($i=1;$i<=12;$i++){
            $chartMonthTransmis[] = $monthData[$i] ?? 0;
            $chartMonthAcceptes[] = $monthAccept[$i] ?? 0;
        }

        /* ========================
        TAUX
        ========================*/
        $transmis = $contratsTransmisYear;
        $acceptes = $counts->acceptes;
        $rejetes = $counts->rejetes;

        $tauxAcceptPercent = $transmis > 0 ? round(($acceptes/$transmis)*100,2) : 0;
        $tauxRejetPercent = $transmis > 0 ? round(($rejetes/$transmis)*100,2) : 0;


        // calcule des produit les plus vendu dans l'annee avec cumule prime
        $produitsVendusYear = (clone $contratsYear)
            ->whereNotNull('transmisle')
            ->whereYear('transmisle', now()->year)
            ->groupBy('codeproduit', 'libelleproduit')
            ->selectRaw("
                codeproduit,
                libelleproduit,
                COUNT(*) as total,
                SUM(primepricipale) as primeCumule
            ")
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();


        $produitVendusMonth = (clone $contratsYear)
            ->whereNotNull('transmisle')
            ->whereMonth('accepterle', now()->month)
            ->whereYear('accepterle', now()->year)
            ->groupBy('codeproduit', 'libelleproduit')
            ->selectRaw("
                codeproduit,
                libelleproduit,
                COUNT(*) as total,
                SUM(primepricipale) as primeCumule
            ")
            ->orderBy('total','desc')
            ->limit(5)
            ->get();

        return response()->json([
            'contratsYear' => $counts->total,
            'transmisActifYear' => $counts->transmis_actif,
            'transmisYear' => $contratsTransmisYear,
            'accepteYear' => $acceptes,
            'rejetesYear' => $rejetes,
            'tauxAcceptPercent' => $tauxAcceptPercent,
            'tauxRejetPercent' => $tauxRejetPercent,
            'primeYearCumule' => $primeYearCumule,
            'primeMonthCumule' => $primeMonthCumule,
            'chart' => [
                'week'=>[
                    'labels'=>['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'],
                    'transmis'=>$chartWeekTransmis,
                    'acceptes'=>$chartWeekAcceptes
                ],
                'month'=>[
                    'labels'=> ['Janv','Fev','Mars','Avr','Mai','Juin','Juil','Aout','Sept','Oct','Nov','Dec'],
                    'transmis'=>$chartMonthTransmis,
                    'acceptes'=>$chartMonthAcceptes
                ]
            ],
            'produits' => [
                'year' => $produitsVendusYear,
                'month' => $produitVendusMonth
            ],
        ]);
    }

    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['error' => 'Utilisateur non connecté'], 401);
    //     }

    //         // All Contrat by user
    //         $user = Auth::user();
    //         $myAllContrats = Contrat::where('saisiepar', $user->idmembre)->get();

    //         // mes saisie de la journée
    //         $myDayContrats = Contrat::where('saisiepar', $user->idmembre)
    //         ->whereBetween('saisiele', [
    //             now()->startOfDay(),
    //             now()->endOfDay(),
    //         ])->get();

    //         $myContratsMonth = Contrat::where('saisiepar', $user->idmembre)
    //         ->whereBetween('saisiele', [
    //             now()->startOfMonth(),
    //             now()->endOfMonth(), 
    //         ])->get();

    //         // contrat en saisie par encore transmis etape 1
    //         $myAllContratEnSaisie = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 1])->get();

    //         $myAllContratEnSaisieMonth = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 1])
    //         ->whereBetween('saisiele', [
    //             now()->startOfMonth(),
    //             now()->endOfMonth(), 
    //         ])->get();

    //         // contrat saisie et transmis etape 2
    //         $myAllContratTransmis = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 2])->get();
    //         $myAllContratTransmisMonth = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 2])
    //         ->whereBetween('saisiele', [
    //             now()->startOfMonth(),
    //             now()->endOfMonth(), 
    //         ])->get();

    //         // contrat migrer etape 3
    //         $myAllContratMigrer = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 3])->get();
    //         $myAllContratMigrerMonth = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 3])
    //         ->whereBetween('saisiele', [
    //             now()->startOfMonth(),
    //             now()->endOfMonth(), 
    //         ])->get();

    //         // contrat rejetter etape 4
    //         $myAllContratRejetter = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 4])->get();
    //         $myAllContratRejetterMonth = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 4])
    //         ->whereBetween('saisiele', [
    //             now()->startOfMonth(),
    //             now()->endOfMonth(), 
    //         ])->get();


    //         // etat de souscription annuel

    //         $year = now()->year;

    //         // total de production sur une année 

    //         $contratsAnnuel = Contrat::where('saisiepar', $user->idmembre)
    //             ->whereYear('saisiele', $year)
    //             ->get();

    //         // total de production accepter sur une année
    //         $contratsAccepterAnnuel = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 3])
    //             ->whereYear('saisiele', $year)
    //             ->get();

    //             // Nombre total de contrats
    //         $totalContrats = $contratsAnnuel->where('etape',2)->count();
    //         // rejet sur l'année en cours
    //         $totalRejetPerYears = $contratsAnnuel->where('etape',4)->count();

    //         // Nombre de contrats acceptés
    //         $totalAccepter = $contratsAccepterAnnuel->count();


    //         // Calcul du taux d'acceptation
    //         $tauxAcceptation = ($totalContrats > 0) ? ($totalAccepter / $totalContrats) * 100 : 0;

    //         // Groupement par mois pour les contrats transmis (étape 2)
    //         $contratsTransmisParMois = Contrat::where('saisiepar', $user->idmembre)
    //             ->where('etape', 2)
    //             ->whereYear('saisiele', $year)
    //             ->selectRaw('MONTH(saisiele) as mois, COUNT(*) as total')
    //             ->groupBy('mois')
    //             ->pluck('total', 'mois');

    //         // Groupement par mois pour les contrats migrés (étape 3)
    //         $contratsMigrerParMois = Contrat::where('saisiepar', $user->idmembre)
    //             ->where('etape', 3)
    //             ->whereYear('saisiele', $year)
    //             ->selectRaw('MONTH(saisiele) as mois, COUNT(*) as total')
    //             ->groupBy('mois')
    //             ->pluck('total', 'mois');

    //         // Générer un tableau de 12 mois avec des valeurs par défaut à 0
    //         $dataTransmis = array_fill(1, 12, 0);
    //         $dataMigrer = array_fill(1, 12, 0);

    //         // Remplir les données réelles
    //         foreach ($contratsTransmisParMois as $mois => $total) {
    //             $dataTransmis[$mois] = $total;
    //         }

    //         foreach ($contratsMigrerParMois as $mois => $total) {
    //             $dataMigrer[$mois] = $total;
    //         }

    //         $allContratsDistinct = Contrat::where('partenaire', $user->codepartenaire)->select('libelleproduit', DB::raw('COUNT(*) as nombre'), DB::raw('SUM(prime) as total_prime'))
    //         ->groupBy('codeproduit', 'libelleproduit')
    //         ->get();

    //         $productData = [];
    //         $productLabels = [];

            
    //         foreach ($allContratsDistinct as $item) {
    //             if ($item->libelleproduit && $item->total_prime !== null) {
    //                 $productLabels[] = $item->libelleproduit;
    //                 $productData[] = $item->total_prime;
    //             }
    //         }


    //         $userData = collect([

    //             // All contrat
    //             'user' => $user,
    //             'myAllContrats' => $myAllContrats,
    //             'myContratsMonth' => $myContratsMonth,
    //             // mes saisie du jours
    //             'myDayContrats' => $myDayContrats,
    //             // my contrat annule
    //             'contratsAnnuel' => $contratsAnnuel,
    //             // en saisie
    //             'myAllContratEnSaisie' => $myAllContratEnSaisie,
    //             'myAllContratEnSaisieMonth' => $myAllContratEnSaisieMonth,
    //             // transmis
    //             'myAllContratTransmis' => $myAllContratTransmis,
    //             'myAllContratTransmisMonth' => $myAllContratTransmisMonth,
    //             //migrer
    //             'myAllContratMigrer' => $myAllContratMigrer,
    //             'myAllContratMigrerMonth' => $myAllContratMigrerMonth,
    //             // rejetter
    //             'myAllContratRejetter' => $myAllContratRejetter,
    //             'myAllContratRejetterMonth' => $myAllContratRejetterMonth,
    //             // taux acceptation
    //             'tauxAcceptation' => $tauxAcceptation,
    //             // total rejet per year count
    //             'totalRejetPerYears' => $totalRejetPerYears,
    //             // all contrat distinct
    //         ]);

            


    //     return view('home', 
    //     ['userData' => $userData, 
    //     'dataTransmis' => $dataTransmis, 
    //     'dataMigrer' => $dataMigrer, 
    //     'productData' => $productData, 
    //     'productLabels' => $productLabels]);
    // }
}

