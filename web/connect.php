<?php
//Open a new connection to the MySQL server
$mysqli = new mysqli('ivgz2rnl5rh7sphb.chr7pe7iynqr.eu-west-1.rds.amazonaws.com','pv9trg9ydxga6ay3','ydyptuiyurxa3ww1','dugt8tdb574mfzbj');
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>