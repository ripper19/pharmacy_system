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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="profstyle.css">
    <style>

        input{
    width: 80%;
    padding: 5px 0;
    text-align: left;
    font-size: 16px;
    line-height: 1.5;
    color: white;

    margin-left: 15px;
    margin-bottom: 30px;
    background: transparent;
    border: none;
    outline: none;
    border-bottom: 1px solid white;
}
label{
    margin-left: 15px;
    font-size: 20px;
    color: beige;
}
        .medical button{
            font-size: 20px;
            position: relative;
            top: 25%;
            left: 25%;
            font-weight: 500;
            line-height: 1.5;
        }
    </style>
    <script>
        function validatepass(){
            var a =document.getElementById('npass').value;
            var b =document.getElementById('conpass').value;

            if(a!=b){
                document.getElementById('npass').style.borderColor="red";
                document.getElementById('conpass').style.borderColor="red";

            }else{
                document.getElementById('npass').style.borderColor="green";
                document.getElementById('conpass').style.borderColor="green";
            }
        }
    </script>
</head>
<body>
    <ul>
    <li style="float: left; padding:8px; margin: 4px 5px 0;"><box-icon name='user-circle' color='white' size='50px'></box-icon></li>
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
            <li><a href="pharmhome.php">Home</a></li>
        </ul>

        <div class="container">

            <div class="medical">
                <h2>Ordered Prescription(s)</h2>
                <label><u>Prescription </u></label>
                <p style="text-align:left; width:75%; position:relative; left:10%; line-height:2; font-size:20px; font-family:Helvetica; color:white;">
                <?php
        

                $sql = "SELECT * FROM orders where pname= '$name'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_array($result);
                    $prescription = $row["prescription"];
                    echo $prescription;
                }else{
                    echo("No Record Found");
                }
                
                ?></p>
              <br>

             <a href="order.php"> <button style="margin-left: 40px;">Order</button> </a>
            </div>
<div class="chpsw">
   
<form action="cupdate.php" method="POST">
<h2>Change Password</h2>
    <p style="margin:-40px 150px 0;"><box-icon name='cog'size='80px' color='white'></box-icon></p>

    <label>Old Password : </label>
    <input type="password" name="oldpass">
<br>
    <label>New Password : </label>
    <input type="password" name="npass" id="npass" value="npass">

    <label>Confirm New Password : </label>
    <input type="password" name="confirmpass" id="conpass" onkeyup="validatepass()"><br>

    <input type="submit" value="Update" style="font-size: 19px; border:1px solid black;"/>

        
</form>
    
</div>

            <div class="appointment">

                <h2>Appointments Booked</h2>

                <label>Date booked: </label>
                <input type="text" value="
                <?php 
                $select = "SELECT *FROM bookings where pname='$name'";
                $res = mysqli_query($conn,$select);
                if(mysqli_num_rows($res)>0){
                    $edit = mysqli_fetch_array($res);
                  $date = $edit['date'];
                  $time = $edit['time'];
                  echo $date;
                }else{
                    echo("No Record Found");
                }
                ?>">
                <br>
<label>Time booked: </label>
<input type="text" value="
<?php
if(mysqli_num_rows($res)>0){
    $edit = mysqli_fetch_array($res);
    $date = $edit['date'];
                  $time = $edit['time'];
                  echo $time;
}else{
    echo("No Record Found");
}
?>
">
            </div>

        </div>
<div style="width:20vw; height:45px; padding:12px 15px; border:1px solid black inset; background:white; position:absolute; top:87%; left:40%; text-align:center;">
        <a href="log.php" style="color:black; text-decoration:none; font-size:25px;">Log out</a>
</div>
</body>
<script>
document.getElementById('updatebtn').addEventListener('click', validate);
function validate(){
    var a = document.getElementById('pres').value;

    if((a==null||a=="No Record Found"||a=="")){
        alert("Please input valid details");
        return false;
    }
}
</script>

</html>