<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSecteurActiviteAPIRequest;
use App\Http\Requests\API\UpdateSecteurActiviteAPIRequest;
use App\Models\Opportunity;
use App\Models\SecteurActivite;
use App\Models\TypeOpportunity;
use App\Models\PaysPartner;
use App\Models\AreaInterest;
use App\Models\User;
use App\Models\Token;
use App\Models\Secteur_activite_child;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Carbon\Carbon;
use DB;

/**
 * Class SecteurActiviteAPIController
 */
class SecteurActiviteAPIController extends AppBaseController
{

    public function opportunities($request, $limit = null, $researched_topic = null, $goal_opportunities = null, $pays_partner = null, $typo_appel = null){
        $infos = array();
        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                       ->first();
        $infos = [
            'secteurs' => [],
            'topics' => [],
            'opportunities' => []
        ];
        if(empty($data_token))
            return $infos;

        $user = $data_token->user_id;

        //Preferences 'pays'
        $pays_prefer = array();
        $CONSTANT_PAYS = 1; //Pays partner : Senegal
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
        $pays_partner_choosen = (isset($pays_prefer[0])) ? PaysPartner::find($pays_prefer[0]) : PaysPartner::find($CONSTANT_PAYS);

        $opportunities = array();
        $secteurs = array();
        $sous_secteurs = array();

        $main_opportunities = ($goal_opportunities) ?: Opportunity::latest('created_at')->get();

        $i = 0;
        foreach($main_opportunities as $opportunity):
            if(!$opportunity)
                continue;

            //Check the deadline and the limit
            $today = Carbon::now();
            $deadline = (!$opportunity->deadline) ? null : Carbon::createFromFormat('Y-m-d H:i:s', $opportunity->deadline);
            $expire = $today->gt($deadline);
            $pays_bool = false;
            if(isset($opportunity->pays_partner_id))
                $pays_bool = ($pays_partner_choosen && $pays_partner_choosen->id == $opportunity->pays_partner_id) ? true : false;
            // dd($pays_partner_choosen->id, $opportunity->pays_partner_id);
            // if(!$type)

            if($typo_appel)
                if($opportunity->type_opportunity_id != $typo_appel)
                    continue;

            if(!$opportunity || $expire || !$pays_bool)
                continue;

            if($researched_topic):
                $sammple = array();
                $sample['titre'] = $opportunity->titre;
                $sample['created_at'] = $opportunity->created_at;
                $sample['description'] = $opportunity->description;
                $sample['secteur'] = ($opportunity->secteur_activite_children->secteurActivite) ? $opportunity->secteur_activite_children->secteurActivite->libelle : 'None';
                $sample['type'] = $opportunity->typeOpportunity->libelle;
                $sample['pays'] = $opportunity->pays_partner->one_pays->fr;
                $sample['deadline'] = $opportunity->deadline;
                $sample['lieu'] = $opportunity->lieu;
                $sample['attachement_1'] = ($opportunity->attachement_1) ?: null;
                $sample['attachement_2'] = ($opportunity->attachement_2) ?: null;
                $sample['attachement_3'] = ($opportunity->attachement_3) ?: null;

                if($opportunity->secteur_activite_children_id == $researched_topic)
                    $opportunities[] = (Object)$sample;
            endif;

            $sous_secteur = null;
            $sous_secteur = DB::table('secteur_activite_children')
                    ->select('secteur_activite_children.id as id', 'opportunities.titre')
                    ->join('opportunities', 'secteur_activite_children.id', 'opportunities.secteur_activite_children_id')
                    ->where('opportunities.id', $opportunity->id)
                    ->whereNull('opportunities.deleted_at')
                    ->first();

            $secteur = null;
            if(!empty($sous_secteur))
                $secteur = DB::table('secteur_activites')
                        ->select('secteur_activites.id as id')
                        ->join('secteur_activite_children', 'secteur_activites.id', 'secteur_activite_children.secteur_activite_id')
                        ->where('secteur_activite_children.id', $sous_secteur->id)
                        ->first();

            //Register the IDs
            if(!empty($sous_secteur))
                array_push($sous_secteurs, $sous_secteur->id);

            if(!empty($secteur))
                array_push($secteurs, $secteur->id);

            // if($limit)
            //     if($i == $limit)
            //         break;

            // $opportunities[] = (Object)$sample;
            // $i++;

        endforeach;

        $infos['secteurs'] = array_count_values($secteurs);
        $infos['topics'] = array_count_values($sous_secteurs);
        $infos['opportunities'] = $opportunities;
        // dd($opportunities);
        return $infos;

    }

