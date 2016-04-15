<?php include "inc/header.php"; ?>
    <div class="container">
        <?php if ( logged_in() )
        {
            echo "<h2 class='header center teal-text text-lighten-1 light'>Hi, " . $_SESSION['email'] . "</h2>";
        } else
        {
            redirect( "index.php" );
        } ?>
        <div class="row center">
        </div>
    </div>
<?php include "inc/footer.php"; ?>