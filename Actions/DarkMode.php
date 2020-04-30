<?php
    include '../conn.php';

    $uid = $_SESSION['user'];

    if($user->enableDarkMode($uid) == 'succes' || $user->enableDarkMode($uid) == true)
    {
        echo 1;
    }
?>