    public function index(Request $request): JsonResponse
    {
        $secteurs = [];
        $main_secteurs = SecteurActivite::all();
        $typo_appel = 1;
        $data_sectors = $this->opportunities($request, null, null, null, null, $typo_appel)['secteurs'];

        foreach($main_secteurs as $secteur):
            $mat_image  = ($secteur->id <= 6) ? $secteur->id : 1;
            $secteur->image = asset('img/' . $mat_image . '_secteur.png');
            $secteur->opportunities_number = 0;
            // return $secteur->id;
            if(isset($data_sectors[$secteur->id]))
                $secteur->opportunities_number = $data_sectors[$secteur->id];
            array_push($secteurs, $secteur);
        endforeach;

        return $this->sendResponse($secteurs, 'Secteurs displayed successfully !');
    }

    public function index_pays(Request $request, $pays_partner): JsonResponse
    {
        $secteurs = [];
        $main_secteurs = SecteurActivite::all();
        $typo_appel = 1;
        $data_sectors = $this->opportunities($request, null, null, null, $pays_partner, $typo_appel)['secteurs'];

        foreach($main_secteurs as $secteur):
            $mat_image  = ($secteur->id <= 6) ? $secteur->id : 1;
            $secteur->image = asset('img/' . $mat_image . '_secteur.png');
            $secteur->opportunities_number = 0;
            // return $secteur->id;
            if(isset($data_sectors[$secteur->id]))
                $secteur->opportunities_number = $data_sectors[$secteur->id];
            array_push($secteurs, $secteur);
        endforeach;

        return $this->sendResponse($secteurs, 'Secteurs displayed successfully !');
    }

    public function choosen(Request $request): JsonResponse
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                    ->first();
        $infos = array('favorites' => [], 'others' => []);

        if(empty($data_token))
            return $infos;
        $user = $data_token->user_id;

        $data_sectors = $this->opportunities($request)['secteurs'];
        $mainSecteurActivites = AreaInterest::where('type', 'secteur_activites')
                            ->where('user_id', $user)
                            ->get();
        $secteurId = array();
        $secteurs = array();
        $other_secteurs = array();

        foreach($mainSecteurActivites as $secteur):
            $secteur_activite = array();
            $secteurActivite = SecteurActivite::where('id',$secteur->secteur_activite_id)->first();

            if(!empty($secteurActivite)):
                $secteur_activite['id'] = $secteurActivite->id;
                $secteur_activite['libelle'] = $secteurActivite->libelle;
                $mat_image = ($secteurActivite->id <= 6) ? $secteurActivite->id : 1;
                $secteur_activite['image'] = asset('img/' . $mat_image . '_secteur.png');
                $secteur_activite['opportunities_number'] = 0;
                if(isset($data_sectors[$secteurActivite->id]))
                    $secteur_activite['opportunities_number'] = $data_sectors[$secteurActivite->id];

                array_push($secteurs,(Object)$secteur_activite);
                array_push($secteurId, $secteurActivite->id);
            endif;
        endforeach;

        $listSecteurs = SecteurActivite::all();
        foreach($listSecteurs as $secteurActivite):
            if(in_array($secteurActivite->id, $secteurId))
                continue;

            $secteur_activite = array();
            $secteur_activite['id'] = $secteurActivite->id;
            $secteur_activite['libelle'] = $secteurActivite->libelle;
            $mat_image = ($secteurActivite->id <= 6) ? $secteurActivite->id : 1;
            $secteur_activite['image'] = asset('img/' . $mat_image . '_secteur.png');
            $secteur_activite['opportunities_number'] = 0;
            if(isset($data_sectors[$secteurActivite->id]))
                $secteur_activite['opportunities_number'] = $data_sectors[$secteurActivite->id];



            array_push($other_secteurs,(Object)$secteur_activite);
        endforeach;

        $infos['favorites'] = $secteurs;
        $infos['others'] = $other_secteurs;

