<?php

// Verifica dimeniuni design
function checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight) {
	$width = imagesx($image);
	$height = imagesy($image);
	if ($width < $minwidth || $width > $maxwidth || $height < $minheight || $height > $maxheight)
		die("Eroare dimensiuni");
	return array($width, $height);
}

// Flip la fundal
function flipImage($image, $width, $height, $vertical, $horizontal) {
	if (!$vertical && !$horizontal) return $image;
	$flipped = imagecreatetruecolor($width, $height);
	if ($vertical) {
	  for ($y=0; $y<$height; $y++) {
		imagecopy($flipped, $image, 0, $y, 0, $height - $y - 1, $width, 1);
	  }
	}
	if ($horizontal) {
	  if ($vertical) {
		$image = $flipped;
		$flipped = imagecreatetruecolor($width, $height);
	  }
	  for ($x=0; $x<$width; $x++) {
		imagecopy($flipped, $image, $x, 0, $width - $x - 1, 0, 1, $height);
	  }
	}
	return $flipped;
}

// Resize png
function resizePng($logo, $dst_width, $dst_height) {
	$width = imagesx($logo);
	$height = imagesy($logo);
	$newlogo = imagecreatetruecolor($dst_width, $dst_height);
	imagealphablending($newlogo, false);
	imagesavealpha($newlogo, true);
	$transparent = imagecolorallocatealpha($newlogo, 255, 255, 255, 127);
	imagefilledrectangle($newlogo, 0, 0, $width, $height, $transparent);
	imagecopyresampled($newlogo, $logo, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
	return $newlogo;
}

// Nume Poze: 0 - logo / 1 - getty / 2 - mockup
function renameImage($name, $source) {
	if ($source == 1) 
		$name =  preg_replace('/.jpeg|,|.jpg/i', '', $name) . '_badged.jpg';
	else if ($source == 2)
		$name =  preg_replace('/.jpeg|,|.jpg/i', '', $name) . '_mockup.jpg';
	else
		$name =  preg_replace('/.jpeg|,|.jpg/i', '', $name) . '_logo.jpg';	
		
	return $name;
}

/** Save stats
*   departament 1 - travel / 2 - goods
*   source 0 - logo / 1 - getty / 2 - mockup
*   flip 0 - false / 1 - true
*   copyright 0 - false / 1 - true
*   color 0 - black / 1 - white
*/ 

function saveStats($departament, $logo=null, $source=0, $flip=0, $copyright=0, $color=0) {
$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);
$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');
// Create connection
$mysqli = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}
if ($logo)
	$mysqli->query("INSERT INTO images (date, departament, logo, source, flip) VALUES (CURDATE(), '".mysqli_real_escape_string($mysqli, $departament)."', '".mysqli_real_escape_string($mysqli, $logo)."', '".mysqli_real_escape_string($mysqli, $source)."', '".mysqli_real_escape_string($mysqli, $flip)."')");
if ($copyright)
	$mysqli->query("INSERT INTO images (date, departament, copyright, color) VALUES (CURDATE(), '".mysqli_real_escape_string($mysqli, $departament)."', '".mysqli_real_escape_string($mysqli, $copyright)."', '".mysqli_real_escape_string($mysqli, $color)."')");
mysqli_close($mysqli);
}
?>
