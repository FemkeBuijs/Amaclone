<?php

// Session Start
session_start();

//include the globals file to get secured information
include 'reso/globals.php';
// dbConnection
$con = mysqli_connect($globals['host'], $globals['username'], $globals['password'], 'Amaclone') or die(mysqli_connect_errno());

?>
