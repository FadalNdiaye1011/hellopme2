<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFinanceAPIRequest;
use App\Http\Requests\API\UpdateFinanceAPIRequest;
use App\Models\Finance;
use App\Models\Prescripteur;
use App\Models\Attachment;
use App\Models\Service;
use App\Models\RateTariff;
use App\Models\Pays;
use App\Models\PaysPartner;
use App\Models\Opportunity;
use App\Models\Token;
use App\Models\AreaInterest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Str;

use Carbon\Carbon;
use DB;
/**
 * Class FinanceAPIController
 */
class FinanceAPIController extends AppBaseController
{
    /**
     * Display a listing of the Finances.
     * GET|HEAD /finances
     */
    public function index(Request $request): JsonResponse
    {
        $query = Finance::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $finances = $query->get();

        return $this->sendResponse($finances->toArray(), 'Finances retrieved successfully');
    }

    public function index_override(Request $request, $type): JsonResponse
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                        ->first();
        $user = $data_token->user_id;

        //Preferences 'pays'
        $pays_prefer = array();
        $main_pays_prefer = AreaInterest::where('user_id', $user)
                            ->where('type', 'pays_partners')
                            ->get();
        foreach($main_pays_prefer as $prefer)
            $pays_prefer[] = $prefer->pays_partner_id;
       
        
        $pays = (isset($pays_prefer[0])) ? DB::table('pays_partners')->select('pays.id', 'pays.fr as libelle')->join('pays', 'pays_partners.pays_id', 'pays.id')
        ->where('pays_partners.id', $pays_prefer[0])
        ->first() : null;

        $main_finances = Finance::all();
        $finances = array();
        $typos = ['Tous', 'Banques', 'Etablissements financiers', 'Structures de promotion des PME', 'Fonds d\'investissement', 'Autres structures de financement'];
        $type = intval($type);  
        if($type < 0 || $type >=6 )
            return $this->sendError('Please select a correct type !');

        $typo = $typos[$type];
        foreach ($main_finances as $finance):
            if($typo != 'Tous')
                if($finance->type_finance != $typo)
                    continue;
            
            $sample = array(); 
            $prescripteur = Prescripteur::where('finance_id', $finance->id)->first();
            if(empty($prescripteur))
                continue;

            if($pays)
                if($prescripteur->pays_id != $pays->id)
                    continue;

            $sample['title'] = $prescripteur->libelle;
            $url = asset('img/logo-shredded.png');
            $sample['logo'] = ($prescripteur->logo) ? \Storage::disk('s3')->url('prescripteurs/logos/'. $prescripteur->logo) : $url;
            $sample['pays'] = ($prescripteur->pays_id) ? Pays::find($prescripteur->pays_id) : 'Aucun pays !';
            $sample['ville'] = ($prescripteur->town) ?: 'Aucune ville !';
            $sample['website'] = $prescripteur->website;
            $sample['titre_responsable'] = $prescripteur->titre_responsable;
            $sample['nom_responsable'] = $prescripteur->nom_responsable;            
            $sample['phone_responsable'] = $prescripteur->phone_responsable;
            $sample['type_finance'] = $finance->type_finance;
            $sample['declaration'] = ($finance->declaration) ? Str::limit($finance->declaration, 100, $end='...') : '';
        
            //Opportunities
            $opportunities = array();
            $main_opportunities = Opportunity::where('prescripteur_id', $prescripteur->id)->where('type_opportunity_id', 2)->get();
            foreach($main_opportunities as $opportunity):
                //Check the deadline and the limit 
                $today = Carbon::now();
                $deadline = (!$opportunity->deadline) ? null : Carbon::createFromFormat('Y-m-d H:i:s', $opportunity->deadline);
                $expire = $today->gt($deadline);
                
                if(!$opportunity || $expire )
                    continue;
    
                $example = array();
                $opportunities = array();
                $example['id'] = $opportunity->id;
                $example['titre'] = $opportunity->titre;
                $example['image_url'] = $opportunity->image_url;
                $example['created_at'] = $opportunity->created_at;
                $example['description'] = $opportunity->description;
                $example['secteur'] = 'Digital';
                $example['budget'] = ($opportunity->budget) ? number_format($opportunity->budget, 0, null, '.') : 0;
                $example['type'] = $opportunity->typeOpportunity->libelle;
                $example['pays'] = $opportunity->pays_partner->one_pays->fr;
                $example['deadline'] = $opportunity->deadline;
                $example['lieu'] = $opportunity->lieu;
                $example['permalink'] = \URL::to('/detail-appel-offre/' . $opportunity->id);
                $example['email_organisateur'] = $opportunity->email_contact;
    
                $attachments = Attachment::select('url')->where('opportunity_id', $opportunity->id)->whereNotNull('url')->get();
                $example['attachments'] = ($attachments) ?: '';
                $opportunities[] = (Object)$example;
            endforeach;
            $services = Service::select('libelle')->where('finance_id', $finance->id)->get();
            $services = ($services) ?: [];
            $sample['services'] = $services;

            $sample['opportunities'] = $opportunities;

            $rateTariffs = RateTariff::select('libelle', 'value')->where('finance_id', $finance->id)->get();
            $rateTariffs = ($rateTariffs) ?: [];
            $sample['rate_tariffs'] = $rateTariffs;

            $finances[] = (Object)$sample;

        endforeach;

