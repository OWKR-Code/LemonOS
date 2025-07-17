<?php
session_start(); // Init session

require '/src/Config/db_con.php';


$sessionID = $_SESSION['sessionCode'];

if (empty($sessionID)) {
header('Location: /LemonOS/index.php');
}

if (empty($con)) {
    echo "Database connection failed.";
    exit();
}


    function IdCheck($sessionID) {

        global $con;

        $query = "SELECT count(*) FROM containers WHERE session_id = $sessionID";
        $result = mysqli_query($con, $query);

    }
