<?php include "inc/header.php"; ?>
    <div class="container">
        <div class="row center">
            <div class="col l12 s12 m12">
                <br>
                <?php
                validate_code();
                display_message();
                ?>
            </div>
        </div>
        <div class="row center">
            <div class="col l6 offset-l3 s12 m8 offset-m2 card-panel">
                <h2 class="header teal-text lighten-1 light">Enter Code</h2>
                <form action="" method="post">
                    <div class="row">
                        <div class="input-field col s10 offset-s1 l10 offset-l1 m10 offset-m1">
                            <input id="code" name="code" type="password" autofocus required/>
                        </div>
                    </div>
                    <div class="row">
                        <a href="login.php">
                            <button class="btn waves-effect waves-light grey" type="button">cancel</button>
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn waves-effect waves-light" type="submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"; ?>