<?php
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

  header ("Content-type: image/png");
  imagepng($ctx);
?>
