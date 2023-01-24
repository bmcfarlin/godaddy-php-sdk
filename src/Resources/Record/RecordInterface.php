<?php

namespace GoDaddy\Resources\Record;

class RecordInterface
{

  private $_client;

  function __construct($client)
  {
    $this->_client = $client;
  }

  function __toString()
  {
    return get_class($this);
  }

  public function list($domain, $offset = 0, $limit = 100)
  {
    $url = "/v1/domains/$domain/records";
    $data = ['offset' => $offset, 'limit' => $limit];
    return $this->_client->get($url, $data);
  }

  public function get($domain, $type, $name, $offset = 0, $limit = 100)
  {
    $url = "/v1/domains/$domain/records/$type/$name";
    $data = ['offset' => $offset, 'limit' => $limit];
    return $this->_client->get($url, $data);
  }

  public function create($domain, $type, $name, $data, $ttl = 600){
    $url = "/v1/domains/$domain/records";
    $data = ['type' => $type, 'name' => $name, 'data' => $data, 'ttl' => $ttl];
    $data = [$data];
    return $this->_client->patch($url, $data);
  }

  public function update($domain, $type, $name, $data, $ttl = 600){
    $url = "/v1/domains/$domain/records/$type/$name";
    $data = ['data' => $data, 'ttl' => $ttl];
    $data = [$data];
    return $this->_client->put($url, $data);
  }

  public function delete($domain, $type, $name){
    $url = "/v1/domains/$domain/records/$type/$name";
    return $this->_client->delete($url);
  }

}

