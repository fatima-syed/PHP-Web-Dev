<?php

session_start();
$_SESSION['userName'] = "Fatima";
$_SESSION['cmdId'] = 337346;

setcookie("University", "NUST", time() + (86400), "/"); // 86400s = 1 day
echo($_SESSION['userName'] . '! Log in successfull!');
echo("<br>Cookies have been set");
echo "<br/><a style=\"text-decoration:none;color:royalblue;\" href='index.php'>View Changes</a>";

?>
