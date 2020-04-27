<?php
@session_start();
try
{
    // aici introduci credentialele de la conectarea bazei de date
    $user = "root";
    $pass = "mysql";
    $dbname = "bookplaza";
    $conn = new PDO("mysql:host=localhost;dbname=".$dbname.";charset=utf8", $user, $pass);
} catch(PDOException $e)
{
    echo $e->getMessage();
}

//Include clasa
include_once 'class/User.php';
$user = new User($conn);


?>