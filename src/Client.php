<?php

namespace GoDaddy;

use GoDaddy\Resources\Domain\DomainInterface;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Client
{
  private $_domain;
  private $_client;

  function __construct($api_key, $api_secret, $base_url, $logger = null)
  {
    $this->_client = new RestClient($api_key, $api_secret, $base_url, $logger);
  }

  function __toString()
  {
    return get_class($this);
  }

  public function __get($name)
  {
    $name = ucfirst($name);
    $method = sprintf("get%s", $name);
    if(method_exists($this, $method))
    {
      return $this->$method();
    }
    throw new \Exception('Unknown resource ' . $name);
  }

  function getDomain()
  {
    if(empty($this->_domain))
    {
      $this->_domain = new DomainInterface($this->_client);
    }
    return $this->_domain;
  }


}
