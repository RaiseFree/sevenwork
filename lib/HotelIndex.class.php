<?php
include_once 'Page.class.php';
/**
 * 
 **/
class HotelIndex extends Page
{
  public function getHotels()
  {
    $hotelInfos = array();
    $this->_crawler->filter('.property_title')->each(
      function(Symfony\Component\DomCrawler\Crawler $node, $i) use(&$hotelInfos) {
        $hotelInfos[$i]['hotel'] = trim($node->text());
        $hotelInfos[$i]['href'] = trim($node->attr('href'));
      }
    );

    return $hotelInfos;
  }
}
