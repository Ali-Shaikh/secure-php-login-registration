<?php include "inc/header.php"; ?>
    <div class="container">
        <div class="row center">
            <!--        <div class="col l12 s12 m12">-->
            <!--            <br>-->
            <!--            <h5 class="card-panel teal-text light"></h5>-->
            <!--        </div>-->
        </div>
        <div class="row center">
            <div class="col l6 offset-l3 s12 m8 offset-m2 card-panel">
                <h3 class="header teal-text lighten-1 light">Reset Password</h3>
                <form action="" method="post">
                    <br>
                    <br>
                    <div class="row">
                        <div class="input-field col s10 offset-s1 l10 offset-l1 m10 offset-m1">
                            <input id="password" name="password" type="password" autofocus required>
                            <label for="password">New Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s10 offset-s1 l10 offset-l1 m10 offset-m1">
                            <input id="confirm_password" name="confirm_password" type="password" required>
                            <label for="confirm_password">Confirm Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light grey" type="submit">cancel</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn waves-effect waves-light" type="submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"; ?>