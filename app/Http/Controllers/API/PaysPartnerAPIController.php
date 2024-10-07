<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaysPartnerAPIRequest;
use App\Http\Requests\API\UpdatePaysPartnerAPIRequest;
use App\Models\PaysPartner;
use App\Models\Pays;
use App\Models\AreaInterest;
use App\Models\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\API\HomeAPIController;
use App\Http\Controllers\API\SecteurActiviteAPIController;
/**
 * Class PaysPartnerAPIController
 */
class PaysPartnerAPIController extends AppBaseController
{
    /**
     * Display a listing of the PaysPartners.
     * GET|HEAD /pays-partners
     */
    public function index(Request $request): JsonResponse
    {
        $mainPaysPartners = PaysPartner::all();
        $paysPartners = array();
        foreach($mainPaysPartners as $partner):
            $pays_partner = array();
            if($partner):
                $pays_partner['id'] = $partner->id;
                $pays = Pays::find($partner->pays_id);
                $pays_partner['nom_pays'] = null;
                $pays_partner['flag_image'] = null;
                if(!empty($pays)):
                    $pays_partner['flag_image'] = asset('img/' . $pays->code_pays . '.png');
                    $pays_partner['nom_pays'] = $pays->fr;
                endif;
                
                array_push($paysPartners,(Object)$pays_partner);
            endif;
        endforeach;
        
        return $this->sendResponse($paysPartners, 'Pays Partners retrieved successfully');
    }
    
    public function choosen(Request $request): JsonResponse
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                    ->first();
        if(empty($data_token))
            return $this->sendError('No user information connected');
        
        $user = $data_token->user_id;
        $infos = ['favorites' => null, 'others' => null];
        $mainPaysPartners = AreaInterest::where('type', 'pays_partners')
                            ->where('user_id', $user)
                            ->get();
        $paysPartnerId = array();
        $paysPartners = array();
        $otherPaysPartners = array();
        foreach($mainPaysPartners as $partner):
            $pays_partner = array();
            $paysPartner = PaysPartner::find($partner->pays_partner_id);

            if(!empty($paysPartner)):
                $pays_partner['id'] = $paysPartner->id;
                $pays = Pays::find($paysPartner->pays_id);
                $pays_partner['nom_pays'] = null;
                $pays_partner['flag_image'] = null;
                if(!empty($pays)):
                    $pays_partner['flag_image'] = asset('img/' . $pays->code_pays . '.png');
                    $pays_partner['nom_pays'] = $pays->fr;
                endif;
                
                $home_controller = new HomeAPIController();
                $opportunities = $home_controller->opportunities($request, null, $paysPartner->id)['opportunities'];
                $pays_partner['opportunities_number'] = count($opportunities); 
                $secteur_controller = new SecteurActiviteAPIController();
                $secteurs = $secteur_controller->opportunities($request, null, null, $opportunities)['secteurs'];
                $pays_partner['secteurs_number'] = count($secteurs); 

                array_push($paysPartners, (Object)$pays_partner);
                array_push($paysPartnerId, $paysPartner->id);
            endif;
        endforeach;

        $i = 0;
        $listPaysPartners = PaysPartner::all();
        foreach($listPaysPartners as $partner):
            $pays_partner = array();

            if(in_array($partner->id, $paysPartnerId))
                continue;

            $pays = Pays::find($partner->pays_id);
            $pays_partner['id'] = $partner->id;
            $pays_partner['nom_pays'] = null;
            $pays_partner['flag_image'] = null;
            if(!empty($pays)):
                $pays_partner['flag_image'] = asset('img/' . $pays->code_pays . '.png');
                $pays_partner['nom_pays'] = $pays->fr;
            endif;

            $home_controller = new HomeAPIController();
            $opportunities = $home_controller->opportunities($request, null, $partner->id)['opportunities'];
            $pays_partner['opportunities_number'] = count($opportunities); 
            $secteur_controller = new SecteurActiviteAPIController();
            $secteurs = $secteur_controller->opportunities($request, null, null, $opportunities)['secteurs'];
            $pays_partner['secteurs_number'] = count($secteurs); 
             
            array_push($otherPaysPartners, (Object)$pays_partner);
            $i+=1;

            if($i == 3)
                break;

        endforeach;


        $infos['favorites'] = $paysPartners;
        $infos['others'] = $otherPaysPartners;

        return $this->sendResponse($infos, 'Pays Partners choosen listed !');
    }
    
    /**
     * Store a newly created PaysPartner in storage.
     * POST /pays-partners
     */
    public function store(CreatePaysPartnerAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::create($input);

        return $this->sendResponse($paysPartner->toArray(), 'Pays Partner saved successfully');
    }

    /**
     * Display the specified PaysPartner.
     * GET|HEAD /pays-partners/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::find($id);

        if (empty($paysPartner)) {
            return $this->sendError('Pays Partner not found');
        }

        return $this->sendResponse($paysPartner->toArray(), 'Pays Partner retrieved successfully');
    }

    /**
     * Update the specified PaysPartner in storage.
     * PUT/PATCH /pays-partners/{id}
     */
    public function update($id, UpdatePaysPartnerAPIRequest $request): JsonResponse
    {
        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::find($id);

        if (empty($paysPartner)) {
            return $this->sendError('Pays Partner not found');
        }

        $paysPartner->fill($request->all());
        $paysPartner->save();

        return $this->sendResponse($paysPartner->toArray(), 'PaysPartner updated successfully');
    }

    /**
     * Remove the specified PaysPartner from storage.
     * DELETE /pays-partners/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var PaysPartner $paysPartner */
        $paysPartner = PaysPartner::find($id);

        if (empty($paysPartner)) {
            return $this->sendError('Pays Partner not found');
        }

        $paysPartner->delete();

        return $this->sendSuccess('Pays Partner deleted successfully');
    }
}
