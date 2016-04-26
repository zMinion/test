<?php
include 'functions.php';

$source = 0;
$flip = 0;

$font = 'tahomabd.ttf';
$fontsize = 26;

$minwidth = 700;
$maxwidth = 2048;
$minheight = 420;
$maxheight = 1229;


if (isset($_POST['chooselogo'])) {
	
	$chooselogo = filter_var($_POST['chooselogo'], FILTER_SANITIZE_NUMBER_INT);	
	if (isset($_FILES['file']['tmp_name']))
		$file = $_FILES['file']['tmp_name'];	
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
 $dimensions = checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight);

// Flip image if required (horizontal)
if ($flip)
	$image = flipImage($image, $dimensions[0], $dimensions[1], false, true);

//  Resize if needed
if ($dimensions[0] < $maxwidth)
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
}











if (isset($_POST['text'])) {
	
		$text = $_POST["text"];
	if (isset($_FILES['files']['tmp_name']))
		$files = $_FILES['files']['tmp_name'];
	if (isset($_POST['color']))
		$color = filter_var($_POST['color'], FILTER_SANITIZE_NUMBER_INT);
	if (isset($_POST['departament']))
		$departament = filter_var($_POST['departament'], FILTER_SANITIZE_NUMBER_INT);	
	
	$textimage = createText($copyright, $text, $color, $font, $fontsize, $maxwidth, $maxheight);
	
/**
if (count($files) > 1) {
	
}
else { }
*/
	foreach($files as $index => $file) {
		// Read file
		$image = imagecreatefromjpeg($files[$index]);
		$name = $_FILES['file']['name'][$index];
		
		if (!$image) die ("<br><br><br><center><b>Please check the file submitted, the format is invalid.</b></center>");
		
		// Check width(700->2028px) and height(420->1229px)
		$dimensions = checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight);

		//  Resize if needed
		if ($dimensions[0] < $maxwidth)
			$textimage = resizePng($textimage, $dimensions[0], $dimensions[1]);
		
		// Combine image with logo
		imagecopy($image, $textimage, 0, 0, 0, 0, $dimensions[0], $dimensions[1]);
		
		// Save stats in database
		if ($image)
			saveStats($departament, 0, 0, 0, $copyright, $color);
			
		// Force download image
		header("Content-Type: image/jpeg");
		// NOTE: Possible header injection via $basename
		header("Content-Disposition: attachment; filename=" . $name);
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		
		// Compress image 95/100
		imagejpeg($image, null, 95);			
	}
	
}
?>
