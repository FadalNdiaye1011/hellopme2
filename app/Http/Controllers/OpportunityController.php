<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\Opportunity;
use App\Models\Pays;
use App\Models\PaysPartner;
use App\Models\Prescripteur;
use App\Models\SecteurActivite;
use App\Models\SecteurActiviteChildren;
use App\Models\TypeOpportunity;
use App\Models\File;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Str;


class OpportunityController extends AppBaseController
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Opportunity.
     */
    public function index(Request $request)
    {
        $opportunities = Opportunity::paginate(10);

        return view('opportunities.index')
            ->with('opportunities', $opportunities);
    }


    /**
     * Show the form for creating a new Opportunity.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->hasAnyRole('admin', 'validator')) {
            $typeOpportunities =  TypeOpportunity::all();
            $secteurActivites = SecteurActivite::all();
            $secteurActivitesChildren = SecteurActiviteChildren::all();
            $prescripteurs = Prescripteur::all();

            $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name')
                ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
                ->get();
            return view('opportunities.create', compact('typeOpportunities', 'secteurActivites', 'paysPartners', 'secteurActivitesChildren', 'prescripteurs'));
        }else{
            Flash::error('Vous avez pas le role nécessaire');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created Opportunity in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();


        if ($user->hasAnyRole('admin', 'validator')) {

            $input = $request->all();
            $input['description'] = nl2br($input['description']);
            $attachments = $request->input('attachments');

            $opportunity = Opportunity::create($input);
            foreach($attachments as $attachment):
                $data = ['opportunity_id' => $opportunity->id, 'url' => $attachment];
                $extension = 'pdf';
                $name_file = null;
                do {
                    $name_file = Str::random(20). '.' . $extension;
                    $file_state = File::where('id', $name_file);
                    File::create(
                        [
                            'id' => $name_file,
                            'type' => $extension
                        ]
                    );
                } while (empty($file_state));
    
                $data['file_id'] = $name_file;
                $attachment = Attachment::create($data);
            endforeach;

            Flash::success('Opportunity saved successfully.');
        }else{
            Flash::error('Vous avez pas le role nécessaire');
            return redirect()->back();
        }

        return redirect(route('opportunities.index'));
    }

    /**
     * Display the specified Opportunity.
     */
    public function show($id)
    {
        /** @var Opportunity $opportunity */
        $opportunity = Opportunity::find($id);

        if (empty($opportunity)) {
            Flash::error('Opportunity not found');
            return redirect(route('opportunities.index'));
        }

        return view('opportunities.show')->with('opportunity', $opportunity);
    }

    /**
     * Show the form for editing the specified Opportunity.
     */
    public function edit($id)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('admin', 'validator')) {

            /** @var Opportunity $opportunity */
            $typeOpportunities =  TypeOpportunity::all();
            $secteurActivites = SecteurActivite::all();
            $opportunity = Opportunity::find($id);
            $secteurActivitesChildren = SecteurActiviteChildren::all();
            $prescripteurs = Prescripteur::all();
            $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name')
            ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
            ->get();
            if (empty($opportunity)) {
                Flash::error('Opportunity not found');

                return redirect(route('opportunities.index'));
            }

            return view('opportunities.edit', compact('opportunity', 'typeOpportunities', 'secteurActivites', 'paysPartners', 'secteurActivitesChildren', 'prescripteurs'));
        }else{
            Flash::error('Vous avez pas le role nécessaire');
            return redirect()->back();
        }
    }

    /**
     * Update the specified Opportunity in storage.
     */
    public function update($id, Request $request)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('admin', 'validator')) {

            $opportunity = Opportunity::find($id);

            if (empty($opportunity)) {
                Flash::error('Opportunity not found');

                return redirect(route('opportunities.index'));
            }

            $attachments = $request->input('attachments');

            foreach($attachments as $attachment):
                $data = ['opportunity_id' => $opportunity->id, 'url' => $attachment];
                $extension = 'pdf';
                $name_file = null;
                do {
                    $name_file = Str::random(20). '.' . $extension;
                    $file_state = File::where('id', $name_file);
                    File::create(
                        [
                            'id' => $name_file,
                            'type' => $extension
                        ]
                    );
                } while (empty($file_state));
    
                $data['file_id'] = $name_file;
                $attachment = Attachment::create($data);
            endforeach;

            $opportunity->fill($request->all());
            $opportunity->save();

            Flash::success('Opportunity updated successfully.');
        }else{
            Flash::error('Vous avez pas le role nécessaire');
            return redirect()->back();
        }
        return redirect(route('opportunities.index'));
    }

    /**
     * Remove the specified Opportunity from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('admin', 'validator')) {

            /** @var Opportunity $opportunity */
            $opportunity = Opportunity::find($id);

            if (empty($opportunity)) {
                Flash::error('Opportunity not found');

                return redirect(route('opportunities.index'));
            }

            $opportunity->delete();

            Flash::success('Opportunity deleted successfully.');
        }else{
            Flash::error('Vous avez pas le role nécessaire');
            return redirect()->back();
        }
        return redirect(route('opportunities.index'));
    }

}
