<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pharmacylogin.css">
</head>
<body>
    <div class="container">

        <h1>Medivac Login</h1>

        <div class="formdiv">
            <form method="POST" action="">
                <label>Name : </label>
                <input type="text" name="fullname" required>

                <label>Phone number: </label>
                <input type="text" name="pnumber" required>

                <label>Password : </label>
                <input type="password" name="userpass" required>
<div class="buttons">
                <button name="lgnbtn">Login</button>
</div>
<div class="register">
 <p>Don't have an account?  <a href="pharmreg.php">Register</a></div></p> 
            </form>
        </div>
    </div>
</body>
<?php
session_start();

if(isset($_POST['lgnbtn'])){
$name=$pass="";
$name=$_POST['fullname'];
$pnumber =$_POST['pnumber'];
$pass=$_POST['userpass'];

$host="localhost";
$user="root";
$password="";
$dbname="pharreg";

$conn = new mysqli($host, $user, $password, $dbname);
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}

    $query = "SELECT *FROM users WHERE uname='$name' AND phone='$pnumber' AND upassword='$pass' ";
    $result =$conn->query($query);
   

    if($result->num_rows==1){

        $_SESSION['loggedin']=TRUE;
        
        $_SESSION['uname']=$_POST['fullname'];
        $_SESSION['phone']=$_POST['pnumber'];

        header("Location:index.php");
        exit();
    }else{
        echo("Login Details Invalid");
        exit();
    }
}


?>
</html>