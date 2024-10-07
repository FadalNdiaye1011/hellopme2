<?php

namespace App\Console\Commands;

use App\Models\Databank;
use App\Models\Opportunity;
use App\Models\WebsiteLink;
use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
class ScrapeOpportunity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ScrapeOpportunity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape opportunity data from websites';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // \Log::info('Scraping process started.');
        $this->info('Scraping process started.');

        $client = new Client();
        $websites = WebsiteLink::all();

        foreach ($websites as $website) {
            $url = $website->url;
            $content_wrapper =  $website->content_wrapper;
            try {
                $crawler = $client->request('GET', $url);
                if($crawler->filter($content_wrapper)->count() > 0){
                    $crawler->filter($content_wrapper)->each(function ($node) use ($website) {

                        $title = !is_null($website->title_selector) ? $node->filter($website->title_selector)->text() : null;
                        $deadline = !is_null($website->deadline_selector) ? $node->filter($website->deadline_selector)->text() : null;
                        $started_at_selector = !is_null($website->started_at_selector) ? $node->filter($website->started_at_selector)->text() : null;
                        $image_url = !is_null($website->image_url) ? $node->filter($website->image_url)->attr('src') : null;
                        $detailPageContent = '';

                            $detailPageUrl = $node->filter('a')->attr('href');

                            $detailPageResponse = Http::get($detailPageUrl);

                            if ($detailPageResponse->successful()) {
                                $detailPageCrawler = new \Symfony\Component\DomCrawler\Crawler($detailPageResponse->body());
                                $detailPageContent = $detailPageCrawler->filter($website->detail_page_content_selector)->text();
                                $this->output->writeln("Description: " . $detailPageContent);
                            }
                        $slug = Str::limit($title, 20);

                        $existingRecord = Databank::where('titre', $title)->first();

                        if ($existingRecord) {
                            $this->info("Record with title $slug already exists. Skipping creation.");
                        } else {
                            Databank::create([
                                'slug' => Str::slug($slug),
                                'titre' => $title,
                                'description' => $detailPageContent,
                                'type_opportunity_id' => $website->type_opportunity_id,
                                'prescripteur_id' => $website->prescripteur_id,
                                'pays_partner_id' => $website->pays_partner_id,
                                'image_url' => $image_url,
                                'source' => $website->url,
                            ]);
                        }
                        $this->output->writeln("Titre: " . $title);
                    });

                }else{
                    $this->info("Wanring: Le selecteur $content_wrapper. ne contient pas de données. Vérifier que c'est un bon selecteur");
                }
            } catch (\InvalidArgumentException $e) {
                $this->info("Scraping failed for URL: $url. Error: " . $e->getMessage());
            }
        }

        return 0;
    }

}
