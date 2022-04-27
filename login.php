<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kreon:wght@700&display=swap" rel="stylesheet">
    
        <title>login</title>
        <link rel="stylesheet" href="main.css">
 </head>

<!-- php function -->
<?php include('includes/sqlconn.php');?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['user'])){
        $error='';
        $user = $_POST['user'];
        $passEntered = $_POST['pass'];
        $sql = "Select password from info where email='$user';";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
          $passActual = mysqli_fetch_assoc($result);
          if($passActual['password']==$passEntered){
            session_start();
            $_SESSION['user']=$user;
            header('Location: index.php');
          }
          else{
            $error = "Incorrect Password";
          }  
        }
        else{
          $error = "user not found";
        }
      }
      else{
        $error ="Enter registered Email";
      }
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>'. $error.' </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }

?>


<!-- Front end -->

 <body>
 <?php include('includes/header.php');?>
<script>
document.getElementById("login-btn").style.display="none";
document.getElementById("SignUp-btn").style.display="none";
</script>

   <form action="./login.php" method="POST">
      <h1>Login</h1>
      <div class="textbox">
         <input type="email" id="user" name="user" placeholder="Email">
      </div>
      <div class="textboxdiv">
         <input type="password" id="pass" name="pass" placeholder="Password">
      </div>
      <div>
        <button type="submit" class="btn" style="color: black">login</button>
      </div>
      <div class="signup"> 
          Don't have an account ?
          <br>
          <a href="/CRS/signup.php">Sign up</a>
      </div>
    </form> 
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
      <?php include('includes/footer.php');?>
  </body>
  </html>