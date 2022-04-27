<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Add new Car</title>
    <?php include('includes/header.php');?>
  </head>
    <style>
      body{
        margin:0px;
        padding:0px;
        background:url("static/img/car1.jpg");
        background-size :cover;
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
.btn:hover{
        background-color:#4e5357;
        cursor: pointer;
      } 
.form-control{
  color:#ffffff;
  background-color:#f6f6f600;
  border-radius:1.25rem;
} 
::placeholder{
  color:grey !important;
  opacity:0.6;
} 
      
</style>
  <Body>   
  <?php include('includes/sqlconn.php');?>
<?php
     if($_SERVER['REQUEST_METHOD']=='POST')
     {
        $regno=$_POST['regno'];
        $model =$_POST['model'];
        $make =$_POST['make'];
        $model_year =$_POST['model_year'];
        $mileage =$_POST['mileage'];
        $car_category = $_POST['car_category'];
        $sql ="INSERT INTO car VALUES ('$regno', '$model', '$make', $model_year, $mileage,'$car_category')";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<div class="alert success alert-success alert-dismissible fade show" role="alert">
            <strong>Car registered!</strong>. your Car has been registered successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
        //    echo "The car was not inserted successfully because of this error ---> ". mysqli_error($conn);
           echo '<div class="alert success alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> Due to some technical issues your request can not be processed.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
          
     }
?>
<div class="container mt-3">
<h1 style="color:black;text-align:center;">ADD NEW CAR </h1>
    <form action="add_car.php" method="POST">
        <div style="color:white" class="mb-3">
        <label for="regno" class="form-label" ><strong>Registration No.</strong></label>
        <input type="text" class="form-control" name ='regno' id="regno" placeholder="Enter registraion no. of the car" maxlength="15">
        </div>
        <div style="color:white" class="mb-3">
        <label for="make" class="form-label"><strong>Make</strong></label>
        <input type="text" class="form-control" id="make" name="make" placeholder="Enter Make of the car" min="0" max="10000">
        </div>
        <div style="color:white" class="mb-3">
        <label for="model" class="form-label" ><strong>Model</strong></label>
        <input type="text" class="form-control" name='model' id="model" placeholder="Enter model of the car" maxlength="15">
        </div>
        <div style="color:white" class="mb-3">
        <label for="model_year" class="form-label" ><strong>Model Year</strong></label>
        <input type="number" class="form-control" name='model_year' id="model_year" placeholder="Enter Model Year" min="1900" max="2100" value="2021">
        </div>
        <div style="color:white" class="mb-3">
        <label for="mileage" class="form-label" ><strong>Mileage</strong></label>
        <input type="number" class="form-control" name='mileage' id="mileage" placeholder="Enter mileage" min="0" max="100" value="15">
        </div>
        <div style="color:white" class="mb-3">
        <label for="car_category" class="form-label" ><strong>Car Category</strong></label>
        <select id="car_category" name="car_category" class="form-control" placeholder="Select Car category">
        <?php
            $sql = 'select cat_name from car_cat';
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value='".$row['cat_name']."'>".$row['cat_name']."</option>";           
            }
        ?>
        </select>
        </div>
        <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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