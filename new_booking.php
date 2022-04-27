<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>New Booking</title>
  </head>
  
  <body>
  <?php 
      include('includes/header.php');
      include('includes/sqlconn.php');
  ?>
   <script>
      document.getElementById("newBooking-btn").style.display="none";
      </script>


<!-- Backend php -->
<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $pdt = $_POST['pickupdt'];
        $ddt = $_POST['dropdt'];
        $regno = $_POST['car'];
        $pstr = $_POST['pickupStreet'];
        $dstr = $_POST['dropStreet'];
        $pcity = $_POST['pickupCity'];
        $dcity = $_POST['dropCity'];
        $discount =NULL;
        $pickupLocId = "";
        $dropLocId = ""; 
        $driverOpted =0;
        $user="";
        $driver="";
        if(isset($_POST['driver'])){
          $driver=$_POST['driver'];
        }
        if(isset($_SESSION['user'])){
          $user = $_SESSION['user'];
        }
        if(!(empty($_POST['driverCheck']))){
          $driverOpted=1;
        }
        if(isset($_POST['discountpass'])){
          $dcheck= $_POST['discountpass'];
          $date=date_create($pdt);
          $pdate = date_format($date,"Y-m-d");
          $sql ="select * from discount where Dcode='$dcheck' and expiry>='$pdate';";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $discount = $row['Dcode'];
          }

        }
          $sql ="select locid from location where street='$pstr' and city='$pcity';";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $pickupLocId = $row['locid'];
          }
          $sql ="select locid from location where street='$dstr' and city='$dcity';";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $dropLocId = $row['locid'];
          }
          if(is_null($discount)){
            $sql ="Insert into booking(start_date,end_date,status,pickup_locid,drop_locid,driver_opted,user_email) values('$pdt','$ddt','unpaid','$pickupLocId','$dropLocId',$driverOpted,'$user');";
          }
          else{
            $sql ="Insert into booking(start_date,end_date,status,pickup_locid,drop_locid,driver_opted,user_email,dcode) values('$pdt','$ddt','unpaid','$pickupLocId','$dropLocId',$driverOpted,'$user','$discount');";
          }
          
          $result = mysqli_query($conn, $sql);
          if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>New booking has been added</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>The record was not inserted successfully because of this error --->'. mysqli_error($conn).'</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        $sql = "select last_insert_id();";
        $bid = 0;
        $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $bid = $row['last_insert_id()'];
          }
          if (!(empty($_POST['driverCheck']))){
            $sql ="insert into driver_booking values('$driver',$bid);" ;
            $result = mysqli_query($conn, $sql);
            if($result){
                //     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                //   <strong>Driver booking has been added</strong> 
                //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                // </div>';
                // $sql = "select email from driver where dl_num='$driver';";
                // $result2 = mysqli_query($conn, $sql);
                // if(mysqli_num_rows($result2)>0){
                //   $row=mysqli_fetch_assoc($result2);
                //   $to = $row['email'];
                //   $subject = "New Booking for you";
                //   // Always set content-type when sending HTML email
                //   $message = "New booking for You , pickup Location and Time : $pstr , $pdt";
                //   // More headers
                //   $headers = 'From: shivamagr2711@gmail.com' . "\r\n";

                //   mail($to,$subject,$message,$headers);
                // }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>The record was not inserted successfully because of this error --->'. mysqli_error($conn).'</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
          }
         
         $sql ="insert into car_booking values('$regno',$bid);" ;
         $result = mysqli_query($conn, $sql);
         if($result){
      //     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      //   <strong>Car Booking has been added</strong> 
      //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      // </div>';
      }
      else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>The record was not inserted successfully because of this error --->'. mysqli_error($conn).'</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      }
    }  
?>


  <!-- show Available cars -->
