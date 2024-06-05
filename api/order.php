<?php
session_start();

$host="localhost";
$user="root";
$password="";
$dbname="pharreg";
$conn = new mysqli($host, $user, $password, $dbname);
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}
if (isset($_SESSION['uname']) && isset($_SESSION['phone']) && $_SESSION['loggedin']=TRUE){
    echo"";
    }else{
        echo'<script>alert("Please login")</script>';
    
        echo "<script>setTimeout(\"location.href = 'pharmacylogin.php';\",0.5);</script>";
       
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="orderpage.css">
</head>
<body>
    <ul>
    <li style="color: white; float:left; font-size: 20px; padding:10px 23px;">
                <?php
                $name = $_SESSION['uname'];

    $query = "SELECT *FROM users WHERE uname= '$name'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1 ){

        while($row = mysqli_fetch_assoc($result)){
            $name =$row['uname'];

            echo(" Welcome $name");
        }
    }else{
        echo("Not found");
    }
?></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="appointmen.php">Appointments</a></li>
            <li><a href="order.php">Order Medicine</a></li>
            <li><a href="index.php">Home</a></li>
        </ul>

        <div class="container2">
            <h1>Order Medicine Prescription</h1>
            <form method="POST" action="">
                <label>Patient name : </label>
                <input type="text" name="pname" id="name" required>

                <label>Phone number : </label>
                <input type="tel" name="pnumber" id="numb" required>

                <label>Prescription : </label>
                <input type="text" name="prescription" id="prescribe" required>

                <button name="ordbtn" id="obtn">Order</button>
                <button name="upbtn" id="ubtn" onclick="validateform()" required>Update</button>
            </form>
        </div>
</body>
<script>
    document.getElementById('obtn').addEventListener('click', validateform);

    function validateform(){
        var a=document.getElementById('name').value;
        var b =document.getElementById('prescribe').value;
        var c =document.getElementById('numb').value;

        if((a==null||a=="") || (b==null||b=="") || (c==null||c=="")){
            alert("Please fill in the details");
            return false;
        }
    }
</script>
<?php
if(isset($_POST['ordbtn'])){
$pname = $prescription=$pnumber="";

$pname=$_POST['pname'];
$pnumber = $_POST['pnumber'];
$prescription=$_POST['prescription'];

$host="localhost";
$user="root";
$password="";
$dbname="pharreg";
$conn = new mysqli($host, $user, $password, $dbname);
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}

    $query = $conn->prepare("INSERT into orders(pname , phone, prescription) values(?,?,?)");
    $query->bind_param("sis", $pname ,$pnumber, $prescription);
    $query->execute();
    exit();
    echo'<script>alert("Record added")</script>';
}

if (isset($_POST['upbtn'])){
    $pname=$_POST['pname'];
    $pnumber = $_POST['pnumber'];
    $prescription=$_POST['prescription'];

$state = "UPDATE orders SET `prescription`= '$prescription' WHERE `pname`= '$pname' AND `phone`= '$pnumber'";

if(mysqli_query($conn,$state)){
    echo'<script>alert"Details Updated"</script>';
}else{
    echo'<script>alert"Details not found</script>';
}
}
?>

</html>