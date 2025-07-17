<?php

session_start();

$sessionCode = rand(1000, 9999);
$_SESSION['sessionCode'] = $sessionCode;

header('Location: public/login/login.php');