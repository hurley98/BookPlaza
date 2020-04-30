<?php
    include '../conn.php';

    $uid = $_SESSION['user'];

    if($user->enableDarkMode($uid))
    {
        echo 1;
    }
?>