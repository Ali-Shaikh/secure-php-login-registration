<?php include "inc/header.php"; ?>
<div class="container">
    <div class="row">
        <form class="col l6 offset-l3 m8 offset-m2 s12" action="" method="post">
            <?php display_message(); ?>
            <br>
            <h3 class="teal-text lighten-1 center light" style="margin-top: 0;">Login</h3>
            <br>
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
                <div class="col l12 m12 s12">
                    <input type="checkbox" class="filled-in" id="remember_me"/>
                    <label for="remember_me">Keep me logged in</label>
                </div>
            </div>
            <div class="row">
                <div class="col l12 m12 s12 center-align">
                    <button id="login" name="submit" value="login" class="btn" type="submit">Log in</button>
                </div>
            </div>
        </form>
    </div>
    <p class="center"><a
            href="#"><strong class="teal-text lighten-1">Forgotten your password?</strong></a>
    </p>
    <p class="center grey-text">Don't have an account? <a
            href="index.php"><strong class=" teal-text lighten-1">Create a free account</strong></a>
    </p>
</div>
<?php include "inc/footer.php"; ?>
