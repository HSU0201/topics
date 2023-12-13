<?php
session_start();

unset($_SESSION["user"]);

header("location:user_signin.php");

?>