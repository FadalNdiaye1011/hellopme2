<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\PaysPartner;
use App\Models\SecteurActivite;
use App\Models\TypeFinance;
use App\Models\TypeOpportunity;
use Illuminate\Http\Request;

class PageAccueil extends Controller
{
    public function index()
    {
        $opportunities = Opportunity::latest('created_at')->take(6)->get();
        $secteur_activites = SecteurActivite::all();
        $typeOpportunities = TypeOpportunity::all();

        $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name', 'pays.code_pays as code')
            ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
            ->withCount('opportunities')
            ->get();

        $events = Opportunity::whereHas('typeOpportunity', function ($query) {
                $query->where('libelle', 'Evénements');
            })
            ->where('is_featured', true)
            ->take(3)
            ->get();

        $typefinances = TypeFinance::all();

        $financements = Opportunity::whereHas('typeOpportunity', function ($query) {
            $query->where('libelle', 'Financements');
        })
        ->take(3)
        ->get();

        return view('Accueil', compact('opportunities', 'secteur_activites','typefinances','financements', 'paysPartners', 'typeOpportunities', 'events'));
    }
}
