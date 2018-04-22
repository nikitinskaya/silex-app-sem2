<?php
  require 'vendor/autoload.php';
  use Symfony\Component\HttpFoundation\Response;

  $app = new Silex\Application();

  $app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
  });

  $app->get('/', function () {
    return '<h1>'.date("d/m/Y h:i\n").'</h1>';
  });

  $app->get('/info', function () {
    return phpinfo();;
  });

  $app->get('/author', function () {
    return new Response('<h4 id="author" title="GossJS">Вера Никитинская</h4>', 200, array(
      'Access-Control-Allow-Origin' => '*',
      'Access-Control-Allow-Methods' => 'GET,POST,DELETE',
      'Access-Control-Allow-Headers' => 'Content-Type, Access-Control-Allow-Headers'
    ));
  });

  $app->get('/print', function () {
    return new Response((file_get_contents(basename(__FILE__))), 200, array('Content-type' => 'text/plain'));
  });

  $app->get('/weather', function () {
    $URL = "https://query.yahooapis.com/v1/public/yql?q=%20select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20%20woeid%3D%222123260%22)%20and%20u%3D'c'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
    $client = new GuzzleHttp\Client();
    $response = $client->get($URL);
    $result = json_decode($response->getBody());
    return '<h1>'.$result->query->results->channel->item->forecast[1]->low.'</h1>';
  });

  $app->run();
