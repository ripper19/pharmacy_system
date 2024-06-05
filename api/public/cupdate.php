<?php
session_start();
if(isset($_SESSION['uname']) AND ($_SESSION['phone']) ){

}
$host = "localhost";
$user ="root";
$password = "";
$dbname = "pharreg";

 $con= new mysqli($host, $user, $password, $dbname);
    $name = $_SESSION['uname'];
    $phone = $_SESSION['phone'];

    $npass = $_POST['npass'];

    $st= "UPDATE users SET `upassword`='$npass' WHERE `uname`='$name' AND phone='$phone'";
    if(mysqli_query($con, $st)){
        echo'<script>alert("Password updated")</script>';

        echo "<script>setTimeout(\"location.href = 'pharmacylogin.php';\",0.5);</script>";
    }
?>