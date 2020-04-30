<?php
    include '../conn.php';

    $uid = $_SESSION['user'];

    if($user->toggleDarkMode($uid) == 'succes' || $user->toggleDarkMode($uid) == true)
    {
        echo 1;
    }
?>