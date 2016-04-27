<?php

// Verifica dimeniuni design
function checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight) {
	$width = imagesx($image);
	$height = imagesy($image);
	$resize = FALSE;
	if ($width < $minwidth || $width > $maxwidth || $height < $minheight || $height > $maxheight)
		handleError(1);
	if (($width >= $minwidth && $width < $maxwidth) || ($height >= $minheight || $height < $maxheight))
		$resize = TRUE;
	return array($width, $height, $resize);
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

// Nume Poze: 0 - logo / 1 - getty 
function renameImage($name, $source=0) {
	if ($source) 
		$name =  preg_replace('/.jpeg|,|.jpg/i', '', $name) . '_badged.jpg';
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

function showStats() {
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
	$maximages = $mysqli->query("SELECT max(id) as id FROM images")->fetch_object()->id; 
	$mysqli->close();
	
	return $maximages;
}

// create text
function createText($text, $color, $font, $fontsize, $maxwidth, $maxheight){
	$dims = imagettfbbox($fontsize, 0, $font, $text);
	$bbox_height = $dims[3] - $dims[5]; 
	$bbox_width = $dims[4] - $dims[0]; 
	$copyright = imagecreatetruecolor($maxwidth, $maxheight);
	imagealphablending($copyright, false);
	imagesavealpha($copyright, true);
	// background color
	$bgcolor = imagecolorallocatealpha($copyright, 255,255,255, 127);
	// font color
	if ($color) 
		$fontcolor = imagecolorallocate($copyright, 255, 255, 255);
	else
		$fontcolor = imagecolorallocate($copyright, 0, 0, 0);
	imagefilledrectangle($copyright, 0, 0, $maxwidth, $maxheight, $bgcolor);
	$x = $maxwidth - $bbox_width - 90; 
	$y = $maxheight - $bbox_height + $fontsize - 50;
	imagettftext($copyright, $fontsize, 0, $x, $y , $fontcolor, $font, chr(169) . ' ' . $text);

	return $copyright;
}

// Error handler
function handleError($id) {
	header('Location: http://' . $_SERVER[HTTP_HOST] . 'error.php?id=' . $id);
	die();
}
/**
* 1 - Image dimensions
* 2 - Invalid image uploaded
* display errors
*/
function showError($id) {
	
	switch ($id) {
		case "1":
        $title ="Image dimensions";
		$text ="Please check image dimensions! <br>Dimensions: min-700x420px / max-2048x1229px Ratio 5:3 <br><b>Edit this image in Photoshop and try again!</b>";
        break;
		case "2":
        $title ="2";
		$text ="2";
        break;
		case "3":
        $title ="3";
		$text ="3";
        break;
		default:
        $title ="Incorrect error id";
		$text ="An error is an action which is inaccurate or incorrect. In some usages, an error is synonymous with a mistake, though in technical contexts the two are often distinguished.";
	}	

	return array($title,$text);
}
?>
