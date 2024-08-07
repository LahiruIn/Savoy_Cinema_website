<?php

 //start section
 session_start();

 // create constants to store Non Repeating values
 define('SITEURL', 'http://localhost/savoy-movie/');
 define('LOCALHOST','localhost');
 define('DB_USERNAME','root');
 define('DB_PASSWORD', '');
 define('DB_NAME', 'savoy-movie');

 $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Database Connection
 $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //Selecting Databse
 
?>