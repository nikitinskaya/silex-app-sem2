<?php
require 'vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
  return 'Hello '.$app->escape($name);
});

$app->get('/', function () {
  date_default_timezone_set('Europe/Moscow');
  return '<h1>'.date("d/m/Y h:i\n").'</h1>';
});

$app->get('/info', function () {
  return phpinfo();;
});

$app->get('/author', function () {
  return '<h4 id="author" title="GossJS">Вера Никитинская</h4>';
})->after(function (Request $request, Response $response) {
  $response->headers->set('Access-Control-Allow-Origin', '*');
  $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,DELETE');
  $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers');
});

$app->get('/print', function () {
  return (file_get_contents(basename(__FILE__)));
})->after(function (Request $request, Response $response) {
  $response->headers->set('Content-type', 'text/plain');
  $response->headers->set('Access-Control-Allow-Origin', '*');
  $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,DELETE');
  $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers');
});

$app->get('/weather', function () {
  $URL = "https://query.yahooapis.com/v1/public/yql?q=%20select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20%20woeid%3D%222123260%22)%20and%20u%3D'c'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
  $client = new GuzzleHttp\Client();
  $response = $client->get($URL);
  $result = json_decode($response->getBody());
  return '<h1>'.$result->query->results->channel->item->forecast[1]->low.'</h1>';
});

$app->post('/byte', function() {
  return pack("C*", (~(unpack("C*", file_get_contents("php://input"))[1])));
})->after(function (Request $request, Response $response) {
  $response->headers->set('Access-Control-Allow-Origin', '*');
  $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,DELETE');
  $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers');
});

$app->get('/rates', function () {
  $rates = json_decode(file_get_contents('https://kodaktor.ru/j/rates'));

  $h = 0;
  for($i = 0; $i < count($rates); $i++) {
    $h = max($rates[$i] -> sell,$h);
  };

  $w = 600;
  $colw = $w / count($rates);

  $pad = 5;

  $ctx = imagecreate($w, $h);

  $pink = imagecolorallocate ($ctx, 0xff,0xb6,0xc1);
  $white = imagecolorallocate ($ctx, 0xff,0xff,0xff);
  $black = imagecolorallocate ($ctx, 0x00,0x00,0x00);

  imagefilledrectangle($ctx,0,0,$w,$h,$white);

  array_walk($rates, function($x, $i) use ($colw, $ctx, $h, $pink, $black, $pad){

    $x1 = $i * $colw;
    $y1 = $h - ($x -> sell);
    $x2 = (($i + 1) * $colw) - $pad;
    $y2 = $h;
    imagefilledrectangle($ctx, $x1, $y1, $x2, $y2, $pink);

    $n = (string)$x -> name;
    $font = 'Arial.ttf';

    $boxa = imagettfbbox(8, 0, $font, $n)[0];
    $boxb = imagettfbbox(8, 0, $font, $n)[2];
    $offset = $x1 + ($colw / 2 ) - (($boxb - $boxa) / 2);

    imagettftext($ctx, 8, 0, $offset, $y2 - 2, $black, $font, $n);
  });
  return imagepng($ctx);
})->after(function (Request $request, Response $response) {
  $response->headers->set('Content-type', 'image/png');
  $response->headers->set('Access-Control-Allow-Origin', '*');
  $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,DELETE');
  $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers');
});

$app->run();
