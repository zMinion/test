<?php

if (isset($_FILES['file']['tmp_name'])) 
	$file = $_FILES['file']['tmp_name'];
/* Work in progress 
 * if (isset($_FILES['files']['tmp_name'])) 
 *	$file = $_FILES['files']['tmp_name'];
*/
if (isset($_POST['chooselogo'])) 
	$chooselogo = $_POST['chooselogo'];
if (isset($_POST['source'])) 
	$source = $_POST['source'];
if (isset($_POST['departament'])) 
	$departament = $_POST['departament'];
if (isset($_POST['flip'])) 
	$flip = $_POST['flip'];

$logo = dirname(__FILE__) . '/logo/' . $chooselogo . '.png';
	
// Read logo
$logo = imagecreatefrompng($logo);

// Read file
$image = imagecreatefromjpeg($file);
if (!$image) die ("<br><br><br><center><b>Please check the file submitted, the format is invalid.</b></center>");

// Check width and height
$dimensions = checkDimensions($image, 700, 2048, 420, 1229);

// Flip image if required (horizontal)
if ($flip)
	$image = flipImage($image, $dimensions["width"], $dimensions["height"], false, true);

//  Resize if needed
if ($dimensions["width"] < 2048)
	$logo = resizePng($logo, $dimensions["width"], $dimensions["height"]);

// Combine image with logo
imagecopy($image, $logo, 0, 0, 0, 0, $dimensions["width"], $dimensions["height"]);

// Rename the file
$name = renameImage($_FILES['file']['name'], $source);

// Force download image
header("Content-type: image/jpeg");
// NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $name);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

// Compress image 95/100
imagejpeg($image, null, 95);

// Save stats in database
if ($image)
	saveStats($departament, $chooselogo, $source, $flip);

// Clear memory
imagedestroy($logo);
imagedestroy ($image);
exit();

?>