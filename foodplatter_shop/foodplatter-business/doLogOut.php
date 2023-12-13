<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["certified"]["error"]);
header("location:business-login.php");
