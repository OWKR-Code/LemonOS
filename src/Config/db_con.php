<?php

$con = new mysqli("localhost", "root", "", "DB");

function SYSTEM_CON_CHECK() {
    global $con;
    if ($con->connect_error) {
    return ("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8mb4");
if (!$con) {
    return ("Connection failed: " . mysqli_connect_error());
}

}