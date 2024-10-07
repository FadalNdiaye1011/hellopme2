<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActeurFinanceResource;
use App\Http\Resources\PaysPartenersRessource;
use App\Models\ActeurFinance;
use App\Models\Contact;
use App\Models\Pays;
use App\Models\PaysPartner;
use App\Models\Service;
use App\Models\TypeFinance;
use Illuminate\Http\Request;


class ActeurFinanceController extends Controller
{

    public function index()
    {
        $acteurFinances = ActeurFinance::with(['contacts', 'typeFinance'])->paginate(10);
        return view('ActeurFinance.index', compact('acteurFinances'));
    }



    public function create(Request $request)
    {
        $typesFinance = TypeFinance::all();
        $pays = PaysPartner::with('pays')->get();
        $pays = PaysPartenersRessource::collection($pays)->toArray($request);
        // return $pays;
        return view('ActeurFinance.create', compact('typesFinance', 'pays'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'type_finance_id' => 'required|exists:type_finances,id',
            "declaration" => "nullable",
            "ville" => "nullable",
            "website" => "nullable",
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contacts.*.nom_responsable' => 'nullable|string|max:255',
            'contacts.*.phone' => 'nullable|string|max:255|unique:contacts,phone',
            'contacts.*.email' => 'nullable|email|max:255|unique:contacts,email',
            'contacts.*.fonction' => 'nullable|string|max:255',
        ]);

        // return $request->pays_partners_id;

        // Enregistrement de l'acteur de finance
        $acteurFinance = new ActeurFinance();
        $acteurFinance->libelle = $request->libelle;
        $acteurFinance->type_finance_id = $request->type_finance_id;
        $acteurFinance->declaration = $request->declaration;
        $acteurFinance->ville = $request->ville;
        $acteurFinance->website = $request->website;
        $acteurFinance->pays_partners_id = $request->pays_partners_id; // Sauvegarde du pays


        // Gestion de l'upload du logo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photo_finances', 'public');
            $acteurFinance->photo  = $path;
        }



        $acteurFinance->save();

        // Enregistrement des contacts
        foreach ($request->contacts as $contactData) {
            $contact = new Contact();
            $contact->nom_responsable = $contactData['nom_responsable'];
            $contact->phone = $contactData['phone'];
            $contact->email = $contactData['email'];
            $contact->fonction = $contactData['fonction'];
            $contact->acteur_finance_id = $acteurFinance->id;
            $contact->save();
        }

