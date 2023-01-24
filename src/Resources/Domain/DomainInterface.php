<?php

namespace GoDaddy\Resources\Domain;

use GoDaddy\Resources\Record\RecordInterface;

class DomainInterface
{

  private $_client;

  function __construct($client)
  {
    $this->_client = $client;
    $this->record = new RecordInterface($client);
  }

  function __toString()
  {
    return get_class($this);
  }

  public function list($limit = 200, $marker = null)
  {
    $url = "/v1/domains";
    $data = ['limit' => $limit, 'marker' => $marker];
    return $this->_client->get($url, $data);
  }

  public function get($domain)
  {
    $url = "/v1/domains/$domain";
    return $this->_client->get($url);
  }

}

