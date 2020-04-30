<?php
    include '../conn.php';

    $uid = $_SESSION['user'];

    if($user->disableDarkMode($uid))
    {
        echo 1;
    }
?>