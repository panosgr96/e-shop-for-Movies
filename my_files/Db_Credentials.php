<?php
$host = "localhost";
$user = "root";
$passwd = "";
$database = "movies_db";

$Connection =   mysqli_connect($host, $user, $passwd,$database) or die(mysqli_error($Connection));
?>