<?php

session_start();
session_unset();
session_destroy();

echo("You have been logged out! Log in again to continue<br>");
echo ("<br/><a style=\"text-decoration:none;color:royalblue;\" href='login.php'>Go to log in page</a>");
?>

