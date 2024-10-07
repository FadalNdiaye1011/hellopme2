<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOpportunityAPIRequest;
use App\Http\Requests\API\UpdateOpportunityAPIRequest;
use App\Models\Opportunity;
use App\Models\SecteurActivite;
use App\Models\TypeOpportunity;
use App\Models\PaysPartner;
use App\Models\Pays;
use App\Models\AreaInterest;
use App\Models\User;
use App\Models\Token;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Carbon\Carbon;

class HomeAPIController extends AppBaseController
{

    public function opportunities($request, $limit = null, $pays_partner = null, $type = null, $goal_opportunities = null)
    {
        $infos = array();
        $infos = [
            'pays_choosen' => [],
            'top_events' => [],
            'opportunities_type' => [],
            'opportunities' => [],
            'opportunities_by_type' => []
        ];

        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                       ->first();
        if(empty($data_token))
            return $infos;
        $user = $data_token->user_id;
        $auth_user = User::findOrFail($user);

        $pays_prefer = array();
        if(!$pays_partner):
            //Preferences 'pays'
            $main_pays_prefer = AreaInterest::where('user_id', $user)
                                ->where('type', 'pays_partners')
                                ->get();
            foreach($main_pays_prefer as $prefer)
                $pays_prefer[] = $prefer->pays_partner_id;
        else:
            $pays_prefer[] = $pays_partner;
        endif;

        $CONSTANT_PAYS = 1; //Pays partner : Senegal

        $pays_partner_choosen = (isset($pays_prefer[0])) ? PaysPartner::find($pays_prefer[0]) : PaysPartner::find($CONSTANT_PAYS);
        $pays_choosen = ($pays_partner_choosen) ? $pays_partner_choosen->one_pays : Pays::find($CONSTANT_PAYS);
        $pays_choosen->image = ($pays_choosen) ? asset('img/' . $pays_choosen->code_pays . '.png') : null;
        $pays_choosen->id = ($pays_partner_choosen) ? $pays_partner_choosen->id : null;

        $opportunities = array();
        $appel_offres = array();
        $events = array();
        $financements = array();
        $top_events = array();
        $type_opportunities = array();
        $type_opportunity = array();
        $numbers = array('1' => 0, '2' => 0, '3' => 0, '4' => 0);

        $main_opportunities = ($goal_opportunities) ?: Opportunity::all();
        $main_opportunities = ($type) ? Opportunity::where('type_opportunity_id', $type)->latest('created_at')->get() : $main_opportunities;
        $i = 0;
        // dd($main_opportunities);
        foreach($main_opportunities as $opportunity):
            //Check the deadline and the limit
            $today = Carbon::now();
            $deadline = (!$opportunity->deadline) ? Carbon::now() : Carbon::createFromFormat('Y-m-d H:i:s', $opportunity->deadline);
            $expire = $today->gt($deadline);
            // $pays_bool = ($pays_partner_choosen->id == $opportunity->pays_partner_id) ? true : false; //82
            $pays_bool = ($pays_partner_choosen && $pays_partner_choosen->id == $opportunity->pays_partner_id) ? true : false;
            if(!$opportunity || $expire || !$pays_bool)
                continue;

            $sammple = array();
            $sample['id'] = $opportunity->id;
            $sample['titre'] = $opportunity->titre;
            $sample['image_url'] = $opportunity->image_url;
            $sample['created_at'] = $opportunity->created_at;
            $sample['description'] = $opportunity->description;
            $sample['secteur'] = $opportunity->secteur_activite_children->secteurActivite->libelle;
            $sample['budget'] = $opportunity->budget;
            $sample['type'] = $opportunity->typeOpportunity->libelle;
            $sample['pays'] = $opportunity->pays_partner->one_pays->fr;
            $sample['deadline'] = $opportunity->deadline;
            $sample['lieu'] = $opportunity->lieu;
            $sample['permalink'] = \URL::to('/detail-appel-offre/' . $opportunity->id);
            $sample['email_organisateur'] = $opportunity->email_contact;
            $sample['favored'] = ($auth_user->watchlists->contains('opportunity_id', $opportunity->id)) ? 1 : 0;

            $attachments = \App\Models\Attachment::select('url')->where('opportunity_id', $opportunity->id)->whereNotNull('url')->get();
            $sample['attachments'] = ($attachments) ?: '';

            switch ($opportunity->type_opportunity_id) {
                case 3:
                    $numbers['3'] += 1;
                    $events[] = (Object)$sample;
                    break;
                case 2:
                    $numbers['2'] += 1;
                    $financements[] = (Object)$sample;
                    break;
                case 1:
                    $numbers['1'] += 1;
                    $appel_offres[] = (Object)$sample;
                    break;
            }

            if($limit)
                if($i == $limit)
                    continue;

            if($opportunity->pays_partner_id == $pays_partner_choosen->id):
                $opportunities[] = (Object)$sample;
                $i++;
            endif;

        endforeach;

        //Fill up featured events
        $featured_events = Opportunity::whereHas('typeOpportunity', function ($query) {
            $query->where('libelle', 'Evénements');
        })
        ->where('is_featured', true)
        ->take(3)
        ->get();

        //Fill up preferential 'pays'
        $infos['pays_choosen'] = $pays_choosen;

        //Fill up featured events
        $infos['top_events'] = $featured_events;

        //Fill up type opportunities information
        if(!$type):
            $mainTypeOpportunity = TypeOpportunity::all();
            $typeOpportunities = array();
            foreach($mainTypeOpportunity as $type):
                $typeOpportunity = array();
                if($type):
                    $typeOpportunity['id'] = $type->id;
                    $typeOpportunity['image'] = asset('img/' . $type->id . '.png');
                    $typeOpportunity['libelle'] = $type->libelle;
                    $typeOpportunity['offers'] = $numbers[$type->id];

                    array_push($typeOpportunities, (Object)$typeOpportunity);
                endif;
            endforeach;

            $infos['opportunities_type'] = $typeOpportunities;
        endif;

        $infos['opportunities'] = $opportunities;

        $type_opportunity['appel_offres'] = $appel_offres;
        $type_opportunity['events'] = $events;
        $type_opportunity['financements'] = $financements;

        $infos['opportunities_by_type'] = $type_opportunity;

        return $infos;

    }

    public function index(Request $request): JsonResponse
    {
        $limit = 12;
        $information = $this->opportunities($request, $limit);

        return $this->sendResponse($information, 'Opportunities informations displayed successfully !');
    }

    public function index_pays(Request $request, $pays_partner): JsonResponse
    {
        $limit = 12;
        $information = $this->opportunities($request, $limit, $pays_partner);

        return $this->sendResponse($information, 'Opportunities informations displayed successfully by country !');
    }

    public function index_event(Request $request): JsonResponse
    {
        $limit = 12;
        $events = $this->opportunities($request, $limit, null, 3);

        return $this->sendResponse($events, 'Event informations displayed successfully !');
    }

    public function index_event_pays(Request $request, $pays_partner): JsonResponse
    {
        $limit = 12;
        $events = $this->opportunities($request, $limit, $pays_partner, 3);

        return $this->sendResponse($events, 'Event informations displayed successfully by country !');
    }

    public function index_by_type(Request $request, $pays_partner): JsonResponse
    {
        $opportunities_by_type = $this->opportunities($request, null, $pays_partner)['opportunities_by_type'];

        return $this->sendResponse($opportunities_by_type, 'Opportunities by type displayed successfully !');
    }

}
