<?php
session_start();
$alphanumeric = 'ABCDRFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
$random = substr(str_shuffle($alphanumeric), 0, 5);
$image = imagecreatefromjpeg('assets/img/captcha/background.jpg');
$textcolor = imagecolorallocate($image, 123, 255, 255);
imagestring($image, 5, 5, 8, $random, $textcolor);
$_SESSION['image_random_value'] = md5($random);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ". gmdate("D, d M Y H:i:s"). " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: image/jpeg");
imagejpeg($image);
imagedestroy($image);