        return redirect()->route('acteur-finances.index')->with('success', 'Acteur de financement ajouté avec succès.');
    }



    public function edit(Request $request, $id)
    {
        $acteurFinance = ActeurFinance::with(['contacts', 'typeFinance', 'pays_partners'])->findOrFail($id);
        $typesFinances = TypeFinance::all();
        $pays = PaysPartner::with('pays')->get();
        $pays = PaysPartenersRessource::collection($pays)->toArray($request);
        return view('ActeurFinance.edit', compact('acteurFinance', 'typesFinances', 'pays'));
    }



    public function update(Request $request, $id)
    {
        // Validation des données de la requête
        $request->validate([
            'libelle' => 'required|string|max:255',
            'type_finance_id' => 'required|exists:type_finances,id',
            'declaration' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'contacts.*.nom_responsable' => 'nullable|string|max:255',
            'contacts.*.phone' => 'nullable|string|max:255',
            'contacts.*.email' => 'nullable|email|max:255',
            'contacts.*.fonction' => 'nullable|string|max:255',
        ]);

        // Trouver l'acteur à mettre à jour
        $acteurFinance = ActeurFinance::findOrFail($id);

        // Sauvegarder les informations de l'acteur
        $this->saveActeurFinance($acteurFinance, $request);

        // Récupérer tous les contacts existants
        $existingContacts = $acteurFinance->contacts()->get();

        // Créer un tableau pour stocker les IDs des contacts existants
        $existingContactIds = $existingContacts->pluck('id')->toArray();

        // Créer des tableaux pour stocker les numéros de téléphone et e-mails existants
        $existingPhones = $existingContacts->pluck('phone')->toArray();
        $existingEmails = $existingContacts->pluck('email')->toArray();

        // Préparer les nouveaux contacts pour l'insertion
        $contactsData = [];

        foreach ($request->contacts as $contactData) {
            // Ajouter acteur_finance_id aux données de contact
            $contactData['acteur_finance_id'] = $acteurFinance->id;

            // Vérifier si le contact existe déjà par téléphone ou e-mail
            if (in_array($contactData['phone'], $existingPhones) || in_array($contactData['email'], $existingEmails)) {
                // Si le contact existe déjà, passer à la prochaine itération
                continue;
            }

            if (isset($contactData['id']) && in_array($contactData['id'], $existingContactIds)) {
                // Si le contact existe déjà, mettre à jour ses informations
                $contact = Contact::findOrFail($contactData['id']);
                $contact->update($contactData);
            } else {
                // Si c'est un nouveau contact, l'ajouter au tableau
                $contactsData[] = $contactData;
            }
        }

        // Insérer les nouveaux contacts uniquement s'il y en a
        if (!empty($contactsData)) {
            Contact::insert($contactsData);
        }

        return redirect()->route('acteur-finances.index')->with('success', 'Acteur de financement mis à jour avec succès.');
    }

    public function show($id)
    {
        // $acteurFinance = ActeurFinance::with(['contacts', 'typeFinance', "services","pays_partners"])->findOrFail($id);
        $acteurFinance = ActeurFinance::findOrFail($id);
        // $acteurFinance = new ActeurFinanceResource($acteurFinance)
        return view('ActeurFinance.show', compact('acteurFinance'));
    }

    public function destroy($id)
    {
        $acteurFinance = ActeurFinance::findOrFail($id);
        $acteurFinance->contacts()->delete(); // Supprimer les contacts associés
        $acteurFinance->delete(); // Supprimer l'acteur de finance

        return redirect()->route('acteur-finances.index')->with('success', 'Acteur de financement supprimé avec succès.');
    }

    private function saveActeurFinance($acteurFinance, Request $request)
    {
        $acteurFinance->libelle = $request->libelle;
        $acteurFinance->type_finance_id = $request->type_finance_id;
        $acteurFinance->declaration = $request->declaration;
        $acteurFinance->ville = $request->ville;
        $acteurFinance->website = $request->website;
        $acteurFinance->pays_partners_id = $request->pays_partners_id;

        // Gestion de l'upload du logo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photo_finances', 'public');
            $acteurFinance->photo = $path;
        }



        $acteurFinance->save();

        // Enregistrement des contacts
        if ($request->contacts) {
            $acteurFinance->contacts()->delete(); // Supprimer les anciens contacts
            foreach ($request->contacts as $contactData) {
                $contact = new Contact();
                $contact->nom_responsable = $contactData['nom_responsable'];
                $contact->phone = $contactData['phone'];
                $contact->email = $contactData['email'];
                $contact->fonction = $contactData['fonction'];
                $contact->acteur_finance_id = $acteurFinance->id;
                $contact->save();
            }
        }
    }



    public function selectServices($id)
    {
        // Récupérer l'acteur de finance avec ses services associés
        $acteurFinance = ActeurFinance::with('services')->findOrFail($id);
        $acteurFinance = new ActeurFinanceResource($acteurFinance);
        $services = Service::all();
        return view('ActeurFinance.selectServices', compact('acteurFinance', 'services'));
    }




    public function storeServices(Request $request, $acteurFinanceId)
    {
        $request->validate([
            'services' => 'array',
            'services.*' => 'exists:services,id',
            'commentaires' => 'array', // Validation pour les commentaires
            'commentaires.*' => 'string|nullable', // Chaque commentaire doit être une chaîne ou null
        ]);

        $acteurFinance = ActeurFinance::findOrFail($acteurFinanceId);

        // Synchroniser les services avec les commentaires
        foreach ($request->services as $serviceId) {
            $commentaire = $request->commentaires[$serviceId] ?? null; // Récupérer le commentaire correspondant
            $acteurFinance->services()->syncWithoutDetaching([$serviceId => ['commentaire' => $commentaire]]);
        }

        return redirect()->route('acteur-finances.index')->with('success', 'Services associés mis à jour avec succès.');
    }
}
