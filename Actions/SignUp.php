<?php
    // Connection with BD
    include '../conn.php';

    // get the parameters
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password))
    {
        if($user->register($firstname, $lastname, $email, $password))
        {
            echo 1;
        }
        else
        {
            echo 2;
        }
    }
    else
    {
        echo 3;
    }
    

?>