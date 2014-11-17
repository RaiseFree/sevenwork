<?php
include_once 'vendor/autoload.php';
include_once 'lib/HotelIndex.class.php';
include_once 'lib/Review.class.php';

$hotelIndex = new HotelIndex('http://www.tripadvisor.com/Hotels-g664891-Macau-Hotels.html');

$status_code = $hotelIndex->take();
$pageindex = 1;
if ($status_code == 200) {
  $hotelInfos = $hotelIndex->getHotels();
  var_dump('page '.$pageindex.' include Hotels :'.count($hotelInfos));
  while($hotelIndex->next() == 200){
    $pageindex++;
    $hotelInfos = $hotelIndex->getHotels();
    var_dump('page '.$pageindex.' include Hotels :'.count($hotelInfos));
  }
}
