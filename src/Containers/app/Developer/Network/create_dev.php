<?php
$env = parse_ini_file('/src/.env');

$host = $env["HOST"];
$DB = $env["DB"];
$USER = $env['USER'];
$PASS = $env['PASS'];

$con = new mysqli($host, $USER, $PASS, $DB);

$teamName = $_POST['teamname'];
$users = "";
$query = "INSERT INTO `Dev_teams`(`Teamname`, `licenseKey`, `isActive`) VALUES ('$teamName','NULL','1')";

$result = mysqli_query($con, $query);