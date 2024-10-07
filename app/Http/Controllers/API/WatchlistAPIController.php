<?php

namespace App\Http\Controllers\API;

use App\Models\Opportunity;
use App\Models\Watchlist;
use App\Models\Attachment;
use App\Models\User;
use App\Models\Token;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Carbon\Carbon;

class WatchlistAPIController extends AppBaseController
{
    
    public function add(Request $request, $opportunity)
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $token_row = Token::where('tokens.token', $token)
                        ->first();

        $user_id = $token_row->user_id;
        $user = User::find($user_id);

        if(empty($user))
            return $this->sendError('Something went wrong : user not found !');

        $state_in = $user->watchlists->contains('opportunity_id', $opportunity);
        if (!$state_in):
            $user->watchlists()->create(['opportunity_id' => $opportunity]);
            return $this->sendSuccess('Opportunity added on watchlist !');
        endif;
    
        return $this->sendSuccess('Opportunity already added on watchlist !');
    }

    public function remove(Request $request, $opportunity)
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $token_row = Token::where('tokens.token', $token)
                        ->first();

        $user_id = $token_row->user_id;
        $user = User::find($user_id);

        if(empty($user))
            return $this->sendError('Something went wrong : user not found !');

        //Delete
        $user->watchlists()->where('opportunity_id', $opportunity)->delete();

        return $this->list($request);

    }


    public function list(Request $request)
    {
        //Get information connected person
        $token = $request->header('Authorization');
        $token_row = Token::where('tokens.token', $token)
                        ->first();
        $user_id = $token_row->user_id;

        $user = User::find($user_id);

        if(empty($user))
            return $this->sendError('Something went wrong : user not found !');

        //Listing
        $raw_opportunities = $user->watchlists()->get();
        $opportunities = array();
        $none_entity = "None";
        foreach($raw_opportunities as $raw):
            $opportunity = Opportunity::find($raw->opportunity_id);
            if(!$opportunity)
                continue;

                $deadline = ($opportunity->deadline) ? \Carbon\Carbon::create($opportunity->deadline)->translatedFormat('d M Y') : $none_entity;
                
                $sample = array();
                $sample['id'] = $opportunity->id;
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
                $sample['favored'] = ($user->watchlists->contains('opportunity_id', $opportunity->id)) ? 1 : 0;    
        
                $attachments = \App\Models\Attachment::select('url')->where('opportunity_id', $opportunity->id)->whereNotNull('url')->get();
                $sample['attachments'] = ($attachments) ?: '';

                $opportunities[] = $sample;
                
        endforeach;

        return $this->sendResponse($opportunities, 'Opportunities on watchist !');
    }
}
