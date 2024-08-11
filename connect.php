<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="database123";

$conn=mysqli_connect($server_name,$username,$password,$database_name);
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}


?>