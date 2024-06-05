<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="regstyle.css">
<script>
    function validatePassword(){
        let pass1 = document.getElementById('upass').value;
        let pass2 = document.getElementById('conpass').value;

        if(pass1 != pass2){
            document.getElementById('rebar').style.color ='red';
            document.getElementById('rebar').innerHTML ="Passwords don't match";
        }else{
            document.getElementById('rebar').style.color = 'green';
            document.getElementById('rebar').innerHTML = 'Passwords match';
        }
    }
</script>
</head>
<body>
    <div class="container">
        <h1>Medivac Registration</h1>
        <div class="formdiv1">
            <form method="POST" action="">
                <label>Name : </label>
                <input type="text" name="fullname" id="fname" required>

                <label>Password : </label>
                <input type="password" name="userpass" id="upass" required>

                <label>Confirm Password : </label>
                <input type="password" id="conpass" onkeyup="validatePassword();" required>
                <span name="passwords" id="rebar" style="font-size:10px; position:fixed; margin-top:-12px;"></span>

                <label>Phone Number : </label>
                <input type="number" name="tel" id="pnumber" required>

                <label>Location : </label>
                <input type="text" name="location" id="loc" required>

                <label>Gender : </label>
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
</select>

                <button name="rgbtn" id="rbtn">Register</button>
                
                <p>Have an account? <a href="pharmacylogin.php">Log In</a></p>
            </form>
        </div>
    </div>
</body>
<script>

  document.getElementById('rbtn').addEventListener('click', validateForm);

  function validateForm(){
   var a=document.getElementById('fname').value;
    var b=document.getElementById('upass').value;
    var c=document.getElementById('pnumber').value;
    var d=document.getElementById('loc').value;
    

    if( (a==null||a=="") || (b==null||b=="") || (c==null||c=="")  (d==null||d=="")){
       alert("Please fill all the details");  
       return false;  
    }else{
        alert("Details saved")
    }
  }
</script>
<?php
if(isset($_POST['rgbtn'])){
    $name= $pass=$phone=$location=$sex="";

    $name= $_POST['fullname'];
    $pass=$_POST['userpass'];
    $phone=$_POST['tel'];
    $location=$_POST['location'];
    $sex=$_POST['gender'];

    $host="localhost";
    $user="root";
    $password="";
    $dbname="pharreg";
    $conn = new mysqli($host, $user, $password, $dbname);
    if($conn->connect_error){
        die("Connection Failed".$conn->connect_error);
    }

        $query = $conn->prepare("INSERT into users(uname, upassword , phone, location, sex) values(?,?,?,?,?)");
        $query->bind_param("ssiss", $name, $pass, $phone, $location, $sex);
        $query->execute();
        echo '<script>alert("Record Saved")</script>';
    }

?>
</html>