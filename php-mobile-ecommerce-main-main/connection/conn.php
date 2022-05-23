<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'mobile';


$pdo = new PDO('mysql:host=localhost; dbname=mobile', $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>