<?php
$randseed = rand(0, 16);
$str      = file_get_contents('http://www.bing.com/HPImageArchive.aspx?format=js&idx=' . $randseed . '&n=1&mkt=en-US');
$array    = json_decode($str);
$imgurl   = 'http://www.bing.com' . $array->{"images"}[0]->{"urlbase"} . '_1920x1080.jpg';
$storename = md5($array->{"images"}[0]->{"urlbase"});

$cache_file = 'img/background/' . $storename;

function url_get_contents($url) {
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

if(file_exists($cache_file)) {
    header('Location: ' . $cache_file);
    die();		
} else {
	$cache = url_get_contents($imgurl);
	file_put_contents($cache_file, $cache);
    header('Location: ' . $cache_file);	
}