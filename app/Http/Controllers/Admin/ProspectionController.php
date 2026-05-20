<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdherentProspert;
use App\Models\Prospect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectionController extends Controller
{

    public function index(Request $request)
    {
        $prospects = AdherentProspert::orderBy('created_at', 'desc')->paginate(20);

        $myProspects = AdherentProspert::where('reference_par', Auth::user()->idmembre)->where('etat' , 'Actif')->orderBy('created_at', 'desc')->paginate(20);
      

        return view('preSouscription.index', compact('prospects','myProspects'));
    }
   
}
