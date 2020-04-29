<?php
    // Connection with BD
    include '../conn.php';

    // get the parameters
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && !empty($username))
    {
        if($user->register($firstname, $lastname, $email, $username, $password))
        {
            echo 1;
        }
    }
    else
    {
        echo 3;
    }
    

?>