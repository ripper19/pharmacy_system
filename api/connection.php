<?php
$conn="";

try{
    $host="localhost";
    $user="root";
    $password="";
    $dbname="pharreg";

    $conn = new mysqli($host, $user, $password, $dbname);
}catch(Exception $e){
die ("Connection Failed!!".$e);
}
?>