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
    <link rel="stylesheet" href="appointstyle.css">
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

    <div class="container3">
        <h1>Book an appointment</h1>
        <form method="POST" action="">
            <label>Patient Name: </label>
            <input type="text" name="pname" id="name" required>

            <label>Phone number : </label>
            <input type="number" name="pnumber" id="phonenum" required>

            <label>Date : </label>
            <input type="date" name="appdate" id="apdate" required>

            <label> Time : </label>
            <input type="time" name="apptime" id="aptime" required>

            <button name="bkbtn" id="bbtn">Book</button>
        </form>
</div>
</body>
<script>
    document.getElementById('bbtn').addEventListener('click', validateform);
function validateform(){
    var a =document.getElementById('name').value;
    var b =document.getElementById('phonenum').value;
    var c =document.getElementById('apdate').value;
    var d =document.getElementById('aptime').value;

    if((a==""||a==null) || (b==""||b==null) || (c==""||c==null) || (d==""||d==null)){
        alert("Please fill in all the details");
    }
}

</script>
<?php
if (isset($_POST['bkbtn'])){
    $name = $_POST['pname'];
    $phone = $_POST['pnumber'];
    $date = $_POST['appdate'];
    $time = $_POST['apptime'];

    $query = $conn->prepare("INSERT into bookings(pname, pnumber, `date`, `time`) values(?,?,?,?)");
    $query->bind_param("siss", $name, $phone, $date, $time);
    $query->execute();
    echo'<script>alert("Appointment booked")</script>';
}
?>
</html>