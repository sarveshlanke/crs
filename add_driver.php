<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Add driver</title>
  </head>
    <style>
      body{
        margin:0px;
        padding:0px;
        background:url("static/img/bg9.jpg");
        background-size :cover;
      }
      label{
  color:white;
}

form{
  background-color:rgba(0,0,0,0.75);
  margin:10px!important;
}

#submit-btn{
  position:relative;
  bottom:30%;
  background-color:#ffee01;
  color:black;
  border:black;
  margin-top:5px;
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
}
      
</style>
  <Body>   
  <?php include('includes/header.php');?>
<?php
     if($_SERVER['REQUEST_METHOD']=='POST')
     {
        $dl_num=$_POST['dl_num'];
        $fname =$_POST['fname'];
        $mname =$_POST['mname'];
        $lname =$_POST['lname'];
        $aadhar_num =$_POST['aadhar_num'];
        $street =$_POST['street'];
        $city =$_POST['city'];
        $state=$_POST['state'];
        $pincode=$_POST['pincode'];
        $experience=$_POST['experience'];
        $email=$_POST['email'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "crs";
        $conn = mysqli_connect($servername, $username, $password, $database);
        // Die if connection was not successful
        if (!$conn){
            die("Sorry we failed to connect: ". mysqli_connect_error());
        }
        $sql ="INSERT INTO `driver` ( `fname`, `mname`, `lname`, `aadhar_num`,`dl_num`,experience, `street`, `city`, `state`, `pincode`, `email`) 
        VALUES ( '$fname', '$mname', '$lname', '$aadhar_num','$dl_num', $experience,'$street', '$city', '$state', '$pincode', '$email');";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<div class="alert success alert-success alert-dismissible fade show" role="alert">
            <strong>Driver registered!</strong>.Driver has been registered successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
           // echo "The car was not inserted successfully because of this error ---> ". mysqli_error($conn);
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>The record was not inserted successfully because of this error --->'. mysqli_error($conn).'</strong> 
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
        }
          
     }
?>
<div class="container mt-3">

    <form action="add_driver.php" method="POST" class="form-group row g-3">
    <h1 class="col-md-12" style="color:#ffee01;text-align:center;">ADD DRIVER</h1>
        <div style="color:white" class="col-md-4">
        <label for="fname" class="form-label" ><strong>First name</strong></label>
        <input type="text" class="form-control" name='fname' id="fname" placeholder="Enter first name" maxlength="30">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="mname" class="form-label" ><strong>Middle name</strong></label>
        <input type="text" class="form-control" name='mname' id="mname" placeholder="Enter middle name" maxlength="30">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="lname" class="form-label" ><strong>Last name</strong></label>
        <input type="text" class="form-control" name='lname' id="lname" placeholder="Enter last name" maxlength="30">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="aadhar_num" class="form-label"><strong>Aadhar number</strong></label>
        <input type="text" class="form-control" id="aadhar_num" name="aadhar_num" placeholder="Enter aadhar number" maxlength="30">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="dl_num" class="form-label" ><strong>Driving license number</strong></label>
        <input type="text" class="form-control" name ='dl_num' id="dl_num" placeholder="Enter driving license number" maxlength="15">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="exerience" class="form-label" ><strong>Experience(years)</strong></label>
        <input type="number" class="form-control" name ='experience' id="experience" placeholder="Enter experience" min="0" max="100">
        </div>
        <div style="color:white" class="col-12">
        <label for="street" class="form-label" ><strong>Street</strong></label>
        <input type="text" class="form-control" name='street' id="street" placeholder="Enter street"  maxlength="100">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="city" class="form-label" ><strong>City</strong></label>
        <input type="text" class="form-control" name='city' id="city" placeholder="Enter City"  maxlength="30">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="state" class="form-label" ><strong>State</strong></label>
        <input type="text" class="form-control" name='state' id="state" placeholder="Enter state" maxlength="30">
        </div>
        <div style="color:white" class="col-md-4">
        <label for="pincode" class="form-label" ><strong>Pincode</strong></label>
        <input type="text" class="form-control" name='pincode' id="pincode" placeholder="Enter pincode" maxlength="30">
        </div>
        <div style="color:white" class="col-12">
        <label for="email" class="form-label" ><strong>email</strong></label>
        <input type="email" class="form-control" name='email' id="email" placeholder="Enter email" maxlength="200">
        </div>
        <div class="col-md-12 mt-5 text-center">
        <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">Submit</button>
        </div>
    </form>
</div>
<?php include('includes/footer.php');?>

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