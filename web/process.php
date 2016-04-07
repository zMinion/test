<?php

include 'connect.php';

$file = $_FILES['file']['tmp_name'];

$chooselogo = $_POST['chooselogo'];
$departament = $_POST['departament'];

$flip = 0;
if (isset($_POST['flip']))
	$flip = 1;

$mpi = 1;
if (isset($_POST['source']) &&   $_POST['source'] == 'stock')
	$mpi = 2;	

$logo = dirname(__FILE__) . '/logo/' . $_POST['chooselogo'];

// Functie resize watermark
function resizePng($im, $dst_width, $dst_height) {
    $width = imagesx($im);
    $height = imagesy($im);
    $newImg = imagecreatetruecolor($dst_width, $dst_height);
    imagealphablending($newImg, false);
    imagesavealpha($newImg, true);
    $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
    imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
    imagecopyresampled($newImg, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
    return $newImg;
}

function flipImage($image, $vertical, $horizontal) {
    $w = imagesx($image);
    $h = imagesy($image);
    if (!$vertical && !$horizontal) return $image;
    $flipped = imagecreatetruecolor($w, $h);
    if ($vertical) {
      for ($y=0; $y<$h; $y++) {
        imagecopy($flipped, $image, 0, $y, 0, $h - $y - 1, $w, 1);
      }
    }
    if ($horizontal) {
      if ($vertical) {
        $image = $flipped;
        $flipped = imagecreatetruecolor($w, $h);
      }
      for ($x=0; $x<$w; $x++) {
        imagecopy($flipped, $image, $x, 0, $w - $x - 1, 0, 1, $h);
      }
    }
    return $flipped;
}
	
// Informatii watermark
$watermark = imagecreatefrompng($logo);

// Image size
list($newwidth, $newheight, $type, $attr) = getimagesize($file);

// Verifica dimeniuni design
if ($newwidth < 700 || $newwidth > 2048 || $newheight < 420 || $newheight > 1229) { echo "<META http-equiv='refresh' content='3;URL=http://dfdesign.xyz/'><link rel='stylesheet' type='text/css' href='/css/style.css'><div id='fail'><img src='/img/fail.png' width='390px'><br><br><br><b>Error! Please check image dimensions! <b><br><br> Dimensions: min 700x420px  / max - 2048x1229px<br>Ratio 5:3 <br>Edit this image in Photoshop! </div>", date('Y-m-d H:i:s'); die(); }
else {
	 $mysqli->query("INSERT INTO images (date, departament, logo, source, flip) VALUES (CURDATE(), '$departament', '$chooselogo', '$mpi', '$flip')");
}

// Verifica dimensiuni pentru resize
if ($newwidth < 2048)
$watermark = resizePng ($watermark, $newwidth, $newheight);
$watermark_x = imagesx($watermark);
$watermark_y = imagesy($watermark);

// Nume Poze
if (isset($_POST['source']) &&   $_POST['source'] == 'stock') 
    $nume =  preg_replace('/.jpeg|,|.jpg/i', '', $_FILES['file']['name']) . '_badged.jpg';
else
    $nume =  preg_replace('/.jpeg|,|.jpg/i', '', $_FILES['file']['name']) . '_logo.jpg';

mysqli_close($mysqli);

// Aplica watermark
$image = imagecreatefromjpeg($file);
if (!$image) die ("<br><br><br><center><b>Please check the file submitted, the format is invalid.</b></center>");
// Flip it horizontally
if (isset($_POST['flip']))
	$image = flipImage($image,0,1);

imagecopy($image, $watermark, round(imagesx($image) / 2) - round($watermark_x / 2), round(imagesy($image) / 2) - round($watermark_y / 2), 0, 0, $watermark_x, $watermark_y);

header("Content-type: image/jpeg");
 // NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $nume);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
 
imagejpeg($image, null, 95);

// Force download of image file 
// $size = filesize($image);
// header("Content-Length: " . $size);
// fpassthru($image);

// Clear memory
 imagedestroy($watermark);
 imagedestroy ($image);
 exit();

// header("Location: /done/download.php?img=$nume");
// die();
?>