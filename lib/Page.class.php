<?php
/**
 * 
 **/
use Goutte\Client;
class Page
{
  protected $_page_object = null;
  protected $_client = null;
  protected $_crawler = null;
  protected $_url = null;

  function __construct($url) {
    $this->_client = new Client();
    if (empty($url)) { throw new Exception('not url been input'); }
    $this->_url = $url;
  }

  public function getPage() {
    return $this->_crawler;
  }

  public function setUrl($url) {
    $this->_url = $url;
  }

  public function take() {
    $crawler = $this->_client->request('GET', $this->_url);
    $status_code = $this->_client->getResponse()->getStatus();
    if ($status_code == 200) {
      $this->_crawler = $crawler;
    } else {
      $this->_crawler = null;
    }
    return $status_code;
  }

  public function next($link = '»') {
    $node = $this->_crawler->selectLink($link);
    if($node->count()){
      $href = $node->attr('href');
      $nextLink = $node->link();
      $crawler = $this->_client->click($nextLink);
      $status_code = $this->_client->getResponse()->getStatus();
      if ($status_code == 200) {
        $this->_crawler = $crawler;
      } else {
        $this->_crawler = null;
      }
      return $status_code;
    }
    return null;
  }
}
