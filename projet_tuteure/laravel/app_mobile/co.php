<?php
$host_name = 'localhost';
$database = 'projet_tut';
$user_name = 'projet_tuteure';
$password = 'projet_tut';

$connect = mysqli_connect($host_name, $user_name, $password, $database) or die(mysqli_connect_error());

