<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kreon:wght@700&display=swap" rel="stylesheet">
    
    <title>Signup</title>
  </head>

  <style>
      body{
        margin:0px;
        padding:0px;
        background: url("static/img/pc.jpg");
        background-size :cover;
        background-attachment:scroll;
        overflow-x: hidden
      }
      .form-label{
        color: #ffee01c7;
        font-size: 18px;
        font-family: 'Kreon', serif;
      }
      h1{
        color: white;
        font-size: 48px;
        font-family: 'Kreon', serif;
      }     
      .form-check-label{
        color: white;
      }

form{
  background-color:rgba(0,0,0,0.75);
  margin:10px!important;
  padding:20px 20px 10px 20px;
}

#submit-btn{
  position:relative;
  bottom:30%;
  background-color:#ffee01;
  color:black;
  border:black;
  margin-top:20px;
}
#submit-btn:hover{
        background-color:#4e5357;
        cursor: pointer;
        color:white;
      } 
.form-control{
  color:#ffffff;
  background-color:#f6f6f600;
  border-radius:1.25rem;
  border-color:white;
} 
  
  </style> 

  <body>
  <?php
include("includes/header.php");
?>
<!-- Js function -->
<script>
function drivingLicense() {
  var checkBox = document.getElementById("dlcheck");
  var text = document.getElementById("dl");
  var dllbl =document.getElementById("dllbl");
  if (checkBox.checked == true){
    text.style.display = "block";
    dllbl.style.display = "block";
  } else {
     text.style.display = "none";
     dllbl.style.display = "none";
  }
}
function adminCheckFunction() {
  var checkBox = document.getElementById("adminCheck");
  var text = document.getElementById("adminpass");
  var adlbl =document.getElementById("adminlbl");
  if (checkBox.checked == true){
    text.style.display = "block";
    adlbl.style.display = "block";
  } else {
     text.style.display = "none";
     adlbl.style.display = "none";
  }
}
</script>

<!-- SQL connection and DML -->

<?php include('includes/sqlconn.php');?>

<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $email = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];
        $conpass = $_POST['confirmInputPassword'];
        $aadhar = $_POST['aadhar'];
        $street= $_POST['street'];
        $city =$_POST['city'];
        $state = $_POST['state'];
        $zip =$_POST['zip'];
        $phone=$_POST['phone'];
        if($password==$conpass){
            $sql = "INSERT INTO info (email,password,fname,mname,lname,aadhar,phone,street,city,state,pincode,is_admin) VALUES ('$email','$password','$fname','$mname','$lname','$aadhar',$phone,'$street','$city','$state',$zip,0);";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Sucessfully signed Up</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>The record was not inserted successfully because of this error --->'. mysqli_error($conn).'</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>The record was not inserted successfully as password was not confirmed successfully'. mysqli_error($conn).'</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if(isset($_POST['dl']) && $_POST['dl']!=""){
            $dl=$_POST['dl'];
            $sql= "UPDATE info set dl='$dl' where email='$email';";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sccessfully added your DL Number</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>DL could not added successfully because of this error --->'. mysqli_error($conn).'</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        if(isset($_POST['adminpass']) && $_POST['adminpass']=="admin"){
            $sql= "UPDATE info set is_admin=1 where email='$email';";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sccessfully given admin rights</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Admin rights was not given successfully because of this error --->'. mysqli_error($conn).'</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        
    
    }

    
?>


<!-- Page front end -->
<div class="container my-5">
    <div class="container mt-1">
<form class="form-group row g-3" action="./signup.php" method="POST">
<h1 style='text-align:center;color:#ffee01'>Signup</h1>
  <div class="col-md-4">
    <label for="fname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name">
  </div>
  <div class="col-md-4">
    <label for="mname" class="form-label">Middle Name</label>
    <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter Middle Name">
  </div>
  <div class="col-md-4">
    <label for="lname" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name">
  </div>
  <div class="col-12">
    <label for="inputEmail" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email id">
  </div>
  <div class="col-md-6">
    <label for="inputPassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Enter password">
  </div>
  <div class="col-md-6">
    <label for="confirmInputPassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirmInputPassword" name="confirmInputPassword" placeholder="Confirm password">
  </div>
  <div class="col-md-6">
    <label for="aadhar" class="form-label">Aadhar No.</label>
    <input type="text" class="form-control" id="aadhar" name="aadhar"placeholder="Enter Aadhar No." maxlength="12">
  </div>
  <div class="col-md-6">
    <label for="phone" class="form-label">Mobile no.</label>
    <input type="number" class="form-control" id="phone" name="phone" min="0" max="9999999999" placeholder="Enter personal Mobile no.">
  </div>
  <div class="col-12">
    <label for="street" class="form-label">Street</label>
    <input type="text" class="form-control" id="street" name="street" placeholder="Enter Street">
  </div>
  <div class="col-md-6">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
  </div>
  <div class="col-md-4">
    <label for="state" class="form-label">State</label>
    <input type="text" class="form-control" id="state" name="state" placeholder="Enter State">
  </div>
  <div class="col-md-2">
    <label for="zip" class="form-label">Zip</label>
    <input type="number" class="form-control" id="zip" name="zip" min="0" max="99999999">
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="dlcheck" onclick="drivingLicense()">
      <label class="form-check-label" for="dlCheck" style="color:#ffee01c7">
        Do you own a Driving License?
      </label>
    </div>
  </div>
  <div class="col-12">
  <label  id="dllbl" for="dl" class="form-label" style="display:none">Driving License No.</label>
  <input type="text" class="form-control" id="dl" name="dl" style="display:none">
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="adminCheck" onclick="adminCheckFunction()">
      <label class="form-check-label" for="adminCheck" style="color:#ffee01c7">
        Are you an admin?
      </label>
    </div>
  </div>
  <div class="col-12">
  <label  id="adminlbl" for="adminpass" class="form-label" style="display:none">Admin Verification Password</label>
  <input type="password" class="form-control" id="adminpass" name="adminpass" style="display:none">
  </div>

  <div class="col-12 text-center" >
    <button type="submit" class="btn btn-light btn-lg" id="submit-btn">Sign up</button>
  </div>
  </div>
</form>
    
<?php include('includes/footer.php');?>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>
