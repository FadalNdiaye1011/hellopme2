<?php

namespace App\Console\Commands;

use App\Models\Databank;
use App\Models\Websitelinck;
use Illuminate\Console\Command;
use App\Models\Scrap;
use Goutte\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ScrapeOpportunityData extends Command
{
    protected $signature = 'ScrapeOpportunityData';
    protected $description = 'Scrape opportunity data from websites';

    public function handle()
    {
        $client = new Client();
        $websites = Websitelinck::all();

        foreach ($websites as $website) {
            $this->scrapeWebsite($client, $website);
        }

        return 0;
    }

    /**
     * Scrape a specific website and process its content
     */
    private function scrapeWebsite(Client $client, Websitelinck $website)
    {
        try {
            $crawler = $client->request('GET', $website->url);

            // Log the raw HTML content for debugging purposes
            \Log::info("HTML fetched from URL {$website->url}: " . $crawler->html());

            // Check if the content wrapper contains data
            if ($crawler->filter($website->content_wrapper)->count() === 0) {
                $this->warn("No data found for selector {$website->content_wrapper}");
                return;
            }

            // Process each node found within the content wrapper
            $crawler->filter($website->content_wrapper)->each(function ($node) use ($website) {
                $this->processNode($node, $website);
            });

        } catch (\Exception $e) {
            \Log::error("Scraping failed for URL: {$website->url}. Error: {$e->getMessage()}");
        }
    }

    /**
     * Process a single node within the scraped content
     */
    private function processNode($node, Websitelinck $website)
{
    $title = $this->extractText($node, $website->title_selector);
    $detailPageUrl = $this->extractAttribute($node, 'a', 'href');

    // Vérification des données extraites
    $this->info("Title: $title");
    $this->info("Detail Page URL: $detailPageUrl");

    if (!$title || !$detailPageUrl) {
        $this->warn("Missing title or detail URL");
        return;
    }

    // Vérifie si l'enregistrement existe déjà
    $existingRecord = Databank::where('titre', $title)->first();
    if ($existingRecord) {
        $this->info("Record with title '$title' already exists. Skipping.");
        return;
    }

    // Récupère le contenu de la page de détail
    $detailContent = $this->fetchDetailContent($detailPageUrl, $website->detail_page_content_selector);
    $this->info("Detail Content: $detailContent");

    // Enregistre l'opportunité dans la base de données
    Databank::create([
        'slug' => Str::slug(Str::limit($title, 20)),
        'titre' => $title,
        'description' => $detailContent,
        'type_opportunity_id' => $website->type_opportunity_id,
        'prescripteur_id' => $website->prescripteur_id,
        'pays_partner_id' => $website->pays_partner_id,
        'image_url' => $this->extractAttribute($node, $website->image_url, 'src'),
        'source' => $website->url,
    ]);

    $this->info("Title: $title added to databank.");
}


    /**
     * Fetch detailed content from the detail page
     */
    private function fetchDetailContent($url, $selector)
    {
        try {
            $response = Http::get($url);
            if ($response->successful()) {
                $crawler = new \Symfony\Component\DomCrawler\Crawler($response->body());
                return $crawler->filter($selector)->text();
            }
        } catch (\Exception $e) {
            \Log::error("Failed to fetch detail content from URL: $url. Error: {$e->getMessage()}");
        }

        return null;
    }

    /**
     * Extract text from a specific node using a selector
     */
    private function extractText($node, $selector)
    {
        return $selector ? $node->filter($selector)->text() : null;
    }

    /**
     * Extract an attribute from a specific node using a selector
     */
    private function extractAttribute($node, $selector, $attribute)
    {
        return $selector ? $node->filter($selector)->attr($attribute) : null;
    }
}
