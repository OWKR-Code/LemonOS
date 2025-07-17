<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mysqli_con_check</title>
</head>
<body>


<?php 
require '/src/Config/db_con.php';

echo SYSTEM_CON_CHECK($con); // This function checks the MySQLi connection and returns an error message if the connection fails.


?>

</body>
</html>