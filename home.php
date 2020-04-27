<?php 
    include 'header.inc.php';

    // If the user is not logged in
    if(!$user->isLoggedIn())
    {
        $user->redirect('login');
    }
?>


<?php
    include 'footer.inc.php';
?>