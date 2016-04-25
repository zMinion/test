<?php

// Verifica dimeniuni design
function checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight) {
	$dimensions["width"] = imagesx($image);
    $dimensions["height"] = imagesy($image);
	if ($minwidth < $dimensions["width"] || $maxwidth > $dimensions["width"] || $minheight < $dimensions["height"] || $maxheight > $dimensions["height"]) 
		return $dimensions;
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
function resizePng($image, $width, $height, $dst_width, $dst_height) {
    $newImg = imagecreatetruecolor($dst_width, $dst_height);
    imagealphablending($newImg, false);
    imagesavealpha($newImg, true);
    $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
    imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
    imagecopyresampled($newImg, $image, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
    return $newImg;
}

// Nume Poze: 0 - logo / 1 - getty / 2 - mockup
function renameImage($name, $source) {
	if ($source = 1) 
		$name =  preg_replace('/.jpeg|,|.jpg/i', '', $name . '_badged.jpg';
	else if ($source = 2)
		$name =  preg_replace('/.jpeg|,|.jpg/i', '', $name . '_mockup.jpg';
	else
		$name =  preg_replace('/.jpeg|,|.jpg/i', '', $name . '_logo.jpg';	
		
	return $name;
}
// work in progress
function saveStats($departament, $logo, $source, $flip=0, $copyright=0, $color) {
include 'connect.php';
$mysqli->query("INSERT INTO images (date, departament, logo, source, flip) VALUES (CURDATE(), '$departament', '$logo', '$source', '$flip')");
mysqli_close($mysqli);
}

?>