<header>

<script type="text/javascript">
    function logout() {
        document.location = 'logout.php';
    }
</script>
<style>
header{
  position:sticky;
  top:0;
  z-index:1;
}
.nav-item:hover{
  background-color:#ffee01;
}
.nav-item a:hover{
  color: black !important;
}
</style>
<?php include("sqlconn.php") ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CRS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
        <?php
        session_start();
        if(isset($_SESSION['user'])){
            echo '<a class="nav-link active" href="new_booking.php" id="newBooking-btn">New Booking</a>';
        }
        else{
          echo '<a class="nav-link active" href="login.php" id="newBooking-btn">New Booking</a>';
        }
              ?>
         </li>
         <li class="nav-item">
              <a class="nav-link active" href="view_car.php" id="newBooking-btn">View car</a>
         </li>
        <?php
            if(isset($_SESSION['user'])){
              $user = $_SESSION['user'];
              $sql ="select is_admin from info where email='$user';";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              if($row['is_admin']){
                echo '<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="add_discount.php">Add discount coupon</a></li>
                <li><a class="dropdown-item" href="add_new_loc.php">Add new location</a></li>
                <li><a class="dropdown-item" href="add_car.php">Add new car</a></li>
                <li><a class="dropdown-item" href="add_car_category.php">Add new car category</a></li>
                <li><a class="dropdown-item" href="add_driver.php">Add new driver</a></li>
              </ul>
            </li>';
              }
              
       }
       
       ?>
       </ul>
       
       
       <ul class="navbar-nav ml-auto">

        <?php
        session_start();
        if(isset($_SESSION['user'])){
          $user =$_SESSION['user'];
          $sql = "select fname,lname from info where email='$user';";
          $result = mysqli_query($conn, $sql);
          $name = mysqli_fetch_assoc($result);
          echo '<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hello&nbsp; '.$name['fname'].'&nbsp;'.$name['lname'].'
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="my_bookings.php">My bookings</a></li>
            <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onClick="logout()">Logout</a></li>
          </ul>
        </li>';
        }
        else{
          echo '<li class="nav-item">
          <a class="nav-link active" aria-current="page" id="login-btn" href="./login.php">Login</a>
        </li><li class="nav-item">
        <a class="nav-link active" aria-current="page" id="SignUp-btn" href="signup.php">Signup</a>
        </li>';
        }
        ?>
         
      </ul>
    </div>
  </div>
</nav>
</header>