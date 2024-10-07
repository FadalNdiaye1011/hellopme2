<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAbonnementRequest;
use App\Http\Requests\UpdateAbonnementRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use Flash;
use GuzzleHttp\Client as GuzzleClient;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\Databank;
use Illuminate\Support\Str;
use Carbon\Carbon; // Importer Carbon pour la gestion des dates


class AbonnementController extends AppBaseController
{
    

    // public function scrape()
        // {
            // Créer une instance du client HTTP Symfony
           //  $symfonyClient = HttpClient::create([
               //  'headers' => [
               //      'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
              //   ],
            // ]);
    
            // Créer une instance de Goutte avec le client Symfony
            // $client = new Client($symfonyClient);
    
            // Accéder à la page à scraper
             //$crawler = $client->request('GET', 'https://procurement-notices.undp.org/');
    
            // Afficher le contenu brut pour vérification
            //echo $crawler->html();
    
            // Extraire les titres des avis de marchés (adapter en fonction du HTML)
             //$crawler->filter('.vacanciesTable__cell span')->each(function ($node) {
              //   echo $node->text() . "\n";  // Afficher les titres
                //echo $node->attr('href') . "\n";  // Afficher l'URL associée
         //    });
        // }
        
        //fin du code 
        
    

        
    public function scrape()
    {
        // Créer une instance du client HTTP Symfony
        $symfonyClient = HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
            ],
        ]);

        // Créer une instance de Goutte avec le client Symfony
        $client = new Client($symfonyClient);

        // Accéder à la page des appels d'offres
        $crawler = $client->request('GET', 'https://www.bceao.int/fr/appels-offres/appels-offres-marches-publics-achats');

        // Parcourir chaque div correspondant à un appel d'offre
        $crawler->filter('.itemDoc')->each(function ($node) {
            // Extraire le lien de l'appel d'offre
            $link = $node->filter('.field-content a')->attr('href');

            // Extraire la date de publication
            $publishedDate = $node->filter('.infoFile time')->text();

            // Extraire la date limite
            $deadline = $node->filter('.descFile time')->text();

            // Extraire le titre de l'appel d'offre
            $title = $node->filter('.ttr')->text();

            // Convertir la date limite du français vers l'anglais
            $deadlineInEnglish = $this->convertFrenchDateToEnglish($deadline);

            // Transformer la date limite en objet Carbon pour comparaison
            try {
                $deadlineDate = Carbon::createFromFormat('d F Y', $deadlineInEnglish);
            } catch (\Exception $e) {
                echo "Erreur de parsing pour la date limite: $deadline \n";
                return;
            }

            $currentDate = Carbon::now();

            // Vérifier si la date limite est encore valide (non passée)
            if ($deadlineDate->greaterThanOrEqualTo($currentDate)) {
                // Créer une description combinée
                $description = "Publié le: $publishedDate. Date limite: $deadline.";

                // Vérifier si l'appel d'offre n'existe pas déjà dans la base de données
                $existingRecord = Databank::where('titre', $title)->first();
                
                if (!$existingRecord) {
                    // Insertion dans la base de données
                    Databank::create([
                        'slug' => Str::slug(Str::limit($title, 50)),
                        'titre' => $title,
                        'description' => $description,
                        'type_opportunity_id' => 1,
                        'prescripteur_id' => 1,
                        'pays_partner_id' => 1,
                        'source' => 'https://www.bceao.int' . $link,
                        'deadline' => $deadline,
                    ]);

                    echo "Titre inséré: " . $title . "\n";
                } else {
                    echo "Titre déjà existant: " . $title . "\n";
                }
            } else {
                // Si la date limite est passée, ne pas insérer
                echo "Date limite dépassée pour: " . $title . "\n";
            }
        });
    }

    // Fonction pour convertir les mois français en anglais
    private function convertFrenchDateToEnglish($date)
    {
        $frenchMonths = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];
        $englishMonths = [
            'January', 'February', 'March', 'April', 'May', 'June', 
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return str_replace($frenchMonths, $englishMonths, $date);
    }



    /**
     * Display a listing of the Abonnement.
     */
    public function index(Request $request)
    {
        /** @var Abonnement $abonnements */
        $abonnements = Abonnement::paginate(10);

        return view('abonnements.index')
            ->with('abonnements', $abonnements);
    }


    /**
     * Show the form for creating a new Abonnement.
     */
    public function create()
    {
        return view('abonnements.create');
    }

    /**
     * Store a newly created Abonnement in storage.
     */
    public function store(CreateAbonnementRequest $request)
    {
        $input = $request->all();

        /** @var Abonnement $abonnement */
        $abonnement = Abonnement::create($input);

        Flash::success('Abonnement saved successfully.');

        return redirect(route('abonnements.index'));
    }

    /**
     * Display the specified Abonnement.
     */
    public function show($id)
    {
        /** @var Abonnement $abonnement */
        $abonnement = Abonnement::find($id);

        if (empty($abonnement)) {
            Flash::error('Abonnement not found');

            return redirect(route('abonnements.index'));
        }

        return view('abonnements.show')->with('abonnement', $abonnement);
    }

    /**
     * Show the form for editing the specified Abonnement.
     */
    public function edit($id)
    {
        /** @var Abonnement $abonnement */
        $abonnement = Abonnement::find($id);

        if (empty($abonnement)) {
            Flash::error('Abonnement not found');

            return redirect(route('abonnements.index'));
        }

        return view('abonnements.edit')->with('abonnement', $abonnement);
    }

    /**
     * Update the specified Abonnement in storage.
     */
    public function update($id, UpdateAbonnementRequest $request)
    {
        /** @var Abonnement $abonnement */
        $abonnement = Abonnement::find($id);

        if (empty($abonnement)) {
            Flash::error('Abonnement not found');

            return redirect(route('abonnements.index'));
        }

        $abonnement->fill($request->all());
        $abonnement->save();

        Flash::success('Abonnement updated successfully.');

        return redirect(route('abonnements.index'));
    }

    /**
     * Remove the specified Abonnement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Abonnement $abonnement */
        $abonnement = Abonnement::find($id);

        if (empty($abonnement)) {
            Flash::error('Abonnement not found');

            return redirect(route('abonnements.index'));
        }

        $abonnement->delete();

        Flash::success('Abonnement deleted successfully.');

        return redirect(route('abonnements.index'));
    }
}
