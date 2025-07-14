<?php
function connex()
{
    static $connex = null;

    if ($connex === null) {
        $connex = mysqli_connect('172.60.0.15', 'ETU004030', 'qmVBAuAk', 'db_s2_ETU004030');

        if (!$connex) {
            
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        
        mysqli_set_charset($connex, 'utf8mb4');
    }

    return $connex;
}
