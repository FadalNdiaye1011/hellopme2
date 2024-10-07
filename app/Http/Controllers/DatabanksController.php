<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\Databank;
use App\Models\Opportunity;
use App\Models\PaysPartner;
use App\Models\Prescripteur;
use App\Models\SecteurActivite;
use App\Models\SecteurActiviteChildren;
use App\Models\TypeOpportunity;
use App\Models\File;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;

class DatabanksController extends AppBaseController
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the databanks.
     */
    public function index(Request $request)
    {
        /** @var databanks $databanks */
        $databanks = Databank::orderBy('created_at', 'desc')->paginate(10);

        return view('databanks.index')
            ->with('databanks', $databanks);
    }


    /**
     * Show the form for creating a new databanks.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->hasAnyRole('admin', 'editor', 'validator')) {
            $typeOpportunities =  TypeOpportunity::all();
            $secteurActivites = SecteurActivite::orderBy('libelle', 'asc')->get();
            $secteurActivitesChildren = SecteurActiviteChildren::all();
            $prescripteurs = Prescripteur::whereNull('finance_id')->get();
            $structure_financements = Prescripteur::whereNotNull('finance_id')->get();
            $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name')
                ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
                ->get();

            return view('databanks.create', compact('typeOpportunities', 'secteurActivitesChildren','secteurActivites', 'paysPartners', 'prescripteurs', 'structure_financements'));
        }else{
            Flash::error('Vous n\'avez pas le rôle nécessaire');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created databanks in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $attachments = $request->input('attachments');

        $commonFields = [
            'titre' => $request->input('titre'),
            'description' => nl2br($request->input('description')),
            'image_url' => ($request->input('image_url')) ?: asset('images/a-la-une-default.png') ,
            'criteres' => $request->input('criteres'),
            'source' => $request->input('source'),
            'budget' => $request->input('budget'),
            'role_contact' => $request->input('role_contact'),
            'nom_contact' => $request->input('nom_contact'),
            'email_contact' => $request->input('email_contact'),
            'started_at' => $request->input('started_at'),
            'deadline_question' => $request->input('deadline_question'),
            'deadline' => $request->input('deadline'),
            'prescripteur_id' => $request->input('prescripteur_id'),
            'pays_partner_id' => $request->input('pays_partner_id'),
            'secteur_activite_children_id' => $request->input('secteur_activite_children_id'),
            'type_opportunity_id' => $request->input('type_opportunity_id'),
            'status' => 'Created',
        ];

        if ($user->hasAnyRole('admin', 'editor')) {

            $databank = Databank::create($commonFields);

            foreach($attachments as $attachment):
                $data = ['databank_id' => $databank->id, 'url' => $attachment];
                // dd($data);
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

            Flash::success('Databanks saved successfully.');
            return redirect(route('databanks.index'));
        }else{
            Flash::error('Vous avez pas le role nécessaire');
            return redirect()->back();
        }

    }



    public function cancelLock($id)
{
    $user = Auth::user();
    $databanks = Databank::find($id);

    if (empty($databanks)) {
        Flash::error('Databanks not found');
        return redirect(route('databanks.index'));
    }

    // Vérifiez si l'enregistrement est verrouillé par l'utilisateur actuel
    if ($databanks->locked_by != $user->id) {
        Flash::error('Vous ne pouvez pas annuler cette modification.');
        return redirect()->back();
    }

    // Restaurer l'état précédent si disponible
    if (!empty($databanks->previous_etat)) {
        $databanks->etat = $databanks->previous_etat;
        $databanks->previous_etat = null;
        $databanks->locked_by = null;
        $databanks->locked_at = null;
        $databanks->save();

        Flash::success('Les modifications ont été annulées.');
    } else {
        Flash::error('Aucun état précédent trouvé.');
    }

    return redirect()->route('databanks.index');
}





    public function validateData(Request $request)
    {
        $user = Auth::user();

        if ($user->hasAnyRole(['admin', 'validator'])) {
            DB::beginTransaction();

            $databank = Databank::find($request->id);

            if (empty($databank)) {
                Flash::error('Databanks not found');
                return redirect(route('databanks.index'));
            }

            // Vérifiez si le champ locked_by est nul
            if (!is_null($databank->locked_by)) {
                Flash::error('Cette opportunité est déjà verrouillée et ne peut pas être validée.');
                return redirect()->back();
            }

            try {
                $commonFields = [
                    'titre' => $databank->titre,
                    'description' => nl2br($databank->description),
                    'image_url' => $databank->image_url,
                    'criteres' => $databank->criteres,
                    'source' => $databank->source,
                    'budget' => $databank->budget,
                    'role_contact' => $databank->role_contact,
                    'nom_contact' => $databank->nom_contact,
                    'email_contact' => $databank->phone_contact,
                    'started_at' => $databank->started_at,
                    'deadline_question' => $databank->deadline_question,
                    'deadline' => $databank->deadline,
                    'prescripteur_id' => $databank->prescripteur_id,
                    'pays_partner_id' => $databank->pays_partner_id,
                    'secteur_activite_children_id' => $databank->secteur_activite_children_id,
                    'type_opportunity_id' => $databank->type_opportunity_id,
                    'lieu' => 'Disponible en ligne',
                    'status' => 'Validated',
                ];

                $opportunity = Opportunity::create($commonFields);

                // Attachements
                DB::table('attachments')
                    ->where('databank_id', $databank->id)
                    ->update(['opportunity_id' => $opportunity->id]);

                DB::commit();

                $databank->delete();

                Flash::success('Databanks validated successfully.');
                return redirect(route('databanks.index'));

            } catch (\Exception $e) {
                DB::rollBack();
                Flash::error('Error saving data. Please look all the fields are filled in !');
                return redirect()->back();
            }
        } else {
            Flash::error('Vous n\'avez pas le rôle nécessaire');
            return redirect()->back();
        }
    }



    /**
     * Display the specified databanks.
     */
    public function show($id)
    {
        /** @var databanks $databanks */
        $databanks = Databank::find($id);

        if (empty($databanks)) {
            Flash::error('Databanks not found');

            return redirect(route('databanks.index'));
        }

        return view('databanks.show')->with('databanks', $databanks);
    }

    /**
     * Show the form for editing the specified databanks.
     */
    // public function edit($id)
    // {
    //     $user = Auth::user();

    //     if (!$user->hasAnyRole('admin', 'editor')) {
    //         Flash::error('Vous n\'avez pas le rôle nécessaire');
    //         return redirect()->back();
    //     }

    //     $databanks = Databank::find($id);
    //     $typeOpportunities = TypeOpportunity::all();
    //     $secteurActivitesChildren = SecteurActiviteChildren::all();
    //     $prescripteurs = Prescripteur::whereNull('finance_id')->get();
    //     $structure_financements = Prescripteur::whereNotNull('finance_id')->get();
    //     $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name')
    //         ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
    //         ->get();

    //     if (empty($databanks)) {
    //         Flash::error('Databanks not found');
    //         return redirect(route('databanks.index'));
    //     }
    //     return view('databanks.edit', compact('databanks', 'typeOpportunities', 'secteurActivitesChildren', 'paysPartners', 'prescripteurs', 'structure_financements'));
    // }

    public function edit($id)
    {
        $user = Auth::user();

        if (!$user->hasAnyRole('admin', 'editor')) {
            Flash::error('Vous n\'avez pas le rôle nécessaire');
            return redirect()->back();
        }

        $databanks = Databank::find($id);

        if (empty($databanks)) {
            Flash::error('Databanks not found');
            return redirect(route('databanks.index'));
        }

        if ($databanks->locked_by && $databanks->locked_by != $user->id) {
            Flash::error('Cette entrée est actuellement modifiée par un autre utilisateur.');
            return redirect()->back();
        }

        // Check if current etat is 'modified' or 'unmodified' before storing in previous_etat
        if (in_array($databanks->etat, ['modified', 'unmodified'])) {
            $databanks->previous_etat = $databanks->etat;
        } else {
            // Set a default value if the current etat is not one of the allowed values
            $databanks->previous_etat = 'unmodified';
        }

        $databanks->locked_by = $user->id;
        $databanks->locked_at = now();
        $databanks->etat = 'being_modified';
        $databanks->save();

        // Load other necessary data for the form
        $typeOpportunities = TypeOpportunity::all();
        $secteurActivites = SecteurActivite::orderBy('libelle', 'asc')->get();
        $secteurActivitesChildren = SecteurActiviteChildren::all();
        $prescripteurs = Prescripteur::whereNull('finance_id')->get();
        $structure_financements = Prescripteur::whereNotNull('finance_id')->get();
        $paysPartners = PaysPartner::select('pays_partners.id as pays_partner_id', 'pays.fr as pays_name')
            ->join('pays', 'pays_partners.pays_id', '=', 'pays.id')
            ->orderBy('pays.fr', 'asc')
            ->get();

        return view('databanks.edit', compact('databanks', 'typeOpportunities','secteurActivites', 'secteurActivitesChildren', 'paysPartners', 'prescripteurs', 'structure_financements'));
    }



    /**
     * Update the specified databanks in storage.
     */
    // public function update($id, Request $request)
    // {
    //     $user = Auth::user();
    //     if ($user->hasAnyRole('admin', 'editor')) {
    //         $databanks = Databank::find($id);
    //         if (empty($databanks)) {
    //             Flash::error('Databanks not found');
    //             return redirect(route('databanks.index'));
    //         }
    //         $attachments = $request->input('attachments');

    //         foreach($attachments as $attachment):
    //             $data = ['databank_id' => $databanks->id, 'url' => $attachment];
    //             // dd($data);
    //             $extension = 'pdf';
    //             $name_file = null;
    //             do {
    //                 $name_file = Str::random(20). '.' . $extension;
    //                 $file_state = File::where('id', $name_file);
    //                 File::create(
    //                     [
    //                         'id' => $name_file,
    //                         'type' => $extension
    //                     ]
    //                 );
    //             } while (empty($file_state));

    //             $data['file_id'] = $name_file;
    //             $attachment = Attachment::create($data);
    //         endforeach;


    //         $databanks->fill($request->all());
    //         $databanks->save();

    //         Flash::success('Databanks updated successfully.');
    //         return redirect(route('databanks.index'));
    //     }else{
    //         Flash::error('Vous n\'avez pas le rôle nécessaire');
    //     }
    // }


        public function update($id, Request $request)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('admin', 'editor')) {
            $databanks = Databank::find($id);

            if (empty($databanks)) {
                Flash::error('Databanks not found');
                return redirect(route('databanks.index'));
            }

            if ($databanks->locked_by != $user->id) {
                Flash::error('Vous ne pouvez pas modifier cet enregistrement car il est verrouillé par un autre utilisateur.');
                return redirect()->back();
            }

            $attachments = $request->input('attachments');

            foreach($attachments as $attachment):
                $data = ['databank_id' => $databanks->id, 'url' => $attachment];
                $extension = 'pdf';
                $name_file = null;
                do {
                    $name_file = Str::random(20) . '.' . $extension;
                    $file_state = File::where('id', $name_file);
                    File::create(['id' => $name_file, 'type' => $extension]);
                } while (empty($file_state));

                $data['file_id'] = $name_file;
                $attachment = Attachment::create($data);
            endforeach;

            $databanks->fill($request->all());
            $databanks->etat = 'modified';
            $databanks->save();

            // Release the lock
            $databanks->locked_by = null;
            $databanks->locked_at = null;
            $databanks->save();

            Flash::success('Databanks updated successfully.');
            return redirect(route('databanks.index'));
        } else {
            Flash::error('Vous n\'avez pas le rôle nécessaire');
            return redirect()->back();
        }
    }

        public function getSousSecteurs($secteurId)
    {
        try {
            $sousSecteurs = SecteurActiviteChildren::where('secteur_activite_id', $secteurId)->get();

            if ($sousSecteurs->isEmpty()) {
                return response()->json(['message' => 'Aucun sous-secteur trouvé.'], 404);
            }

            return response()->json($sousSecteurs, 200);
        } catch (\Exception $e) {
            // Enregistrer l'erreur dans les logs
            \Log::error('Erreur lors de la récupération des sous-secteurs: ' . $e->getMessage());

            return response()->json(['message' => 'Une erreur est survenue.'], 500);
        }
    }





    /**
     * Remove the specified databanks from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->hasAnyRole('admin', 'validator')) {

            /** @var databanks $databanks */
            $databanks = databank::find($id);

            if (empty($databanks)) {
                Flash::error('Databanks not found');

                return redirect(route('databanks.index'));
            }

            $databanks->delete();

            Flash::success('Databanks deleted successfully.');

            return redirect(route('databanks.index'));
        }else{
            Flash::error('Vous n\'avez pas le rôle nécessaire');
        }
    }


    public function resetStatus(Request $request)
{
    $databank = Databank::find($request->id);

    if ($databank && $databank->etat == 'being_modified') {
        $databank->etat = $databank->previous_etat ?: 'unmodified';
        $databank->previous_etat = null;
        $databank->locked_by = null;
        $databank->locked_at = null;
        $databank->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

}