<?php
    include '../conn.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if($user->login($email, $password))
    {
        echo 1;
    }
?>