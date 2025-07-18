<?php
$env = parse_ini_file('/src/.env');

$host = $env["HOST"];
$DB = $env["DB"];
$USER = $env['USER'];
$PASS = $env['PASS'];

$con = new mysqli($host, $USER, $PASS, $DB);
