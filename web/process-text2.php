<?php

include 'connect.php';

// text
$text = $_POST["text"];

$color = 1;
if (isset($_POST['color']) && $_POST['color'] == 'white') 
	$color = 2;

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

// Functie create picture & text
function createImage($file, $numepoza, $text, $single){
// info
 $font = 'tahomabd.ttf';
 $fontsize = 26;
 $imageX = 2048;
 $imageY = 1229;

// Image size
 list($newwidth, $newheight, $type, $attr) = getimagesize($file);
// Verifica dimeniuni design
if ($newwidth < 700 || $newwidth > 2048 || $newheight < 420 || $newheight > 1229) 
{
 if ($single) {
	echo "<link rel='stylesheet' type='text/css' href='/css/style.css'><div id='fail'><img src='/img/fail.png' width='390px'><br><br><br><b>Error! Please check image dimensions! <b><br><br> Dimensions: min 700x420px  / max - 2048x1229px<br>Ratio 5:3 <br>Edit this image in Photoshop! </div>"; die(); 	 
 } else {
	$array["random"] = "../img/";
	$array["numepoza"] = "picture-error.jpg";
	return $array;
  }
}
else {
	global $color;
	global $mysqli;
	$mysqli->query("INSERT INTO images (date, departament, copyright, color) VALUES (CURDATE(), '1', 1, '$color')");
	$mysqli->query("INSERT INTO copyright VALUES ('$text')");
}
// clona text
 $dims = imagettfbbox($fontsize, 0, $font, $text);
// informatii clona
 $bbox_height = $dims[3] - $dims[5]; // lower-right y minus upper-right y
 $bbox_width = $dims[4] - $dims[0]; // lower-right y minus upper-right y
// Create image
 $watermark = imagecreatetruecolor($imageX,$imageY);
 imagealphablending($watermark, false);
 imagesavealpha($watermark, true);
// background color
 $bgcolor = imagecolorallocatealpha($watermark, 255,255,255, 127);
 if (isset($_POST['color']) &&   $_POST['color'] == 'white') 
	$fontcolor = imagecolorallocate($watermark, 255, 255, 255);
 else
	$fontcolor = imagecolorallocate($watermark, 0, 0, 0);
// fill in the background with the background color
 imagefilledrectangle($watermark, 0, 0, $imageX, $imageY, $bgcolor);
 $x = $imageX - $bbox_width - 90; 
 $y = $imageY - $bbox_height + $fontsize - 50;
 imagettftext($watermark, $fontsize, 0, $x, $y , $fontcolor, $font, chr(169) . ' ' . $text);
// Verifica dimensiuni pentru resize
 if ($newwidth < 2048)
	$watermark = resizePng ($watermark, $newwidth, $newheight);
 $watermark_x = imagesx($watermark);
 $watermark_y = imagesy($watermark);
// Aplica watermark
 $image = imagecreatefromjpeg($file);
 $random = rand(10000, 100000);
 imagecopy($image, $watermark, round(imagesx($image) / 2) - round($watermark_x / 2), round(imagesy($image) / 2) - round($watermark_y / 2), 0, 0, $watermark_x, $watermark_y);
 
 if ($single) {
 header("Content-type: image/jpeg");
 header("Content-Disposition: attachment; filename=" . $numepoza);
 header('Content-Transfer-Encoding: binary');
 header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
 
 imagejpeg($image, null, 95);

 return $image;
 } else {
 imagejpeg($image, dirname(__FILE__) . '/done/' . $random . $numepoza, 95);
 imagedestroy($watermark);
 imagedestroy ($image);

 $array["random"] = $random;
 $array["numepoza"] = $numepoza;
 return $array;
 }
}


if (count($_FILES['files']['tmp_name']) > 1) {
echo <<<END
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script>
		  $(document).ready(function(){
			$('.img-zoom').hover(function() {
				$(this).addClass('transition');
 
			}, function() {
				$(this).removeClass('transition');
			});
		  });
		</script>
<style>
        
        * {margin: 0; padding: 0;}
        a {text-decoration: none; color: #000; transition: all 0.1s ease-in;}
		body {font-family: Open Sans; font-size: 13px; font-weight: 300; background-image: url("/img/minion.jpg"); background-repeat: no-repeat; background-position: right top;}
		h1 {padding: 60px 0; text-align: center;}
		        
        .wrap {margin: 60px auto; max-width: 960; text-align: center;}
        
		.img-zoom {
			width:310px;
			-webkit-transition: all .2s ease-in-out;
			-moz-transition: all .2s ease-in-out;
			-o-transition: all .2s ease-in-out;
			-ms-transition: all .2s ease-in-out;
			box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.75);
			margin-bottom: 20px;
			margin-left: 5px;
		}
 
		.transition {
			-webkit-transform: scale(2); 
			-moz-transform: scale(2);
			-o-transform: scale(2);
			transform: scale(2);
		}
		</style>
<center><b> Click on image to save, don't use Save As.</b></center><div class="wrap">
END;

foreach($_FILES['files']['tmp_name'] as $index => $file) {
	$poza = createImage($file, $_FILES['files']['name'][$index], $text, false);

	if ($poza[numepoza] != "picture-error.jpg")
		echo '<a href="/done/', $poza[random], $poza[numepoza], '" download="', $poza[numepoza], '">';
	echo ' <img ';
	if ($poza[numepoza] != "picture-error.jpg")	
		echo 'class="img-zoom"';
	echo 'id="img_01" width="300px" src="/done/', $poza[random], $poza[numepoza], '" />';
	if ($poza[numepoza] != "picture-error.jpg")
		echo '</a> ';
}
echo "</div>";
}
else {
	createImage($_FILES['files']['tmp_name'][0], $_FILES['files']['name'][0], $text, true);
}
mysqli_close($mysqli);
?>				