<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kreon:wght@500&display=swap" rel="stylesheet">
    <title>New Location</title>
  </head>
  <style>
      body{
        margin:0px;
        padding:0px;
        background: url("static/img/bg3.jpg");
        background-size :cover;
      }
      .form-group{
        width: 100%;
        margin: auto;
      }
      .form-label{
        color: black;
        font-size: 23px;
        font-family: 'Kreon', serif;
      }
      h1{
        color: black;
        font-size: 50px;
        font-family: 'Kreon', serif;
      }
      label{
  color:white !important;
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
} 
      
</style>
  
  <body>
  <?php include('includes/header.php');?>
  <?php include('includes/sqlconn.php');?>
  <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $locid = $_POST['locid'];
        $lname = $_POST['lname'];
        $street =$_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $sql = "INSERT INTO Location VALUES ('$locid','$lname','$street','$city', '$state',".$zip.")";
        $result = mysqli_query($conn, $sql);

    if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>New location has been added</strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>The record was not inserted successfully because of this error --->'. mysqli_error($conn).'</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
      // Submit these to a database
    }
    
?>

<div class="container mt-5">
<div class="container mt-6">

  <form action="add_new_loc.php" method="POST" class="form-group row g-3">
  <h1 style='text-align:center;color:#ffee01;'> Add New Location </h1>
  <div class="mb-2">
  <label for="locid" class="form-label" ><strong>Location ID</strong></label>
  <input type="text" class="form-control" name ='locid' id="locid" placeholder="Enter Location ID" maxlength="10">
</div>
<div class="mb-2">
  <label for="lname" class="form-label" ><strong>Location name </strong></label>
  <input type="text" class="form-control" name='lname' id="lname" placeholder="Enter Location name" maxlength="20">
</div>
<div class="col-md-6">
  <label for="street" class="form-label" ><strong>Street name </strong></label>
  <input type="text" class="form-control" name='street' id="street" placeholder="Enter Street name" maxlength="20">
</div>
<div class="col-md-6">
  <label for="city" class="form-label" ><strong>City name </strong></label>
  <input type="text" class="form-control" name='city' id="city" placeholder="Enter City name" maxlength="20">
</div>
<div class="col-md-6">
  <label for="state" class="form-label" ><strong>State name </strong></label>
  <input type="text" class="form-control" name='state' id="state" placeholder="Enter State name" maxlength="20">
</div>
<div class="col-md-6">
<label for="zip" class="form-label"><strong>Pincode</strong></label>
<input type="number" class="form-control" id="zip" name="zip" min="0" max="1000000" placeholder="Enter Pincode">
</div>
<div class="col-md-12 text-center">
<button type="submit" class="btn btn-dark btn-lg" id="submit-btn">Submit</button>
</div>
  </form>
</div>
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
