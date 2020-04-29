<?php
    include 'header.inc.php';
?>
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
            <input type="text" class="form-control" name="username" placeholder="johndoe">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your password">
        </div>
        <div class="form-group">
            <input type="submit" value="Signup" id="signupButton" class="form-control btn-success">
        </div>
        <p class="text-center">Already a user? <a href="login">Login here</a></p>
    </form>

    <!-- Email exists already -->
    <!-- Modal -->
    <div class="modal fade" id="emailError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            Email is already used!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal -->

    <!-- Username is already used modal -->
    <!-- Modal -->
    <div class="modal fade" id="usernameError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            Username is already used!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-- Modal -->

    <!-- Account Created modal -->
    <!-- Modal -->
    <div class="modal fade" id="accountCreated" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-success" id="exampleModalLabel">Success</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            Account has been created successfully!
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
        $('#signupButton').click((e) => {
            e.preventDefault();
            $.ajax
            ({
                type: 'POST',
                url: 'Actions/SignUp.php',
                data: $('#signupform').serialize(),
                success: (response) => {
                    if(response == 3)
                    {
                        // alert("Email is already used!");
                        $('#emailError').modal('show');
                    }
                    if(response == 4)
                    {
                        // alert("Username is already used!");
                        $('#usernameError').modal('show');
                    }
                    if(response == 1)
                    {
                        // alert('Account created!');
                        $('#accountCreated').modal('show');
                    }
                }
            });
        });
    });
</script>


<?php 
    include 'footer.inc.php';
?>