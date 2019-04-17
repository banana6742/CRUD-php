<?php

define('DB_SERVER',"localhost");
define('DB_USER',"root");
define('DB_PASS',"");
define('DB_NAME',"crud");

$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

if(!$conn)
    echo "Error connecting to the database:".mysqli_connect_error();
else
    echo "Connected Successfully";


?>