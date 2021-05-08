<?php

/**
 * Parametry połączenia z bazą danych
 */

$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "projekt_zfn";
$servername = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );