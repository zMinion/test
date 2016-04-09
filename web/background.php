<?php  

$randseed=rand(0,16);
$str=file_get_contents('http://www.bing.com/HPImageArchive.aspx?format=js&idx='.$randseed.'&n=1&mkt=en-US');
$array = json_decode($str);
$imgurl = 'http://www.bing.com'.$array->{"images"}[0]->{"urlbase"}.'_1920x1080.jpg';
	
if($imgurl){  
        header('Location: '.$imgurl);
		die();
}
 
?> 