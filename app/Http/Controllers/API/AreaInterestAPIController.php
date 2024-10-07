<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAreaInterestAPIRequest;
use App\Http\Requests\API\UpdateAreaInterestAPIRequest;
use App\Http\Requests\API\PointInterestRequest;

use App\Models\AreaInterest;
use App\Models\TypeOpportunity;
use App\Models\PaysPartner;
use App\Models\SecteurActivite;
use App\Models\ExpertiseDomain;
use App\Models\Token;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use DB;

/**
 * Class AreaInterestAPIController
 */
class AreaInterestAPIController extends AppBaseController
{
    /**
     * Display a listing of the AreaInterests.
     * GET|HEAD /area-interests
     */
    public function index(Request $request): JsonResponse
    {
        $query = AreaInterest::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $areaInterests = $query->get();

        return $this->sendResponse($areaInterests->toArray(), 'Area Interests retrieved successfully');
    }

    /**
     * Store a newly created AreaInterest in storage.
     * POST /area-interests
     */
    public function store(PointInterestRequest $request,): JsonResponse
    {
        $token = $request->header('Authorization');
        $user = Token::where('tokens.token', $token)
                ->first();

        $data = $request->all();
        $data['user_id'] = $user->user_id;

        $push_interest = array(); 

        switch($data['type']) {
            case 'type_opportunities': {
                $points = explode(',' , $data['points']);
                foreach ($points as $value):
                    $input = array();
                    $type_opportunity = TypeOpportunity::find($value);
                    if(empty($type_opportunity))
                        continue;
                    $input['type'] = $data['type'];
                    $input['type_opportunity_id'] = $type_opportunity->id;
                    $input['user_id'] = $data['user_id'];
                    /** @var AreaInterest $areaInterest */
                    $areaInterest = AreaInterest::firstOrCreate(
                        $input,
                        $input
                    );
                    array_push($push_interest, $input);
                endforeach;
                break;
            }
            case 'pays_partners': {
                $points = explode(',' , $data['points']);
                foreach ($points as $value):
                    $input = array();
                    $pays_partner = PaysPartner::find($value);
                    if(empty($pays_partner))
                        continue;
                    $input['type'] = $data['type'];
                    $input['pays_partner_id'] = $pays_partner->id;
                    $input['user_id'] = $data['user_id'];
                    /** @var AreaInterest $areaInterest */
                    $areaInterest = AreaInterest::firstOrCreate(
                        $input,
                        $input
                    );
                    array_push($push_interest, $input);
                endforeach;
                break;
            }
            case 'secteur_activites': {
                $points = explode(',' , $data['points']);
                foreach ($points as $value):
                    $input = array();
                    $secteur_activite = SecteurActivite::find($value);
                    if(empty($secteur_activite))
                        continue;
                    $input['type'] = $data['type'];
                    $input['secteur_activite_id'] = $secteur_activite->id;
                    $input['user_id'] = $data['user_id'];
                    /** @var AreaInterest $areaInterest */
                    $areaInterest = AreaInterest::firstOrCreate(
                        $input,
                        $input
                    );                    
                    array_push($push_interest, $input);
                endforeach;
                break;
            }
            case 'expertise_domains': {
                $points = explode(',' , $data['points']);
                foreach ($points as $value):
                    $input = array();
                    $expertise_domain = ExpertiseDomain::find($value);
                    if(empty($expertise_domain))
                        continue;
                    $input['type'] = $data['type'];
                    $input['expertise_domain_id'] = $expertise_domain->id;
                    $input['user_id'] = $data['user_id'];
                    /** @var AreaInterest $areaInterest */
                    $areaInterest = AreaInterest::firstOrCreate(
                        $input,
                        $input
                    );
                    array_push($push_interest, $input);
                endforeach;
                break;
            }

            default: {
                return $this->sendError('Type interests not found !');
                break;
            }
        }

        if(empty($push_interest))
            return $this->sendError('No changes added');

        return $this->sendResponse($push_interest, 'Interests saved successfully');
    }

    /**
     * Display the specified AreaInterest.
     * GET|HEAD /area-interests/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::find($id);

        if (empty($areaInterest)) {
            return $this->sendError('Area Interest not found');
        }

        return $this->sendResponse($areaInterest->toArray(), 'Area Interest retrieved successfully');
    }

    /**
     * Update the specified AreaInterest in storage.
     * PUT/PATCH /area-interests/{id}
     */
    public function update($id, UpdateAreaInterestAPIRequest $request): JsonResponse
    {
        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::find($id);

        if (empty($areaInterest)) {
            return $this->sendError('Area Interest not found');
        }

        $areaInterest->fill($request->all());
        $areaInterest->save();

        return $this->sendResponse($areaInterest->toArray(), 'AreaInterest updated successfully');
    }

    /**
     * Remove the specified AreaInterest from storage.
     * DELETE /area-interests/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var AreaInterest $areaInterest */
        $areaInterest = AreaInterest::find($id);

        if (empty($areaInterest)) {
            return $this->sendError('Area Interest not found');
        }

        $areaInterest->delete();

        return $this->sendSuccess('Area Interest deleted successfully');
    }
}
