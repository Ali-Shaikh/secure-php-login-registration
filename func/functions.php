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
        confirm( $result );

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
            confirm( $result );

            if ( row_count( $result ) == 1 )
            {
                $queryTwo = "UPDATE users SET active = 1, validation_code=0 WHERE email='$email' and validation_code='$validation_code'";
                $resultTwo = query( $queryTwo );
                confirm( $resultTwo );

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

?>
