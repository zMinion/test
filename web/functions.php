<?php
// Verifica dimeniuni design
function checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight)
{
    $width  = imagesx($image);
    $height = imagesy($image);
    $resize = false;
    if ($width < $minwidth || $width > $maxwidth || $height < $minheight || $height > $maxheight) {
        handleError(1);
    }
    if (($width !== $maxwidth) && ($height !== $maxheight)) {
        $resize = true;
    }
    return array(
    $width,
    $height,
    $resize
    );
}
// Flip la fundal
function flipImage($image, $width, $height)
{
    $flipped = imagecreatetruecolor($width, $height);
    for ($widthx = 0; $widthx < $width; $widthx++) {
        imagecopy($flipped, $image, $widthx, 0, $width - $widthx - 1, 0, 1, $height);
    }
    return $flipped;
}
// Resize png
function resizePng($logo, $dst_width, $dst_height)
{
    $width   = imagesx($logo);
    $height  = imagesy($logo);
    $newlogo = imagecreatetruecolor($dst_width, $dst_height);
    imagealphablending($newlogo, false);
    imagesavealpha($newlogo, true);
    $transparent = imagecolorallocatealpha($newlogo, 255, 255, 255, 127);
    imagefilledrectangle($newlogo, 0, 0, $width, $height, $transparent);
    imagecopyresampled($newlogo, $logo, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
    return $newlogo;
}
// Nume Poze: 0 - logo / 1 - getty / 2 - mockup
function renameImage($name, $source = 0)
{
    switch ($source) {
        case "1":
            $name = preg_replace('/.jpeg|,|.jpg/i', '', $name) . '_badged.jpg';
            break;
        case "2":
            $name = preg_replace('/.jpeg|,|.jpg/i', '', $name) . '_mockup.jpg';
            break;
        default:
            $name = preg_replace('/.jpeg|,|.jpg/i', '', $name) . '_logo.jpg';
    }
    return $name;
}
/** Save stats
 *   departament 1 - travel / 2 - goods
 *   source 0 - logo / 1 - getty / 2 - mockup
 *   flip 0 - false / 1 - true
 *   copyright 0 - false / 1 - true
 *   color 0 - black / 1 - white
 */
function saveStats($departament, $logo = null, $source = 0, $flip = 0, $copyright = 0, $color = 0)
{
    $url      = getenv('JAWSDB_URL');
    $dbparts  = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'], '/');
    // Create connection
    $mysqli   = new mysqli($hostname, $username, $password, $database);
    // Check connection
    if ($mysqli->connect_error) {
        handleError(3);
    }
    if ($logo) {
        $mysqli->query("INSERT INTO images (date, departament, logo, source, flip) VALUES (CURDATE(), '" . mysqli_real_escape_string($mysqli, $departament) . "', '" . mysqli_real_escape_string($mysqli, $logo) . "', '" . mysqli_real_escape_string($mysqli, $source) . "', '" . mysqli_real_escape_string($mysqli, $flip) . "')");
    }
    if ($copyright) {
        $mysqli->query("INSERT INTO images (date, departament, copyright, color) VALUES (CURDATE(), '" . mysqli_real_escape_string($mysqli, $departament) . "', '" . mysqli_real_escape_string($mysqli, $copyright) . "', '" . mysqli_real_escape_string($mysqli, $color) . "')");
    }
    mysqli_close($mysqli);
}
// Show total images edited
function showStats()
{
    $url      = getenv('JAWSDB_URL');
    $dbparts  = parse_url($url);
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'], '/');
    // Create connection
    $mysqli   = new mysqli($hostname, $username, $password, $database);
    // Check connection
    if ($mysqli->connect_error) {
        handleError(3);
    }
    $maximages = $mysqli->query("SELECT max(id) as id FROM images")->fetch_object()->id;
    $mysqli->close();
    return $maximages;
}
// create text
function createText($text, $color, $font, $fontsize, $maxwidth, $maxheight)
{
    $dims        = imagettfbbox($fontsize, 0, $font, $text);
    $bbox_height = $dims[3] - $dims[5];
    $bbox_width  = $dims[4] - $dims[0];
    $copyright   = imagecreatetruecolor($maxwidth, $maxheight);
    imagealphablending($copyright, false);
    imagesavealpha($copyright, true);
    // background color
    $bgcolor   = imagecolorallocatealpha($copyright, 255, 255, 255, 127);
    // font color
    $fontcolor = imagecolorallocate($copyright, 0, 0, 0);
    if ($color) {
        $fontcolor = imagecolorallocate($copyright, 255, 255, 255);
    }
    imagefilledrectangle($copyright, 0, 0, $maxwidth, $maxheight, $bgcolor);
    $widthx  = $maxwidth - $bbox_width - 90;
    $heighty = $maxheight - $bbox_height + $fontsize - 50;
    imagettftext($copyright, $fontsize, 0, $widthx, $heighty, $fontcolor, $font, chr(169) . ' ' . $text);
    return $copyright;
}
// Combine image for mockup
function combineMockup($image, $banner, $mockup, $quality, $name)
{
    imagecopymerge($banner, $image, 8, 181, 0, 0, 1680, 450, 100);
    $image = imagecreatetruecolor(1700, 954);
    imagecopyresampled($image, $banner, 0, 0, 0, 0, 1700, 954, 1700, 954);
    imagecopyresampled($image, $mockup, 0, 0, 0, 0, 1700, 954, 1700, 954);
    // Force download single image
    header("Content-Type: image/jpeg");
    // NOTE: Possible header injection via $basename
    header("Content-Disposition: attachment; filename=" . $name);
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    // Compress image
    imagejpeg($image, null, $quality);
    imagedestroy($image);
}
// Combine images and prepare for download
function imageSave($image, $imagepng, $width, $height, $quality, $name = null, $single = null)
{
    // Combine images
    imagecopy($image, $imagepng, 0, 0, 0, 0, $width, $height);
    if ($single) {
        // Force download single image
        header("Content-Type: image/jpeg");
        // NOTE: Possible header injection via $basename
        header("Content-Disposition: attachment; filename=" . $name);
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    }
    // Compress image
    imagejpeg($image, null, $quality);
    imagedestroy($image);
}
/**
 * added for later edits
 function JPGoptimiser($JPGfile, &$error = '')
 {
 $ch = curl_init('http://jpgoptimiser.com/optimise');
 curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 curl_setopt($ch, CURLOPT_FAILONERROR, 1);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, array('input' => '@'.$JPGfile));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 $jpg = curl_exec($ch);
 $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 if ($status !== 200) {
 $error = 'jpgoptimiser.com request failed: HTTP code ' . $status;
 return false;
 }
 $curl_error = curl_error($ch);
 if (!empty($curl_error)) {
 $error = 'jpgoptimiser.com request failed: CURL error ' . $curl_error;
 return false;
 }
 curl_close($ch);
 return $jpg;
 }
 */
/**
 * @param integer $errorid
 */
function handleError($errorid)
{
    exit(header('Location: http://www.dfdesign.xyz/error.php?id=' . $errorid));
}
/**
 * @param integer $errorid
 * 1 - Image dimensions
 * 2 - Invalid image uploaded
 * 3 - MySQL connection failed
 * display errors
 */
function showError($errorid)
{
    switch ($errorid) {
        case "1":
            $title = "Image dimensions";
            $text  = "Please check image dimensions! <br />Dimensions: min-700x420px / max-2048x1229px Ratio 5:3 <br /><b>Edit this image in Photoshop and try again!</b>";
            break;
        case "2":
            $title = "Unknown or invalid JPEG format";
            $text  = "Please open the image in Photoshop and save it again as JPEG with ICC profile: sRGB";
            break;
        case "3":
            $title = "Database connection failed";
            $text  = "Pleaser try again, it is possible that the database is overloaded or otherwise not running properly.";
            break;
        default:
            $title = "Incorrect error id";
            $text  = "An error is an action which is inaccurate or incorrect. In some usages, an error is synonymous with a mistake, though in technical contexts the two are often distinguished.";
    }
    return array(
        $title,
        $text
    );
}
