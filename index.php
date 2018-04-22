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

  $app->run();
