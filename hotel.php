<?php
include_once 'vendor/autoload.php';
use Goutte\Client;
$client = new Client();
$crawler = $client->request('GET', 'http://www.tripadvisor.com/Hotels-g664891-Macau-Hotels.html');
$status_code = $client->getResponse()->getStatus();
$a_contents = array();
$crawler->filter('.property_title')->each(
  function(Symfony\Component\DomCrawler\Crawler $node, $i) use(&$a_contents) {
    $a_contents[$i]['hotel'] = trim($node->text());
    $a_contents[$i]['href'] = trim($node->attr('href'));
  }
);

include_once 'vendor/autoload.php';
$client = new Client();
$crawler = $client->request('GET', 'http://www.symfony.com/blog/');
$link = $crawler->selectLink('Security Advisories')->link();
$crawler = $client->click($link);
$crawler->filter('h2.post > a')->each(function ($node) {
  print $node->text()."\n";
});
