<?php
    include 'conn.php';

    if($user->logout($_SESSION['user']))
    {
        $user->redirect('index.php');
    }
?>