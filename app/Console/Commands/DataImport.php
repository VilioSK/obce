<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use App\Models\City;

class DataImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import city details';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url_okres = 'https://www.e-obce.sk/kraj/NR.html';

        $dom_kraj = HtmlDomParser::file_get_html( $url_okres );
        foreach($dom_kraj->find('b') as $dom_kraj_b)
        {
            if(strstr($dom_kraj_b, 'OKRES:'))
            {
                $dom_kraj_items = $dom_kraj_b->find_ancestor_tag('td');

                foreach($dom_kraj_items->find('a') as $dom_kraj_item)
                {
                    $dom_okres = HtmlDomParser::file_get_html( $dom_kraj_item->getAttribute('href'));
                    foreach($dom_okres->find('b') as $dom_okres_b)
                    {
                        if(strstr($dom_okres_b, 'Vyberte si obec alebo mesto z okresu'))
                        {
                            // get table with city list
                            $dom_okres_table = $dom_okres_b->next_sibling();
                            $dom_okres_item = $dom_okres_table->find('a', 0);
                            
                            foreach($dom_okres_table->find('a') as $dom_okres_item)
                            {
                                // ignore incorrect node
                                if(strstr($dom_okres_item, 'Inzercia v okrese') == true) continue;

                                // check if entry exists in database
                                $obec_name = City::where('name', $dom_okres_item->text())->exists();
                                if($obec_name == false)
                                {
                                    $dom_obec = HtmlDomParser::file_get_html( $dom_okres_item->getAttribute('href') );

                                    // create new city 
                                    $city = new City();
                                    $city->name = $dom_okres_item->text();
                                    
                                    // get city data
                                    $dom_obec_temp = $dom_obec->find('div.adbox', 0);
                                    $dom_obec_table = $dom_obec_temp->next_sibling();
                                    
                                    // find telephone
                                    $dom_obec_phone = $dom_obec_table->find('tr', 3);
                                    $city->phone = $dom_obec_phone->find('td', 4)->text();
                                    // find fax
                                    $dom_obec_fax = $dom_obec_table->find('tr', 5);
                                    $city->fax = $dom_obec_fax->find('td', 2)->text();
                                    // find email and address
                                    $dom_obec_email = $dom_obec_table->find('tr', 6);
                                    $city->address = $dom_obec_email->find('td', 0)->text();
                                    $city->email = $dom_obec_email->find('td', 2)->text();
                                    // find address and web
                                    $dom_obec_address = $dom_obec_table->find('tr', 7);
                                    $city->address .= ", ".$dom_obec_address->find('td', 0)->text();
                                    $city->web_url = $dom_obec_address->find('td', 2)->text();
                                    // find mayor
                                    $dom_obec_table = $dom_obec_table->next_sibling();
                                    $dom_obec_table = $dom_obec_table->next_sibling();
                                    $dom_obec_mayor = $dom_obec_table->find('tr', 7);
                                    $city->mayor = $dom_obec_mayor->find('td', 1)->text();
       
                                    $city->save();
                                }
                            } 
                        }
                    }
                }
            }
        }
       
        return Command::SUCCESS;
    }
}
