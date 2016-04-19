<?php

include 'connect.php';

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

$file = $_FILES['optimise']['tmp_name'];
$random = rand(200000, 1000000);
$filepath = dirname(__FILE__) . '/done/' . $random . $_FILES["optimise"]["name"];
if (move_uploaded_file($_FILES["optimise"]["tmp_name"], $filepath)) {
      echo "<P>FILE UPLOADED TO: $filepath</P>";


$result = JPGoptimiser($filepath, $error);
if (false === $result) { die("{$error}\n"); }

header("Content-type: image/jpeg");
 // NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $_FILES['optimise']['name']);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
 
// Force download of image file 
// $size = filesize($image);
// header("Content-Length: " . $size);
fpassthru($filepath);
// Clear memory
 exit();
 
 ?>