<script>
function loadCars(){
    var value = document.getElementById("car_category");
    var car_category = value.options[value.selectedIndex].text;
    var pickupdt = document.getElementById("pickupdt").value;
    var dropdt = document.getElementById("dropdt").value;

        $.ajax({
            url: "includes/availableCar.php",
            dataType: 'Json',
            data: {'id':car_category,'pickup':pickupdt,'dropdt':dropdt},
            success: function(response) {
                $('select[name="car"]').empty();
                $('select[name="car"]').append('<option value="">--Choose Car--</option>');
                var len = response.length;
                for(var i=0; i<len; i++){
                  var id = response[i].regno;
                  var model =response[i].model;
                  var make = response[i].make;
                  var model_year = response[i].model_year;
                  var mileage = response[i].mileage;
                    $('select[name="car"]').append('<option value="'+ id +'">'+make+'&nbsp;'+ model+' --> Model Year : '+model_year+' --> Mileage : ' +mileage+'</option>');
                }
            },
        });
}
</script>

<!-- show pickup cities -->
<script>
function loadPickupCity(){
    var pstr = document.getElementById("pickupStreet");
    var pstreet = pstr.options[pstr.selectedIndex].text;
        $.ajax({
            url: "includes/availableCity.php",
            dataType: 'Json',
            data: {'id':pstreet},
            success: function(response) {
                $('select[name="pickupCity"]').empty();
                $('select[name="pickupCity"]').append('<option value="">--Choose city--</option>');
                var len = response.length;
                for(var i=0; i<len; i++){
                  var id = response[i].city;
                    $('select[name="pickupCity"]').append('<option value="'+ id +'">'+id+'</option>');
                }
            },
        });
}
</script>

<!-- show available drivers -->
<script>
function loadDrivers(){
    var pcty = document.getElementById("pickupCity");
    var pcity = pcty.options[pcty.selectedIndex].text;
    var pickupdt = document.getElementById("pickupdt").value;
    var dropdt = document.getElementById("dropdt").value;
    console.log(pcity);
        $.ajax({
            url: "includes/availableDriver.php",
            dataType: 'Json',
            data: {'city':pcity,'pickup':pickupdt,'dropdt':dropdt},
            success: function(response) {
                $('select[name="driver"]').empty();
                $('select[name="driver"]').append('<option value="">--Choose driver--</option>');
                var len = response.length;
                for(var i=0; i<len; i++){
                  var dlno = response[i].dl_num;
                  var fname =response[i].fname;
                  var lname = response[i].lname;
                  var exp = response[i].experience;
                    $('select[name="driver"]').append('<option value="'+ dlno +'">'+fname+'&nbsp;'+ lname+' --> Experience : '+exp+'</option>');
                }
            },
        });
}
</script>

<!-- show drop off cities -->
<script>
function loadDropCity(){
    var dstr = document.getElementById("dropStreet");
    var dstreet = dstr.options[dstr.selectedIndex].text;
        $.ajax({
            url: "includes/availableCity.php",
            dataType: 'Json',
            data: {'id':dstreet},
            success: function(response) {
                $('select[name="dropCity"]').empty();
                var len = response.length;
                $('select[name="dropCity"]').append('<option value="">--Choose city--</option>');
                for(var i=0; i<len; i++){
                  var id = response[i].city;
                    $('select[name="dropCity"]').append('<option value="'+ id +'">'+id+'</option>');
                }
            },
        });
}
function discountCheckFunction() {
  var checkBox = document.getElementById("discountCheck");
  var text = document.getElementById("discountpass");
  var adlbl =document.getElementById("discountlbl");
  if (checkBox.checked == true){
    text.style.display = "block";
    adlbl.style.display = "block";
  } else {
     text.style.display = "none";
     adlbl.style.display = "none";
  }
}
</script>
<script>
function driverOptedFunction() {
  var checkBox = document.getElementById("driverCheck");
  var text = document.getElementById("driver");
  var adlbl =document.getElementById("driverlbl");
  if (checkBox.checked == true){
    text.style.display = "block";
    adlbl.style.display = "block";
  } else {
     text.style.display = "none";
     adlbl.style.display = "none";
  }
}
</script>

<!-- Form front end -->

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
  background:url("static/img/new_booking_bg.jpg") no-repeat center center;
  background-size:cover;
  z-index:-1;
}

