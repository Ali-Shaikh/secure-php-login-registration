<?php

function clean( $string )
{
    return htmlentities( $string );
}

function redirect( $location )
{
    header( "Location: {$location}" );
}

function set_message( $message )
{
    if ( ! empty( $message ) )
    {
        $_SESSION['message'] = $message;

    } else
    {
        $message = '';
    }
}

function display_message()
{
    if ( isset( $_SESSION['message'] ) )
    {
        echo $_SESSION['message'];
        unset( $_SESSION['message'] );
    }
}

function token_generator()
{
    $token = $_SESSION['token'] = md5( uniqid( mt_rand(), true ) );

    return $token;
}

function send_email( $email, $subject, $msg, $headers )
{
    return mail( $email, $subject, $msg, $headers );
}

function validate_user_registration()
{
    $min = 3;
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $first_name = clean( $_POST['first_name'] );
        $last_name = clean( $_POST['last_name'] );
        $username = clean( $_POST['username'] );
        $email = clean( $_POST['email'] );
        $password = clean( $_POST['password'] );
        $confirm_password = clean( $_POST['confirm_password'] );

        if ( strlen( $first_name ) < $min )
        {
            $_SESSION['name_error'] = "Names can't be too short.";
        }

        if ( strlen( $last_name ) < $min )
        {
            $_SESSION['name_error'] = "Names can't be too short.";
        }

        if ( username_exists( $username ) )
        {
            $_SESSION['username_error'] = "Someone already has that username. Try another?";
        }

        if ( email_exists( $email ) )
        {
            $_SESSION['email_error'] = "Sorry, it looks like <strong>$email</strong> belongs to an existing account.";
        }

        if ( register_user( $first_name, $last_name, $username, $email, $password ) )
        {
            set_message( "<p class='green-text'>$first_name, go to $email to complete the sign-up process.</p>" );
            redirect( "index.php" );
        } else
        {
            set_message( "<p class='materialize-red-text'>Sorry, Unable to complete the sign-up process.</p>" );
            redirect( "index.php" );
        }

    }
}

function register_user( $first_name, $last_name, $username, $email, $password )
{
    $first_name = escape( $first_name );
    $last_name = escape( $last_name );
    $username = escape( $username );
    $email = escape( $email );
    $password = escape( $password );

    if ( username_exists( $username ) )
    {
        return false;
    } elseif ( email_exists( $email ) )
    {
        return false;
    } else
    {
        $validation_code = md5( $username + microtime() );
        $password = md5( $password );
        $query = "INSERT INTO users (first_name,last_name,username,email,password,validation_code, active) VALUES  ('$first_name','$last_name','$username','$email','$password','$validation_code',0)";
        $result = query( $query );

        $subject = "Confirm your account, $first_name $last_name";
        $msg = "Hey $first_name, To complete your registration, please confirm your account. It's easy — just click on the link below.
        http://localhost/secure/activate.php?email=$email&code=$validation_code";
        $headers = "From: noreply@thelevisagar.com";

        send_email( $email, $subject, $msg, $headers );

        return true;
    }
}

function username_exists( $username )
{
    $username = escape( $username );

    $query = "select id from users where username='$username'";
    $result = query( $query );
    if ( row_count( $result ) == 1 )
    {
        return true;
    } else
    {
        return false;
    }
}

function email_exists( $email )
{
    $email = escape( $email );

    $query = "select id from users where email='$email'";
    $result = query( $query );
    if ( row_count( $result ) == 1 )
    {
        return true;
    } else
    {
        return false;
    }
}

function activate_user()
{
    if ( $_SERVER['REQUEST_METHOD'] == "GET" )
    {
        if ( isset( $_GET['email'] ) )
        {
            echo $email = escape( clean( $_GET['email'] ) );
            echo $validation_code = escape( clean( $_GET['code'] ) );

            $query = "select id from users where email='$email' and validation_code='$validation_code'";
            $result = query( $query );

            if ( row_count( $result ) == 1 )
            {
                $queryTwo = "UPDATE users SET active = 1, validation_code=0 WHERE email='$email' and validation_code='$validation_code'";
                $resultTwo = query( $queryTwo );

                set_message( "<p class='green-text center'>Your email address <strong>$email</strong> has been confirmed.</p>" );

                redirect( "login.php" );

            } else
            {
                set_message( "<p class='materialize-red-text center'><strong>We're sorry, but something went wrong.</strong></p>" );

                redirect( "login.php" );
            }
        }
    }
}

//login functions

