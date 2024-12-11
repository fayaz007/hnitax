<?php
session_start();
$_SESSION['captcha'] = rand(1000, 9999); // Generate a new CAPTCHA
echo $_SESSION['captcha']; // Return the new CAPTCHA value
?>
