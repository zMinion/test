<?php

// error_reporting(E_ERROR);
// include 'connect.php';

$file = $_FILES['file']['tmp_name'];
$image = imagecreatefromjpeg($file);

// verifica upload
if (!$image) die ("<br><br><br><center><b>Please check the file submitted, the format is invalid.</b></center>");
list($width, $height, $type, $attr) = getimagesize($file);

// verifica dimensiuni
if (($width <> 1680) | ($height <> 450))  die ("<br><br><br><center><b>Please check the file submitted, the dimensions are invalid.</b></center>");
$nume =  preg_replace('/.jpeg|,|.jpg/i', '', $_FILES['file']['name']) . '_mockup.jpg';

$banner = dirname(__FILE__) . '/mockup/ocasion.jpg';
$bannerocasion = dirname(__FILE__) . '/mockup/ocasion.png';
$banner = imagecreatefromjpeg($banner);
$bannerocasion = imagecreatefrompng($bannerocasion);

imagecopymerge($banner, $image, 8, 181, 0, 0, 1680, 450, 100);

$out = imagecreatetruecolor(1700, 954);
imagecopyresampled($out, $banner, 0, 0, 0, 0, 1700, 954, 1700, 954);
imagecopyresampled($out, $bannerocasion, 0, 0, 0, 0, 1700, 954, 1700, 954);

 header("Content-type: image/jpeg");
// NOTE: Possible header injection via $basename
 header("Content-Disposition: attachment; filename=" . $nume);
 header('Content-Transfer-Encoding: binary');
 header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
 
imagejpeg($out, null, 95);

// Force download of image file 
// $size = filesize($image);
// header("Content-Length: " . $size);
// fpassthru($image);

// Clear memory
 imagedestroy($banner);
 imagedestroy ($image);
 exit();

// header("Location: /done/download.php?img=$nume");
// die();
?>