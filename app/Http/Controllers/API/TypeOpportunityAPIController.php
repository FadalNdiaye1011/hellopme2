<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTypeOpportunityAPIRequest;
use App\Http\Requests\API\UpdateTypeOpportunityAPIRequest;
use App\Models\TypeOpportunity;
use App\Models\AreaInterest;
use App\Models\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class TypeOpportunityAPIController
 */
class TypeOpportunityAPIController extends AppBaseController
{
    /**
     * Display a listing of the TypeOpportunities.
     * GET|HEAD /type-opportunities
     */
    public function index(Request $request): JsonResponse
    {
        $mainTypeOpportunity = TypeOpportunity::all();
        $typeOpportunities = array();
        foreach($mainTypeOpportunity as $type):
            $typeOpportunity = array();
            if($type):
                $typeOpportunity['id'] = $type->id;
                $typeOpportunity['image'] = asset('img/' . $type->id . '.png');
                $typeOpportunity['libelle'] = $type->libelle;
                array_push($typeOpportunities, (Object)$typeOpportunity);
            endif;
        endforeach;

        
        return $this->sendResponse($typeOpportunities, 'Type Opportunities retrieved successfully');
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

        $mainTypeOpportunity = AreaInterest::where('type', 'type_opportunities')
                            ->where('user_id', $user)
                            ->get();
        $othersTypeO = array();
        $typeOpportunities = array();
        $typeOpportunityId = array();

        foreach($mainTypeOpportunity as $type):
            $typeOpportunity = array();
            $type = TypeOpportunity::where('id', $type->type_opportunity_id)->first();

            if(!empty($type)):
                $typeOpportunity['id'] = $type->id;
                $typeOpportunity['image'] = asset('img/' . $type->id . '.png');
                $typeOpportunity['libelle'] = $type->libelle;
                array_push($typeOpportunities, (Object)$typeOpportunity);
                array_push($typeOpportunityId, $type->id);
            endif;
        endforeach;

        $listTypeOpportunities = TypeOpportunity::all();

        foreach($listTypeOpportunities as $type):
            if(in_array($type->id, $typeOpportunityId))
                continue;

            $typeOpportunity = array();
            $typeOpportunity['id'] = $type->id;
            $typeOpportunity['image'] = asset('img/' . $type->id . '.png');
            $typeOpportunity['libelle'] = $type->libelle;
            array_push($othersTypeO, (Object)$typeOpportunity);
        endforeach;

        $infos['favorites'] = $typeOpportunities;
        $infos['others'] = $othersTypeO;

        return $this->sendResponse($infos, 'Type Opportunities retrieved successfully');
    }

    /**
     * Store a newly created TypeOpportunity in storage.
     * POST /type-opportunities
     */
    public function store(CreateTypeOpportunityAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::create($input);

        return $this->sendResponse($typeOpportunity->toArray(), 'Type Opportunity saved successfully');
    }

    /**
     * Display the specified TypeOpportunity.
     * GET|HEAD /type-opportunities/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::find($id);

        if (empty($typeOpportunity)) {
            return $this->sendError('Type Opportunity not found');
        }

        return $this->sendResponse($typeOpportunity->toArray(), 'Type Opportunity retrieved successfully');
    }

    /**
     * Update the specified TypeOpportunity in storage.
     * PUT/PATCH /type-opportunities/{id}
     */
    public function update($id, UpdateTypeOpportunityAPIRequest $request): JsonResponse
    {
        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::find($id);

        if (empty($typeOpportunity)) {
            return $this->sendError('Type Opportunity not found');
        }

        $typeOpportunity->fill($request->all());
        $typeOpportunity->save();

        return $this->sendResponse($typeOpportunity->toArray(), 'TypeOpportunity updated successfully');
    }

    /**
     * Remove the specified TypeOpportunity from storage.
     * DELETE /type-opportunities/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var TypeOpportunity $typeOpportunity */
        $typeOpportunity = TypeOpportunity::find($id);

        if (empty($typeOpportunity)) {
            return $this->sendError('Type Opportunity not found');
        }

        $typeOpportunity->delete();

        return $this->sendSuccess('Type Opportunity deleted successfully');
    }
}