function validate_user_login()
{
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        $email = escape( clean( $_POST['email'] ) );
        $password = escape( clean( $_POST['password'] ) );
        $remember_me = isset( $_POST['remember_me'] );

        if ( login_user( $email, $password, $remember_me ) )
        {
            redirect( "admin.php" );
        } else
        {
            $_SESSION['login_error'] = 'Email or Password Incorrect! Please try again.';
        }
    }
}

function login_user( $email, $password, $remember_me )
{
    $query = "select password, id from users where email='$email' and active = 1";
    $result = query( $query );
    if ( row_count( $result ) == 1 )
    {
        $row = fetch_array( $result );
        $hashed_password = $row['password'];
        if ( md5( $password ) === $hashed_password )
        {
            if ( $remember_me == "on" )
            {
                setcookie( 'email', $email, time() + 86400 );
            }
            $_SESSION['email'] = $email;

            return true;
        } else
        {
            return false;
        }
    } else
    {
        return false;
    }
}

function logged_in()
{
    if ( isset( $_SESSION['email'] ) || isset( $_COOKIE['email'] ) )
    {
        return true;
    } else
    {
        return false;
    }
}

function recover_password()
{
    if ( $_SERVER['REQUEST_METHOD'] == "POST" )
    {
        if ( isset( $_SESSION['token'] ) && $_POST['token'] === $_SESSION['token'] )
        {
            $email = escape( $_POST['email'] );

            if ( email_exists( $email ) )
            {
                $validation_code = md5( $email + microtime() );
                setcookie( 'temp_access_code', $validation_code, time() + 900 );
                $query = "UPDATE users SET validation_code='$validation_code' WHERE email='$email'";
                $result = query( $query );

                $headers = "From: noreply@thelevisagar.com";
                $subject = "Please reset your password";
                $msg = "We heard that you lost your password. Sorry about that!

But don’t worry! You can use the following link to reset your password:
http://localhost/secure/code.php?email=$email&code=$validation_code";
                if ( send_email( $email, $subject, $msg, $headers ) )
                {
                    set_message( "<p class='green-text center'>Check your email for a link to reset your password. If it doesn't appear within a few minutes, check your spam folder.</p>" );

                } else
                {
                    set_message( "<p class='materialize-red-text center'>Email could not be sent.</p>" );
                }
            } else
            {
                set_message( "<p class='materialize-red-text center'>Can't find that email, sorry.</p>" );
            }
        } else
        {
            redirect( "index.php" );
        }
    }
}

function validate_code()
{
    if ( isset( $_COOKIE['temp_access_code'] ) )
    {
        if ( ! isset( $_GET['email'] ) && ! isset( $_GET['code'] ) )
        {
            redirect( "index.php" );
        } elseif ( empty( $_GET['email'] ) || empty( $_GET['code'] ) )
        {
            redirect( "index.php" );
        } else
        {
            if ( isset( $_POST['code'] ) )
            {
                $email = clean( $_GET['email'] );
                $validation_code = clean( $_POST['code'] );
                $query = "select id from users where validation_code='$validation_code' and email='$email'";
                $result = query( $query );

                if ( row_count( $result ) == 1 )
                {
                    setcookie( 'temp_access_code', $validation_code, time() + 900 );

                    redirect( "reset.php?email=$email&code=$validation_code" );
                } else
                {
                    set_message( "<p class='materialize-red-text center'>Sorry, invalid validation code.</p>" );
                }
            }
        }

    } else
    {
        set_message( "<p class='materialize-red-text center'>Sorry, the link has expired.</p>" );
        redirect( "recover.php" );
    }
}


function password_reset()
{
    if ( isset( $_COOKIE['temp_access_code'] ) )
    {
        if ( isset( $_GET['email'] ) && isset( $_GET['code'] ) )
        {
            if ( isset( $_SESSION['token'] ) && isset( $_POST['token'] ) )
            {
                if ( $_POST['token'] === $_SESSION['token'] )
                {
                    $password = md5( $_POST['password'] );
                    $email = escape( $_GET['email'] );
                    if ( $_POST['password'] === $_POST['confirm_password'] )
                    {
                        $query = "UPDATE users SET password='$password',validation_code=0 WHERE email='$email'";
                        query( $query );
                        set_message( "<p class='green-text center'>Password changed.  <a href='login.php' class='green-text'><strong>Click here to Login</strong></a></p>" );
                    }
                }
            }
        }
    } else
    {
        set_message( "<p class='materialize-red-text center'>Sorry, your session has expired.</p>" );
    }

}

?>
