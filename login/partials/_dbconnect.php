<?php
$username="root";
$password="";
$server="localhost";
$database="users";

$conn=mysqli_connect($server,$username,$password,$database);

if(!$conn){
 
    die("Error".mysqli_connect_error);
}


?>