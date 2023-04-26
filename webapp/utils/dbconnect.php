<?php
$host = '127.0.0.1';
$dbname = 'crafti';
$username = 'crafti';
$password = 'craftiPwd!';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
