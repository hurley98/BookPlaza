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

    <!-- Incorrect Password -->
    <!-- Modal -->
    <div class="modal fade" id="incorrectPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            Incorrect Password, please try again!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal -->

    <!-- Email does not exist -->
    <!-- Modal -->
    <div class="modal fade" id="incorrectEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            Email does not exists, please try again!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
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
                    if(response == 4)
                    {
                        // alert("Incorrect password!");
                        $('#incorrectPassword').modal('show');
                    }
                    if(response == 5)
                    {
                        $('#incorrectEmail').modal('show');
                        //alert("Email does not exist!");
                    }
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