label{
  color:white;
}

form{
  background-color:rgba(0,0,0,0.5);
  margin-bottom:10px;
}

#submit-btn{
  position:relative;
  bottom:30%;
  background-color:#ffee01;
  color:black;
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
<div class="container mt-5">

  <form action="new_booking.php" method="POST" class="form-group row g-3">
  <div class="col-md-12 text-center" style="margin-top:10px;color:#ffee01;"><h1>New Booking</h1></div>
      <div class="col-md-6">
      <label for="pickupdt" class="form-label"><strong>Pickup&nbsp;Date&nbsp;Time</strong></label>
      <input type="datetime-local" class="form-control" id="pickupdt" name="pickupdt">
      </div>
      <div class="col-md-6">
      <label for="dropdt" class="form-label"><strong>Drop&nbsp;Date&nbsp;Time</strong></label>
      <input type="datetime-local" class="form-control" id="dropdt" name="dropdt">
      </div>
      <div class="col-md-6">
      <label for="car_category" class="form-label" ><strong>Select Car category</strong></label>
      <select id="car_category" name="car_category" class="form-control" onchange="loadCars()" >
        <?php
            $sql = 'select distinct(category) as cat_name from car';
            $result = mysqli_query($conn, $sql);
            echo "<option value=''>--Choose Car category--</option>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value='".$row['cat_name']."'>".$row['cat_name']."</option>";           
            }
        ?>
        </select>
    </div>
    <div class="col-md-6">
      <label for="car" class="form-label" ><strong>Select Car</strong></label>
      <select id="car" name="car" class="form-control" >
        </select>
    </div>
    <div class="col-md-6">
      <label for="pickupStreet" class="form-label" ><strong>Select Pickup Street</strong></label>
      <select id="pickupStreet" name="pickupStreet" class="form-control" onchange="loadPickupCity()">
        <?php
            $sql = 'select distinct(street) from location';
            $result = mysqli_query($conn, $sql);
            echo "<option value=''>--Choose Street--</option>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value='".$row['street']."'>".$row['street']."</option>";           
            }
        ?>
        </select>
    </div>
    <div class="col-md-6">
      <label for="pickupCity" class="form-label" ><strong>Select Pickup City</strong></label>
      <select id="pickupCity" name="pickupCity" class="form-control" onchange="loadDrivers()" >
        </select>
    </div>
    <div class="col-md-6">
      <label for="dropStreet" class="form-label" ><strong>Select Dropping Street</strong></label>
      <select id="dropStreet" name="dropStreet" class="form-control" onchange="loadDropCity()">
        <?php
            $sql = 'select distinct(street) from location';
            $result = mysqli_query($conn, $sql);
            echo "<option value=''>--Choose Street--</option>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<option value='".$row['locid']."'>".$row['street']."</option>";           
            }
        ?>
        </select>
    </div>
    <div class="col-md-6">
      <label for="dropCity" class="form-label" ><strong>Select dropping City</strong></label>
      <select id="dropCity" name="dropCity" class="form-control" >
        </select>
    </div>
    
    <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="driverCheck" name="driverCheck" onclick="driverOptedFunction()">
      <label class="form-check-label" for="driverCheck">
        Want to opt for a Driver?
      </label>
    </div>
  </div>
  <div class="col-4">
      <label for="driver" id="driverlbl" class="form-label" style="display:none"><strong>Select driver</strong></label>
      <select id="driver" name="driver" class="form-control" style="display:none" >
        </select>
    </div>
    <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="discountCheck" name="discountCheck" onclick="discountCheckFunction()">
      <label class="form-check-label" for="discountCheck">
        Have a discount coupon?Redeem now!
      </label>
    </div>
  </div>
  <div class="col-4">
  <label  id="discountlbl" for="discountpass" class="form-label" style="display:none">Enter discount Coupon</label>
  <input type="text" class="form-control" id="discountpass" name="discountpass" style="display:none">
  </div>
    <div class="col-md-12 text-center">
    <button type="submit" class="btn btn-dark btn-lg" id="submit-btn">Submit</button>
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