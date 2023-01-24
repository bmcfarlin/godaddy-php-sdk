<?php

namespace GoDaddy;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class RestClient
{

  private $_api_key;
  private $_api_secret;
  private $_base_url;
  private $_logger;

  function __construct($api_key = null, $api_secret = null, $base_url = null, $logger = null)
  {
    if(empty($api_key))
    {
      $api_key = getenv('GODADDY_API_KEY');
    }

    if(empty($api_secret))
    {
      $api_secret = getenv('GODADDY_SECRET');
    }

    if(empty($base_url))
    {
      $base_url = getenv('GODADDY_API_URL');
    }

    $this->_api_key = $api_key;
    $this->_api_secret = $api_secret;
    $this->_base_url = $base_url;
    $this->_logger = $logger;
  }

  function __toString()
  {
    return get_class($this);
  }

  function get($path, $payload = [], $custom_header = [])
  {
    $url = sprintf("%s%s", $this->_base_url, $path);

    if($payload)
    {
      $url = sprintf("%s?%s", $url, http_build_query($payload));
    }

    if($this->_logger)
    {
      $this->_logger->debug('URL', [$url]);
    }

    $time = microtime();
    list($usec, $sec) = explode(' ', $time);
    $msec = $usec * 1000;
    $msec = round(floatval($msec));
    $msec = sprintf('%03d', $msec);

    $epoch_timestamp = sprintf("%s%s", $sec, $msec);
    $epoch_timestamp = intval($epoch_timestamp);

    $method = 'GET';
    if($this->_logger)
    {
      $this->_logger->debug('METHOD', [$method]);
    }

    $authorization = sprintf("sso-key %s:%s", $this->_api_key, $this->_api_secret);

    $kvps = [
      "Accept" => "application/json",
      "Authorization" => $authorization
    ];

    foreach($custom_header as $key => $value){
      $kvps[$key] = $value;
    }

    $header = [];
    foreach($kvps as $key => $value){
      $header[] = sprintf("%s:%s", $key, $value);
    }

    if($this->_logger)
    {
      $this->_logger->debug('HEADER', $header);
    }

    if($this->_logger){
      $cmd = null;
      $cmd .= "curl -v ";
      $cmd .= sprintf("-X '%s' ", $method);
      foreach($header as $hitem){
        $cmd .= sprintf("-H '%s' ", $hitem);
      }
      $cmd .= sprintf("%s", $url);
      $this->_logger->debug('CURL', [$cmd]);
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    if($this->_logger)
    {
      curl_setopt($ch, CURLOPT_HEADER, true);
    }
    
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);

    $response = curl_exec($ch);

    if($this->_logger)
    {
      $matches = [];
      preg_match_all('/(.*)\r\n\r\n(.*)/s', $response, $matches);
      $count = count($matches);
      if($count == 3){
        $response_header = $matches[1][0];
        $response = $matches[2][0];
        if(empty($response)){
          $response = "{}";
        }
      }
    }
    
    $info = curl_getinfo($ch);

    $request_header = $info['request_header'];
    $request_header = trim($request_header);
    
    if($this->_logger)
    {
      $this->_logger->debug('REQUEST_HEADER', [$request_header]);
      $this->_logger->debug('RESPONSE_HEADER', [$response_header]);
    }

    if(curl_errno($ch)){
      $response = curl_error($ch);
    }

    if($this->_logger)
    {
      $item = json_decode($response, true);
      $this->_logger->debug('RESPONSE', $item);
    }


    curl_close($ch);

    return $response;
  }
   
  function post($path, $payload = [], $custom_request = null, $custom_header = [])
  {
    $url = sprintf("%s%s", $this->_base_url, $path);

    if($this->_logger)
    {
      $this->_logger->debug('URL', [$url]);
    }

    $time = microtime();
    list($usec, $sec) = explode(' ', $time);
    $msec = $usec * 1000;
    $msec = round(floatval($msec));
    $msec = sprintf('%03d', $msec);

    $epoch_timestamp = sprintf("%s%s", $sec, $msec);
    $epoch_timestamp = intval($epoch_timestamp);

    $method = 'POST';

    if($custom_request)
    {
      if($this->_logger){
        $this->_logger->debug('CUSTOM_REQUEST', [$custom_request]);
      }
      $method = $custom_request;
    }
    
    if($this->_logger)
    {
      $this->_logger->debug('METHOD', [$method]);
    }

    if($this->_logger)
    {
      $this->_logger->debug('PAYLOAD', $payload);
    }

    $payload = json_encode($payload, JSON_UNESCAPED_SLASHES);

    $authorization = sprintf("sso-key %s:%s", $this->_api_key, $this->_api_secret);

    $kvps = [
      "Content-Type" => "application/json",
      "Accept" => "application/json",
      "Authorization" => $authorization
    ];

    foreach($custom_header as $key => $value){
      $kvps[$key] = $value;
    }

    $header = [];
    foreach($kvps as $key => $value){
      $header[] = sprintf("%s:%s", $key, $value);
    }

    if($this->_logger)
    {
      $this->_logger->debug('HEADER', $header);
    }

    if($this->_logger){
      $cmd = null;
      $cmd .= "curl -v ";
      $cmd .= sprintf("-X '%s' ", $method);
      foreach($header as $hitem){
        $cmd .= sprintf("-H '%s' ", $hitem);
      }
      $cmd .= sprintf("-d '%s' ", $payload);
      $cmd .= sprintf("%s", $url);

      $this->_logger->debug('CURL', [$cmd]);
    }

    $fields = $payload;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if($this->_logger){
      curl_setopt($ch, CURLOPT_HEADER, true);
    }
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);

    if($custom_request)
    {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom_request);
    }

    $response = curl_exec($ch);

    if($this->_logger)
    {
      $matches = [];
      preg_match_all('/(.*)\r\n\r\n(.*)/s', $response, $matches);
      $count = count($matches);
      if($count == 3){
        $response_header = $matches[1][0];
        $response = $matches[2][0];
        if(empty($response)){
          $response = "{}";
        }
      }
    }

    $info = curl_getinfo($ch);

    $request_header = $info['request_header'];
    $request_header = trim($request_header);
    
    if($this->_logger)
    {
      $this->_logger->debug('REQUEST_HEADER', [$request_header]);
      $this->_logger->debug('RESPONSE_HEADER', [$response_header]);
    }

    if(curl_errno($ch)){
      $response = curl_error($ch);
    }

    if($this->_logger)
    {
      $item = json_decode($response, true);
      $this->_logger->debug('RESPONSE', $item);
    }

    curl_close($ch);

    return $response;
  }

  function patch($path, $payload = [])
  {
    return $this->post($path, $payload, 'PATCH');
  }

  function put($path, $payload = [])
  {
    return $this->post($path, $payload, 'PUT');
  }

  function delete($path, $payload = [])
  {
    return $this->post($path, $payload, 'DELETE');
  }
}