        return $this->sendResponse($infos, 'Secteur activites choosen listed !');
    }

    public function displayed(Request $request, $id): JsonResponse
    {
        $typo_appel = 1;
        $opportunities = $this->opportunities($request, null, $id, null, null, $typo_appel)['opportunities'];

        return $this->sendResponse($opportunities, 'Opportunities retrieved successfully about this topic !');
    }

    public function displayed_pays(Request $request, $id, $pays_partner): JsonResponse
    {
        $typo_appel = 1;
        $opportunities = $this->opportunities($request, null, $id, null, $pays_partner, $typo_appel)['opportunities'];

        return $this->sendResponse($opportunities, 'Opportunities retrieved successfully about this topic !');
    }

    public function show(Request $request, $id): JsonResponse
    {
        $topics = [];
        $main_topics = Secteur_activite_child::where('secteur_activite_id', $id)->get();
        $typo_appel = 1;
        $data_topics = $this->opportunities($request, null, null, null, null, $typo_appel)['topics'];

        // return $main_topics;
        foreach($main_topics as $topic):
            $mat_image = ($topic->secteur_activite_id <= 6) ? $topic->secteur_activite_id : 1;
            $topic->image = asset('img/' . $mat_image . '_secteur.png');
            $topic->opportunities_number = 0;
            // return $secteur->id;
            if(isset($data_topics[$topic->id]))
                $topic->opportunities_number = $data_topics[$topic->id];
            array_push($topics, $topic);
        endforeach;

        return $this->sendResponse($topics, 'Secteur details retrieved successfully !');
    }

    public function show_pays(Request $request, $id, $pays_partner): JsonResponse
    {
        $topics = [];
        $main_topics = Secteur_activite_child::where('secteur_activite_id', $id)->get();
        $typo_appel = 1;
        $data_topics = $this->opportunities($request, null, null, null, $pays_partner, $typo_appel)['topics'];

        // return $main_topics;
        foreach($main_topics as $topic):
            $mat_image = ($topic->secteur_activite_id <= 6) ? $topic->secteur_activite_id : 1;
            $topic->image = asset('img/' . $mat_image . '_secteur.png');
            $topic->opportunities_number = 0;
            // return $secteur->id;
            if(isset($data_topics[$topic->id]))
                $topic->opportunities_number = $data_topics[$topic->id];
            array_push($topics, $topic);
        endforeach;

        return $this->sendResponse($topics, 'Secteur details retrieved successfully !');
    }

    /**
     * Display a listing of the SecteurActivites.
     * GET|HEAD /secteur-activites
     */
    public function index_override(Request $request): JsonResponse
    {
        $query = SecteurActivite::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $secteurActivites = $query->get();

        return $this->sendResponse($secteurActivites->toArray(), 'Secteur Activites retrieved successfully');
    }

    /**
     * Store a newly created SecteurActivite in storage.
     * POST /secteur-activites
     */
    public function store(CreateSecteurActiviteAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::create($input);

        return $this->sendResponse($secteurActivite->toArray(), 'Secteur Activite saved successfully');
    }

    /**
     * Display the specified SecteurActivite.
     * GET|HEAD /secteur-activites/{id}
     */
    public function show_override($id): JsonResponse
    {
        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::find($id);

        if (empty($secteurActivite)) {
            return $this->sendError('Secteur Activite not found');
        }

        return $this->sendResponse($secteurActivite->toArray(), 'Secteur Activite retrieved successfully');
    }

    /**
     * Update the specified SecteurActivite in storage.
     * PUT/PATCH /secteur-activites/{id}
     */
    public function update($id, UpdateSecteurActiviteAPIRequest $request): JsonResponse
    {
        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::find($id);

        if (empty($secteurActivite)) {
            return $this->sendError('Secteur Activite not found');
        }

        $secteurActivite->fill($request->all());
        $secteurActivite->save();

        return $this->sendResponse($secteurActivite->toArray(), 'SecteurActivite updated successfully');
    }

    /**
     * Remove the specified SecteurActivite from storage.
     * DELETE /secteur-activites/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var SecteurActivite $secteurActivite */
        $secteurActivite = SecteurActivite::find($id);

        if (empty($secteurActivite)) {
            return $this->sendError('Secteur Activite not found');
        }

        $secteurActivite->delete();

        return $this->sendSuccess('Secteur Activite deleted successfully');
    }

    // public function index_type(Request $request, $pays_partner): JsonResponse
    // {
    //     $secteurs = [];
    //     $main_secteurs = SecteurActivite::all();
    //     $data_sectors = $this->opportunities($request, null, null, null, $pays_partner)['secteurs'];

    //     foreach($main_secteurs as $secteur):
    //         $secteur->image = asset('img/' . $secteur->id . '_secteur.png');
    //         $secteur->opportunities_number = 0;
    //         // return $secteur->id;
    //         if(isset($data_sectors[$secteur->id]))
    //             $secteur->opportunities_number = $data_sectors[$secteur->id];
    //         array_push($secteurs, $secteur);
    //     endforeach;

    //     return $this->sendResponse($secteurs, 'Secteurs displayed successfully !');
    // }
}
