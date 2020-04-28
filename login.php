<?php
    include 'header.inc.php';
?>
<div class="container">
    <form style="width: 400px; left: 0; right: 0; margin: 0 auto; margin-top:20px" id="loginForm">
        <h1 class="text-center">Welcome back!</h1>
        <hr />
        <div class="form-group">
            <input type="email" required class="form-control" name="email" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <input type="password" required class="form-control" name="password" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <input type="submit" value="Login" id="loginButton" class="form-control btn-success">
        </div>
        <p class="text-center">Not a user? <a href="signup">Signup here</a></p>
    </form>
</div>

<script>
    $(document).ready(() => {
        $('#loginButton').click((e) => {
            e.preventDefault();
            
            $.ajax
            ({
                type: 'POST',
                url: 'Actions/Login.php',
                data: $('#loginForm').serialize(),
                success: (response) => {
                    if(response == 1)
                    {
                        location.href = "index";
                    }
                }
            });
        });
    });
</script>


<?php 
    include 'footer.inc.php';
?>

