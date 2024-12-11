<?php
session_start();



// $host = "localhost";
// $db_name = "u898896087_PRO_DB";
// $username = "u898896087_ROOT";
// $password = "D?2j4ENeq=xX";
// define('BASE_URL', 'http://nextverse.in/hnitax/');
// define("DIR_URL", $_SERVER['DOCUMENT_ROOT'] . '/');
// $conn = mysqli_connect($host, $username, $password, $db_name);

// if (!$conn) {
//     die("Database connection failed: " . mysqli_connect_error());
// } else {
//     // echo "We Are Connected!";
// }



$host = "localhost";
$db_name = "tax_bd";
$username = "root";
$password = "";
define('BASE_URL', '/__work/Web/app/');
define("DIR_URL", $_SERVER['DOCUMENT_ROOT'] . '/');
$conn = mysqli_connect($host, $username, $password, $db_name);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    // echo "We Are Connected!";
}
