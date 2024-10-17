<?php
$host = 'localhost'; 
$dbname = 'cead';
$user = 'root'; 
$pass = ''; 

$mysqli = new mysqli($host, $user, $pass, $dbname);

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
?>
