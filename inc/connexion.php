<?php
$host = '172.60.0.15';
$user = 'ETU004030';
$pass = 'qmVBAuAk'; 
$dbname = 'db_s2_ETU004030';

$connex = new mysqli($host, $user, $pass, $dbname);

if ($connex->connect_error) {
    die("Erreur de connexion : " . $connex->connect_error);
}
?>

