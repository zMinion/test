<?php
include 'config.php';
include 'functions.php';

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
if (($dimensions[0] < $maxwidth) || ($dimensions[1] < $maxheight))
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

// Compress image 98/100
imagejpeg($image, null, 98);
}





if (isset($_POST['text'])) {
	
		$text = $_POST["text"];
	if (isset($_FILES['files']['tmp_name']))
		$files = $_FILES['files']['tmp_name'];
	if (isset($_POST['color']))
		$color = filter_var($_POST['color'], FILTER_SANITIZE_NUMBER_INT);
	if (isset($_POST['departament']))
		$departament = filter_var($_POST['departament'], FILTER_SANITIZE_NUMBER_INT);
	
	$names = $_FILES['files']['name'];	
	$textimage = createText($text, $color, $font, $fontsize, $maxwidth, $maxheight);
	

if (count($files) > 1) {

	// Prepare ZipFile
	$zipfile = tempnam("tmp", "zip");
	$zip = new ZipArchive();
	$zip->open($zipfile, ZipArchive::OVERWRITE);

	foreach($files as $index => $file) {
	// Read file
	$image = imagecreatefromjpeg($files[$index]);
	
	if (!$image) die ("<br><br><br><center><b>Please check the file submitted, the format is invalid.</b></center>");
	
	// Check width(700->2028px) and height(420->1229px)
	$dimensions = array(imagesx($image),imagesy($image));
	
	if ($dimensions[0] < $minwidth || $dimensions[0] > $maxwidth || $dimensions[1] < $minheight || $dimensions[1] > $maxheight) { 
		$zip->addFile('./img/picture-error.jpg', 'Error - ' . $names[$index]);
	} else {
	//  Resize if needed
	if (($dimensions[0] < $maxwidth) || ($dimensions[1] < $maxheight))
		$textimage = resizePng($textimage, $dimensions[0], $dimensions[1]);
	
	// Combine image with logo
	imagecopy($image, $textimage, 0, 0, 0, 0, $dimensions[0], $dimensions[1]);

	// Save stats in database
	if ($image)
		saveStats($departament, 0, 0, 0, 1, $color);

	ob_start(); 
	// Compress image 98/100
	imagejpeg($image, null, 98);
	imagedestroy($textimage);
	imagedestroy ($image);
	$i = ob_get_clean();
	
	// Stuff with content
	$zip->addFromString($names[$index], $i);
	}
	}
		
	// Close and send to users
	$zip->close();
	header('Content-Type: application/zip');
	header('Content-Disposition: attachment; filename="images.zip"');
	readfile($zipfile);
	unlink($zipfile); 
	
}
else {
		$image = imagecreatefromjpeg($files[0]);
		if (!$image) die ("<br><br><br><center><b>Please check the file submitted, the format is invalid.</b></center>");
		
		// Check width(700->2028px) and height(420->1229px)
		$dimensions = checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight);

		//  Resize if needed
		if (($dimensions[0] < $maxwidth) || ($dimensions[1] < $maxheight))
			$textimage = resizePng($textimage, $dimensions[0], $dimensions[1]);
		
		// Combine image with logo
		imagecopy($image, $textimage, 0, 0, 0, 0, $dimensions[0], $dimensions[1]);
		
		// Save stats in database
		if ($image)
			saveStats($departament, 0, 0, 0, 1, $color);
		
		// Force download image
		header("Content-Type: image/jpeg");
		// NOTE: Possible header injection via $basename
		header("Content-Disposition: attachment; filename=" . $names[0]);
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		
		// Compress image 98/100
		imagejpeg($image, null, 98);			
	}
	
}
?>
