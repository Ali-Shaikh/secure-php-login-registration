<?php

$server = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'login_db';

$conn = mysqli_connect( $server, $user, $pass, $db );

function query( $query )
{
    global $conn;

    return mysqli_query( $conn, $query );
}

function escape( $string )
{
    global $conn;

    return mysqli_real_escape_string( $conn, $string );
}

function fetch_array( $result )
{
    global $conn;

    return mysqli_fetch_array( $result );
}

function confirm( $result )
{
    global $conn;
    if ( ! $result )
    {
        die( "QUERY FAILED" . mysqli_error( $conn ) );
    }
}

function row_count( $result )
{
    return mysqli_num_rows( $result );
}


?>