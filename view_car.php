<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>View Car</title>
  </head>
  <body>
  <?php include('includes/header.php');?>

  <style>
  body{
      margin:0px;
      padding:0px;
  }
  body:before{
      content:"";
      width:100%;
      height:100%;
      position:absolute;
      background:url('static/img/view_car_bg.jpg') no-repeat center center;
      background-size:cover;
      z-index:-1;
  }
  .card{
      display:inline-block;
      width:30%;
      margin:20px;
      justify-content:center;
      align-items:center;
  }
  .container{
      width:90%;
      margin:auto;
      margin-top:50px;
  }
  .card{
      background:rgba(0,0,0,0.5);
      color:white;
      text-align:center;
  }
  .card-img-top{
      height:250px;
      padding:15px 10px;  
  }
  .card-btn{
      background-color:#ffee01;
      color:black;
      border:black;
      margin:auto;
      width:100%;
  }
  .card-btn:hover{
    background-color:#4e5357;
        cursor: pointer;
        color:white;
  }
  
  </style>
  <div class="container">
  <div class="card" style="" >
  <img src="static/img/sedan.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h3 class="card-title">Sedan</h3>
    <p class="card-text">Sedan models are the most classy ones and our cutomers have reviewed them to be the best for a business trip.</p>
    <a href="sedan.php" class="btn btn-primary card-btn">View Available Cars</a>
  </div>
</div>
<div class="card" style="">
  <img src="static/img/mini.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h3 class="card-title">Mini</h3>
    <p class="card-text">Mini models are small but can take you anywhere and everywhere.Worried about the traffic and need a quick ride? Book a mini.</p>
    <a href="mini.php" class="btn btn-primary card-btn">View Available Cars</a>
  </div>
</div>
<div class="card" style="">
  <img src="static/img/suv.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h3 class="card-title" >SUV</h3>
    <p class="card-text">SUVs are the most comfortable cars. Got a big family trip planned to countryside? Don't worry we got you covered.</p>
    <a href="SUV.php" class="btn btn-primary card-btn">View Available Cars</a>
  </div>
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