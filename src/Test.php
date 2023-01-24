<?php

  include_once(__DIR__ . '/../vendor/autoload.php');

  include_once(__DIR__ . '/Resources/Domain/DomainInterface.php');
  include_once(__DIR__ . '/RestClient.php');
  include_once(__DIR__ . '/Client.php');
  include_once(__DIR__ . '/Settings.php');

  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;

  $file_path = '/var/log/logger/godaddy.log';
  if(!is_writable($file_path)){
    print("file $file_path is not writable\n");
    die;
  }

  $logger = new Logger('godaddy');
  $logger->pushHandler(new StreamHandler($file_path, Logger::DEBUG));

  $client = new \GoDaddy\Client(GODADDY_API_KEY, GODADDY_API_SECRET, GODADDY_BASE_URL, $logger);

  // $json = $client->domain->list();
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");

  // $json = $client->domain->get('alevin.me');
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");

  // $json = $client->domain->record->list('alevin.me');
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");

  // $json = $client->domain->record->get('alevin.me', 'A', '@');
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");

  // $json = $client->domain->record->create('alevin.me', 'A', 'xxx', '78.46.66.209');
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");
  // die;

  // $json = $client->domain->record->update('alevin.me', 'A', '@', '78.46.66.209');
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");


  // $json = $client->domain->record->delete('alevin.me', 'A', 'xxx');
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");

  // $json = $client->domain->record->get('alevin.me', 'A', 'xxx');
  // $item = json_decode($json);
  // $json = json_encode($item, JSON_PRETTY_PRINT);
  // print("RESPONSE\n$json\n");

