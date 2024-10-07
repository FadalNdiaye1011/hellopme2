<?php

namespace App\Console\Commands;

use App\Models\Websitelinck;
use Illuminate\Console\Command;
use App\Models\Scrap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\Databank;

class ScrapNationUnis extends Command
{
    protected $signature = 'ScrapNation_Unis';
    protected $description = 'Scrape opportunity data from websites';

    public function handle()
    {
       // Créer une instance du client HTTP Symfony
    $symfonyClient = HttpClient::create([
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36',
        ],
    ]);

    // Créer une instance de Goutte avec le client Symfony
    $client = new Client($symfonyClient);

    // Accéder à la page à scraper
    $crawler = $client->request('GET', 'https://procurement-notices.undp.org/');

    // Parcourir chaque groupe de divs correspondant à une notice
    $crawler->filter('.vacanciesTable__row')->each(function ($row) {
        // Récupérer les divs qui contiennent les informations
        $cells = $row->filter('.vacanciesTable__cell span');

        // Vérifier si on a bien au moins six cellules (titre, ref, undp, procurement, deadline, posted)
        if ($cells->count() >= 6) {
            // Extraire les données en fonction de la position des divs
            $title = $cells->eq(0)->text();  // Premier div : Titre
            $ref = $cells->eq(1)->text();     // Deuxième div : ref
            $undp = $cells->eq(2)->text(); // Troisième div : undp
            $procurement = $cells->eq(3)->text();  // quatrieme div : procurement
            $deadline = $cells->eq(4)->text();     // cinquieme div : deadline
            $posted = $cells->eq(5)->text(); // sixieme div : $posted
    
            // Créer une description combinée
            $description = "Title: " . $title . " | Ref: " . $ref . " | UNDP: " . $undp . " | Procurement Process: " . $procurement . " | Deadline: " . $deadline . " | Posted: " . $posted;

            // Vérifier si le titre existe déjà dans la base de données
            $existingRecord = Databank::where('titre', $title)->first();
            
            // Si le titre n'existe pas, on insère les données
            if (!$existingRecord) {
                Databank::create([
                    'slug' => Str::slug(Str::limit($title, 20)),
                    'titre' => $title,
                    'description' => $description,
                    'type_opportunity_id' => 1,
                    'prescripteur_id' => 1,
                    'pays_partner_id' => 1,
                    'source' => 'https://procurement-notices.undp.org/',
                    'deadline' => $deadline,
                ]);

                echo "Titre inséré: " . $title . "\n";
            } else {
                // Sinon, on peut afficher un message ou ignorer
                echo "Titre déjà existant: " . $title . "\n";
            }
        }
    });

        return 0;
    }
}
