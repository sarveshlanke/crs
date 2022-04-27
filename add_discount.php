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
    <title>New dicount coupon</title>
    <?php include('includes/header.php');?>
  </head>
  <style>
      body{
        margin:0px;
        padding:0px;
      }
      body:before{
        content:"";
        width:100%;
        height:100%;
        display: block;
        background: url("static/img/background.jpg") center center;
        background-repeat:repeat;
        background-size:cover;
        position: absolute;
        top:0px;
        left:0px;
        margin:0px;
        padding:0px;
        opacity:0.85;
        z-index: -1;
      }
    
      h1{
        color: black;
        font-size: 48px;
        font-family: 'Kreon', serif;
      }
      .btn:hover{
        background-color:#4e5357;
        cursor: pointer;
      }   
      label{
  color:white !important;
}

form{
  background-color:rgba(0,0,0,0.75);
  margin:10px!important;
  padding:30px 30px 10px 30px;
}

.btn{
  position:relative;
  bottom:30%;
  background-color:#ffee01;
  color:black;
  border:black;
  margin-top:5px;
}
.form-control{
  color:#ffffff;
  background-color:#f6f6f600;
  border-radius:1.25rem;
}  
</style> 
  
  <body>
  <?php include('includes/sqlconn.php');?>

  <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dcode = $_POST['dcode'];
        $dname = $_POST['dname'];
        $dper =$_POST['Dper'];
        $expiry = $_POST['Expiry'];
        $sql = "INSERT INTO discount VALUES ('$dcode','$dname',".$dper.", '$expiry')";
        $result = mysqli_query($conn, $sql);
        
    if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>New discount coupon has been added</strong> 
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


<div class="container mt-5 col-md-6">
  
<h1 style='text-align:center;'> Add New Discount Coupon </h1>

<div class="container mt-3">

  <form action="add_discount.php" method="POST" class="form-group">
  <div class="mb-4 col-md-12">
  <label for="dcode" class="form-label" ><strong>Discount Code</strong></label>
  <input type="text" class="form-control" name ='dcode' id="dcode" placeholder="Enter Dicount Code" maxlength="10">
</div>
<div class="mb-4 col-md-12">
  <label for="dname" class="form-label" ><strong>Discount name </strong></label>
  <input type="text" class="form-control" name='dname' id="dname" placeholder="Enter Discount name" maxlength="20">
</div>
<div class="mb-4 col-md-12">
<label for="Dper" class="form-label"><strong>Discount Percentage</strong></label>
<input type="number" class="form-control" id="Dper" name="Dper" placeholder="Enter Discount Percentage" min="0" max="100">
</div>
<div class="mb-4 col-md-12">
<label for="Expiry" class="form-label"><strong>Expiry</strong></label>
<input type="date" class="form-control" id="Expiry" name="Expiry">
</div>
<div class="col-md-12 text-center">
<button type="submit" class="btn btn-dark btn-lg">Submit</button>
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
