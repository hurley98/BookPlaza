<?php
    include 'header.inc.php';
?>
<!-- TODO MOVE THIS INTO CSS FILE -->
<div class="container">
    <form style="width: 400px; left: 0; right: 0; margin: 0 auto; margin-top:20px" id="signupform">
        <h1 class="text-center">Signup</h1>
        <hr />
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name="firstname" placeholder="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="lastname" placeholder="Last name">
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <input type="submit" value="Signup" id="signupButton" class="form-control btn-success">
        </div>
        <p class="text-center">Already a user? <a href="login">Login here</a></p>
    </form>
</div>

<script>
    $(document).ready(() => {
        $('#signupButton').click((e) => {
            e.preventDefault();
            $.ajax
            ({
                type: 'POST',
                url: 'Actions/SignUp.php',
                data: $('#signupform').serialize(),
                success: (response) => {
                    alert(response);
                }
            });
        });
    });
</script>


<?php 
    include 'footer.inc.php';
?>