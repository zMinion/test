<?php
$randseed = rand(0, 16);
$str      = file_get_contents('http://www.bing.com/HPImageArchive.aspx?format=js&idx=' . $randseed . '&n=1&mkt=en-US');
$array    = json_decode($str);
$imgurl   = 'http://www.bing.com' . $array->{"images"}[0]->{"urlbase"} . '_1920x1080.jpg';

$cache_file = $array->{"images"}[0]->hsh;
print $cache_file; 
/*
if(file_exists($cache_file)) {
	if(time() - filemtime($cache_file) > 86400) {
		// too old , re-fetch
		$cache = file_get_contents('YOUR FILE SOURCE');
		file_put_contents($cache_file, $cache);
	} else {
		// cache is still fresh
	}
} else {
	// no cache, create one
	$cache = file_get_contents('YOUR FILE SOURCE');
	file_put_contents($cache_file, $cache);
}


if ($imgurl) {
    header('Location: ' . $imgurl);
    die();
}
*/