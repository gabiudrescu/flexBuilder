<?php
/**
 * Created by PhpStorm.
 * User: gabiudrescu
 * Date: 01.12.2017
 * Time: 22:43
 */

namespace AppBundle\Crawler;


use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class SymfonySh
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->page = $this->client->request('GET', 'https://symfony.sh/');
    }

    public function extractComponentData()
    {
        $elements = $this->page->filter('#recipes > li')->each(function (Crawler $node){
            $name = $node->filter('h2')->text();
            $type = $node->filter('p > span')->text();
            $package = $node->filter('p > a.icon--package')->attr('href');
            $alias = $node->filter('p:nth-child(3)')->count() === 1 ? $node->filter('p:nth-child(3) > span:nth-child(2)')->text() : null;

            $return = [
                'name' => $name,
                'type' => $type,
                'package' => $package,
                'output' => $alias
            ];

            return $return;
        });

        return $elements;
    }
}
