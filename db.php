<?php


$servername = 'localhost';
$username = 'root';
$password = '';
$databasename = 'praktika';

$conn = mysqli_connect($servername, $username, $password, $databasename);

if (!$conn) {
    die('connection failed : ' . mysqli_connect_error());
} else {
}
