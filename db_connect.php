<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "moviliam_hecsoftw_movilia";

$link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

mysqli_set_charset($link,'utf8');
 
?>