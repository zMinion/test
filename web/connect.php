<?php
//Open a new connection to the MySQL server
$mysqli = new mysqli('fdb3.awardspace.net','2037932_db','Parola1234','2037932_db');
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>