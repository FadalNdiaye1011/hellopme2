<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOpportunityAPIRequest;
use App\Http\Requests\API\UpdateOpportunityAPIRequest;
use App\Models\Opportunity;
use App\Models\TypeOpportunity;
use App\Models\PaysPartner;
use App\Models\Pays;
use App\Models\Secteur_activite_child;
use App\Models\Prescripteur;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class OpportunityAPIController
 */
class OpportunityAPIController extends AppBaseController
{
    /**
     * Display a listing of the Opportunities.
     * GET|HEAD /opportunities
     */
    public function index(Request $request): JsonResponse
    {
        $query = Opportunity::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $opportunities = $query->get();

        return $this->sendResponse($opportunities->toArray(), 'Opportunities retrieved successfully');
    }

    /**
     * Store a newly created Opportunity in storage.
     * POST /opportunities
     */
    public function store(CreateOpportunityAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Opportunity $opportunity */
        $opportunity = Opportunity::create($input);

        return $this->sendResponse($opportunity->toArray(), 'Opportunity saved successfully');
    }

    /**
     * Display the specified Opportunity.
     * GET|HEAD /opportunities/{id}
     */
    public function show(Request $request, $id): JsonResponse
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                       ->first();
        if(empty($data_token))
            return $infos;
        $user = $data_token->user_id;
        $auth_user = User::findOrFail($user);

        /** @var Opportunity $opportunity */
        $opportunity = Opportunity::find($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        // dd($opportunity);

        $sample = array();
        $sample['titre'] = $opportunity->titre;
        $sample['image_url'] = $opportunity->image_url;
        $sample['created_at'] = $opportunity->created_at;
        $sample['description'] = $opportunity->description;
        $sample['secteur'] = ($opportunity->secteur_activite_children->secteurActivite) ? $opportunity->secteur_activite_children->secteurActivite->libelle : 'xxxxx';
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
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
        }

        $sample = (Object)$sample;

        return $this->sendResponse($sample, 'Opportunity retrieved successfully');
    }

    /**
     * Update the specified Opportunity in storage.
     * PUT/PATCH /opportunities/{id}
     */
    public function update($id, UpdateOpportunityAPIRequest $request): JsonResponse
    {
        /** @var Opportunity $opportunity */
        $opportunity = Opportunity::find($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        $opportunity->fill($request->all());
        $opportunity->save();

        return $this->sendResponse($opportunity->toArray(), 'Opportunity updated successfully');
    }

    /**
     * Remove the specified Opportunity from storage.
     * DELETE /opportunities/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Opportunity $opportunity */
        $opportunity = Opportunity::find($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }

        $opportunity->delete();

        return $this->sendSuccess('Opportunity deleted successfully');
    }

    public function load_search_form(): JsonResponse
    {
        $infos = [];
        //Input informations
        $infos['type_opportunities'] = TypeOpportunity::all();
        $mainPaysPartners = PaysPartner::all();
        $pays_partners = array();
        foreach($mainPaysPartners as $partner):
            $pays_partner = array();

            $pays_partner['id'] = $partner->id;
            $pays = Pays::find($partner->pays_id);
            $pays_partner['nom_pays'] = null;
            $pays_partner['flag_image'] = null;
            if(!empty($pays)):
                $pays_partner['flag_image'] = asset('img/' . $pays->code_pays . '.png');
                $pays_partner['nom_pays'] = $pays->fr;
            endif;
            
            array_push($pays_partners, (Object)$pays_partner);

        endforeach;
        $infos['pays_partners'] = $pays_partners;

        $infos['secteurs']  = Secteur_activite_child::all();
        $infos['prescripteurs'] = Prescripteur::all();

        return $this->sendResponse($infos, 'Loaded input information !');

    }

    public function research(Request $request): JsonResponse
    {
        $input = $request->all();
        $opportunities = array();
        $main_opportunities = Opportunity::all();

        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                    ->first();
        if(empty($data_token))
            return [];
        $user = $data_token->user_id;
        $auth_user = User::findOrFail($user);

        foreach($main_opportunities as $opportunity):
            //Type Opportunity
            if(isset($input['type_opportunity']))
            if($input['type_opportunity'])
                if($opportunity->type_opportunity_id != $input['type_opportunity'] )
                    continue;

            //Pays partner
            if(isset($input['pays_partner']))
            if($input['pays_partner'])
                if($opportunity->pays_partner_id != $input['pays_partner'] )
                    continue;

            //Prescripteur
            if(isset($input['prescripteur']))
            if($input['prescripteur'])
              if($opportunity->prescripteur_id != $input['prescripteur'] )
                  continue;

            //Secteurs d'activites 
            if(isset($input['secteur']))
            if($input['secteur']):
                $secteur = $opportunity->secteur_activite_children->secteurActivite->id;
                if($secteur != $input['secteur'])
                    continue;
            endif;

            //Final push
            $sample = array();
            $sample['titre'] = $opportunity->titre;
            $sample['image_url'] = $opportunity->image_url;
            $sample['created_at'] = $opportunity->created_at;
            $sample['description'] = $opportunity->description;
            $sample['secteur'] = ($opportunity->secteur_activite_children->secteurActivite) ? $opportunity->secteur_activite_children->secteurActivite->libelle : 'xxxxx';
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

            $opportunities[] = (Object)$sample;

        endforeach;

        return $this->sendResponse($opportunities, 'Search results !');

    }


    public function is_favored(Request $request, $id): JsonResponse
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                    ->first();
        if(empty($data_token))
            return [];
        $user = $data_token->user_id;
        $auth_user = User::findOrFail($user);

        /** @var Opportunity $opportunity */
        $opportunity = Opportunity::find($id);

        if (empty($opportunity)) {
            return $this->sendError('Opportunity not found');
        }
 
        $status = ($auth_user->watchlists->contains('opportunity_id', $opportunity->id)) ? true  : false;  
        
        return $this->sendResponse($status, 'Status favorite');
    }
}
