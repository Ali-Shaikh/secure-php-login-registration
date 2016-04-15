<?php
include "inc/header.php";
validate_user_registration();
?>
    <div class="row">
        <form class="col l8 offset-l4 m8 offset-m2 s12" action="" method="post">
            <div class="row" style="margin-bottom: 0;">
                <div class="input-field col l6 m12 s12">
                    <h4 style="margin: 0;" class="teal-text lighten-1 center light">Register</h4>
                </div>
            </div>
            <br class="hide-on-large-only">
            <div class="row">
                <div class="input-field col l3 m6 s6">
                    <input style="margin: 0;" id="first_name" name="first_name" type="text" required>
                    <label for="first_name">First Name</label>
                </div>
                <div class="input-field col l3 m6 s6">
                    <input style="margin: 0;" id="last_name" name="last_name" type="text" required>
                    <label for="last_name">Surname</label>
                </div>
                <div class="input-field col l6 m12 s12">
                    <span><label class="materialize-red-text"><?php echo $_SESSION['name_error'];
                            unset( $_SESSION['name_error'] ); ?></label></span>
                </div>
            </div>
            <br class="hide-on-large-only">
            <div class="row">
                <div class="input-field col l6 m12 s12">
                    <input style="margin: 0;" id="username" name="username" type="text" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-field col l6 m12 s12">
                    <span><label class="materialize-red-text"><?php echo $_SESSION['username_error'];
                            unset( $_SESSION['username_error'] ); ?></label></span>
                </div>
            </div>
            <br class="hide-on-large-only">
            <div class="row">
                <div class="input-field col l6 m12 s12">
                    <input style="margin: 0;" id="email" name="email" type="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field col l6 m12 s12">
                    <span><label class="materialize-red-text"><?php echo $_SESSION['email_error'];
                            unset( $_SESSION['email_error'] ); ?></label></span>
                </div>
            </div>
            <br class="hide-on-large-only">
            <div class="row">
                <div class="input-field col l6 m12 s12">
                    <input style="margin: 0;" id="password" name="password" type="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field col l6 m12 s12">
                    <span></span>
                </div>
            </div>
            <br class="hide-on-large-only">
            <div class="row">
                <div class="input-field col l6 m12 s12">
                    <input style="margin: 0;" id="confirm_password" name="confirm_password" type="password" required>
                    <label for="confirm_password">Confirm Password</label>
                </div>
                <div class="input-field col l6 m12 s12">
                    <span></span>
                </div>
            </div>
            <div class="row" style="margin-bottom: 0;">
                <div class="col l6 m12 s12 center-align">
                    <button id="signup" class="btn" type="submit">Create my account</button>
                </div>
            </div>
        </form>
    </div>
    <p class="center grey-text">Already have an account? <a
            href="login.php"><strong class=" teal-text lighten-1">Sign in</strong></a>
    </p>
<?php include "inc/footer.php"; ?>