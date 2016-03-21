<?php include "inc/header.php"; ?>
<div class="row">
    <form class="col l6 offset-l3 m8 offset-m2 s12" action="" method="post">
        <br>
        <div class="row">
            <div class="input-field col l12 m12 s12">
                <input id="username" name="username" type="text" required>
                <label for="username">Username</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l12 m12 s12">
                <input id="email" name="email" type="email" required>
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l12 m12 s12">
                <input id="password" name="password" type="password" required>
                <label for="password">Password</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l12 m12 s12">
                <input id="confirm_password" name="confirm_password" type="password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 0;">
            <div class="col l12 m12 s12 center-align">
                <button id="submit" name="submit" value="signup" class="btn" type="submit">Create my account</button>
            </div>
        </div>
    </form>
</div>
<p class="center grey-text">Already have an account? <a
        href="login.php"><strong class=" teal-text lighten-1">Sign in</strong></a>
</p>
<?php include "inc/footer.php"; ?>