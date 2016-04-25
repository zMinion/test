<?php
include 'functions.php';

$source = 0;
$flip = 0;

if (isset($_FILES['file']['tmp_name'])) 
	$file = $_FILES['file']['tmp_name'];
if (isset($_POST['chooselogo'])) 
	$chooselogo = filter_var($_POST['chooselogo'], FILTER_SANITIZE_NUMBER_INT);
if (isset($_POST['source'])) 
	$source = filter_var($_POST['source'], FILTER_SANITIZE_NUMBER_INT);
if (isset($_POST['departament'])) 
	$departament = filter_var($_POST['departament'], FILTER_SANITIZE_NUMBER_INT);
if (isset($_POST['flip'])) 
	$flip = filter_var($_POST['flip'], FILTER_SANITIZE_NUMBER_INT);

$logo = dirname(__FILE__) . '/logo/' . $chooselogo . '.png';
	
// Read logo
$logo = imagecreatefrompng($logo);

// Read file
$image = imagecreatefromjpeg($file);
if (!$image) die ("<br><br><br><center><b>Please check the file submitted, the format is invalid.</b></center>");

// Check width(700->2028px) and height(420->1229px)
 $dimensions = checkDimensions($image, 700, 2048, 420, 1229);

// Flip image if required (horizontal)
 if ($flip)
	$image = flipImage($image, $dimensions[0], $dimensions[1], false, true);

//  Resize if needed
 if ($dimensions[0] < 2048)
	$logo = resizePng($logo, $dimensions[0], $dimensions[1]);

// Combine image with logo
imagecopy($image, $logo, 0, 0, 0, 0, $dimensions[0], $dimensions[1]);


// Save stats in database
if ($image)
	saveStats($departament, $chooselogo, $source, $flip);

// Rename the file
$name = renameImage($_FILES['file']['name'], $source);

// Force download image
header("Content-Type: image/jpeg");
// NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $name);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

// Compress image 95/100
imagejpeg($image, null, 95);
?>