        return $this->sendResponse($finances, 'Finances retrieved successfully');
    }

    public function index_override_pays(Request $request, $type, $pays_partner): JsonResponse
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $data_token = Token::where('tokens.token', $token)
                        ->first();
        $user = $data_token->user_id;

        //Preferences 'pays'
        $pays_prefer[0] = $pays_partner;
      
        $pays = (isset($pays_prefer[0])) ? DB::table('pays_partners')->select('pays.id', 'pays.fr as libelle')->join('pays', 'pays_partners.pays_id', 'pays.id')
        ->where('pays_partners.id', $pays_prefer[0])
        ->first() : null;

        $main_finances = Finance::all();
        $finances = array();
        $typos = ['Tous', 'Banques', 'Etablissements financiers', 'Structures de promotion des PME', 'Fonds d\'investissement', 'Autres structures de financement'];
        $type = intval($type);  
        if($type < 0 || $type >=6 )
            return $this->sendError('Please select a correct type !');

        $typo = $typos[$type];
        foreach ($main_finances as $finance):
            if($typo != 'Tous')
                if($finance->type_finance != $typo)
                    continue;

            $sample = array(); 
            $prescripteur = Prescripteur::where('finance_id', $finance->id)->first();
            if(empty($prescripteur))
                continue;

            if($pays)
                if($prescripteur->pays_id != $pays->id)
                    continue;

            $sample['title'] = $prescripteur->libelle;
            $url = asset('img/logo-shredded.png');
            $sample['logo'] = ($prescripteur->logo) ? \Storage::disk('s3')->url('prescripteurs/logos/'. $prescripteur->logo) : $url;
            $sample['pays'] = ($prescripteur->pays_id) ? Pays::find($prescripteur->pays_id) : 'Aucun pays !';
            $sample['ville'] = ($prescripteur->town) ?: 'Aucune ville !';
            $sample['website'] = $prescripteur->website;
            $sample['titre_responsable'] = $prescripteur->titre_responsable;
            $sample['nom_responsable'] = $prescripteur->nom_responsable;            
            $sample['phone_responsable'] = $prescripteur->phone_responsable;
            $sample['type_finance'] = $finance->type_finance;
            $sample['declaration'] = ($finance->declaration) ? Str::limit($finance->declaration, 100, $end='...') : '';
        
            //Opportunities
            $opportunities = array();
            $main_opportunities = Opportunity::where('prescripteur_id', $prescripteur->id)->where('type_opportunity_id', 2)->get();
            foreach($main_opportunities as $opportunity):
                //Check the deadline and the limit 
                $today = Carbon::now();
                $deadline = (!$opportunity->deadline) ? null : Carbon::createFromFormat('Y-m-d H:i:s', $opportunity->deadline);
                $expire = $today->gt($deadline);
                
                if(!$opportunity || $expire )
                    continue;
    
                $example = array();
                $opportunities = array();
                $example['id'] = $opportunity->id;
                $example['titre'] = $opportunity->titre;
                $example['image_url'] = $opportunity->image_url;
                $example['created_at'] = $opportunity->created_at;
                $example['description'] = $opportunity->description;
                $example['secteur'] = 'Digital';
                $example['budget'] = ($opportunity->budget) ? number_format($opportunity->budget, 0, null, '.') : 0;
                $example['type'] = $opportunity->typeOpportunity->libelle;
                $example['pays'] = $opportunity->pays_partner->one_pays->fr;
                $example['deadline'] = $opportunity->deadline;
                $example['lieu'] = $opportunity->lieu;
                $example['permalink'] = \URL::to('/detail-appel-offre/' . $opportunity->id);
                $example['email_organisateur'] = $opportunity->email_contact;
    
                $attachments = Attachment::select('url')->where('opportunity_id', $opportunity->id)->whereNotNull('url')->get();
                $example['attachments'] = ($attachments) ?: '';
                $opportunities[] = (Object)$example;
            endforeach;
            $services = Service::select('libelle')->where('finance_id', $finance->id)->get();
            $services = ($services) ?: [];
            $sample['services'] = $services;

            $sample['opportunities'] = $opportunities;

            $rateTariffs = RateTariff::select('libelle', 'value')->where('finance_id', $finance->id)->get();
            $rateTariffs = ($rateTariffs) ?: [];
            $sample['rate_tariffs'] = $rateTariffs;

            $finances[] = (Object)$sample;

        endforeach;

        return $this->sendResponse($finances, 'Finances retrieved successfully');
    }

    /**
     * Store a newly created Finance in storage.
     * POST /finances
     */
    public function store(CreateFinanceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Finance $finance */
        $finance = Finance::create($input);

        return $this->sendResponse($finance->toArray(), 'Finance saved successfully');
    }

    /**
     * Display the specified Finance.
     * GET|HEAD /finances/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Finance $finance */
        $finance = Finance::find($id);

        if (empty($finance)) {
            return $this->sendError('Finance not found');
        }

        return $this->sendResponse($finance->toArray(), 'Finance retrieved successfully');
    }

    /**
     * Update the specified Finance in storage.
     * PUT/PATCH /finances/{id}
     */
    public function update($id, UpdateFinanceAPIRequest $request): JsonResponse
    {
        /** @var Finance $finance */
        $finance = Finance::find($id);

        if (empty($finance)) {
            return $this->sendError('Finance not found');
        }

        $finance->fill($request->all());
        $finance->save();

        return $this->sendResponse($finance->toArray(), 'Finance updated successfully');
    }

    /**
     * Remove the specified Finance from storage.
     * DELETE /finances/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Finance $finance */
        $finance = Finance::find($id);

        if (empty($finance)) {
            return $this->sendError('Finance not found');
        }

        $finance->delete();

        return $this->sendSuccess('Finance deleted successfully');
    }
}
