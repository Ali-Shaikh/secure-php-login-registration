<?php
include "inc/header.php";
recover_password();
?>
    <div class="container">
        <div class="row center">
            <div class="col l12 s12 m12">
                <br>
                <h4 class="card-panel teal-text light">Reset your password</h4>
                <?php display_message(); ?>
            </div>
        </div>
        <div class="row center">
            <div class="col l6 offset-l3 s12 m8 offset-m2 card-panel">
                <h3 class="header teal-text lighten-1 light">Enter Email</h3>
                <form action="" method="post">
                    <div class="row">
                        <div class="input-field col s10 offset-s1 l10 offset-l1 m10 offset-m1">
                            <input id="email" name="email" type="email" placeholder="Enter your email address" autofocus required/>
                        </div>
                    </div>
                    <div class="row">
                        <a href="login.php"><button class="btn waves-effect waves-light grey" type="button">cancel</button></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn waves-effect waves-light" type="submit">submit</button>
                    </div>
                    <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator(); ?>">
                </form>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"; ?>