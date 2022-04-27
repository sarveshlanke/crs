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
    <title>My Bookings</title>
    <?php include('includes/header.php');?>

  </head>
  
  
  <body>
  <style>
  body{
    margin:0px;
    padding:0px;
  }
  body:before{
    content:"";
    width:100%;
    height:100%;
    display:block;
    position:absolute;
    top:0;
    left:0;
    background:url('static/img/my_bookings_bg.png') repeat center center;
    background-size:contain;
    z-index:-1;
    opacity:0.5;
  }
  table{
    background:#212529;
    color:white;
  }
  th{
    color:#ffee01;
  }
  tr{
    color:white;
  }
  td{
    color:white;
  }
  h1{
    background-color:rgb(0,0,0);
    color:#ffee01;
    margin-bottom:0px;
  }
  .retCar{
    background-color:#ffee01;
    color:black;
    border:black;
  }
  .retCar:hover{
    background-color:#504d1c;
    color:white;
  }
  .cancel{
    background-color:red;
    color:black;
    border:black;
  }
  .cancel:hover{
    background-color:#5d1818;
    color:white;
  }
  .pay{
    background:#22dc22;
    border:black;
    color:black;
  }
  .pay:hover{
    background:#136513;
    color:white;
  }
  </style>
  <?php include('includes/sqlconn.php');?>
<!-- Button trigger modal -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if(isset($_POST['bookCancel'])){
        $bid = $_POST['bookCancel'];
        $sql = "select start_date from booking where bid='$bid';";
        $result = mysqli_query($conn, $sql);
        $pdt="";
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $pdt=$row['start_date'];
        }
        $datetime1 = strtotime($pdt);
        $datetime2 = strtotime(date("Y-m-d H:i:s"));
        $secs = $datetime1-$datetime2 ;// == <seconds between the two times>
        $days = $secs / 86400;
        if($days >= 5){
            $sql = "update booking set status='cancelled' where bid='$bid';";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Sucessfully Cancelled</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Booking cannot be cancelled within 5 days of Pickup date</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    if(isset($_POST['paybid'])){
        $bid = $_POST['paybid'];
        $sql = "update booking set status='paid' where bid='$bid';";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucessfully Paid</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    
        else{
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Payment unsuccessful</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    if(isset($_POST['bookret'])){
        $bid = $_POST['bookret'];
        $act = $_POST['retdt'];
        $sql = "update booking set act_ret_time='$act' where bid='$bid';";
        $result2 = mysqli_query($conn, $sql);
        if($result2){
            $sql = "select b.bid,b.start_date,b.end_date,cc.cost_pd,cc.late_fees_ph,d.Dpercent from booking b inner join car_booking cb on b.bid=cb.bid inner join car c on cb.regno=c.regno inner join car_cat cc on c.category=cc.cat_name left outer join discount d on d.Dcode=b.dcode where b.bid='$bid';";
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result)){
                $pdt = $row['start_date'];
                $odt= $row['end_date'];
                $cpd = $row['cost_pd'];
                $datetime1 = strtotime($act);
                $datetime2 = strtotime($odt);
                $datetime3 = strtotime($pdt);
                $secs = $datetime1-$datetime2 ;
                $secbase= $datetime2 - $datetime3 ;
                $hours = $secs / 3600;
                $ltfees = $hours*$row['late_fees_ph'];
                $dayBase = $secbase /86400;
                $base = floor($dayBase) * $cpd ;
                $discount = 0;
                if(!is_null($row['Dpercent'])){
                    $dper = $row['Dpercent'];
                    $dper100 = $dper*$base;
                    $discount = ($dper100)/100;
                }
                $total = $base + $ltfees - $discount ;
                $sql = "insert into bill (bill_dt,bid,base_pay,late_fees,discount,total) values ('$act',$bid,$base,$ltfees,$discount,$total);";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Bill Generated</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
                }

            }
            
        }
        
    }
}

?>

<!--Return Car Modal -->
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="returnModalLabel">Return Car</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Return Car?
        <form action="my_bookings.php" method="POST">
            <div class="mb-4">
            <label for="bookret" class="form-label" ><strong>Booking Id</strong></label>
            <input type="text" class="form-control" name ='bookret' id="bookret"  maxlength="10" >
            </div>
            <div class="md-4">
            <label for="retdt" class="form-label"><strong>Return&nbsp;Date&nbsp;Time</strong></label>
            <input type="datetime-local" class="form-control" id="retdt" name="retdt">
            </div>
            </div>
            <div class="mb-4 text-center">
            <button type="submit" class="btn btn-primary">Return</button>
            </div>
        </form>
      </div>
  </div>
</div>

<!--Pay Modal -->
<div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="payModalLabel">Pay Now</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Pay Now?
        <form action="my_bookings.php" method="POST">
            <div class="mb-4">
            <label for="paybid" class="form-label" ><strong>Booking Id</strong></label>
            <input type="text" class="form-control" name ='paybid' id="paybid"  maxlength="10" >
            </div>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
            </div>
        </form>
      </div>
  </div>
</div>

<!-- Cancel Booking Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel?
        <form action="my_bookings.php" method="POST">
            <div class="mb-4">
            <label for="bookCancel" class="form-label" ><strong>Booking Id</strong></label>
            <input type="text" class="form-control" name ='bookCancel' id="bookCancel"  maxlength="10" >
            </div>
            </div>
            <div class="mb-4 text-center">
            <button type="submit" class="btn btn-primary">Cancel</button>
            </div>
        </form>
      </div>
  </div>
</div>

<div class="container mt-5">
  
<h1 style='text-align:center'> My bookings </h1>
<table class="table table-striped table-hover">
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Pickup</th>
      <th scope="col">Drop Off</th>
      <th scope="col">Car Reg No.</th>
      <th scope="col">status</th>
      <th scope="col">Payment</th>
      <th scope="col">Cancellation</th>
      <th scope="col">Return Car</th>
      
    </tr>
  </thead>
  <tbody>
<?php
$user = $_SESSION['user'];
$sql ="select b.bid,b.start_date,b.end_date,c.regno,b.status,b.act_ret_time from booking b, car c,car_booking cb where cb.bid=b.bid and c.regno=cb.regno and user_email='$user'; ";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
    <td>".$row['bid']."</td>
    <td>".$row['start_date']."</td>
    <td>".$row['end_date']."</td>
    <td>".$row['regno']."</td>
    <td>".$row['status']."</td>
    ";
    if($row['status']=="unpaid" && !is_null($row['act_ret_time'])){
        echo '<td><button type="button" class="pay btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paynowModal">
        Pay Now
      </button>
      </td>';
    }
    else{
        echo '<td> Payment Window unavailable</td>';
    }
    if($row['status']!=="cancelled" && $row['status']!="paid"){
        echo '<td><button class="cancel btn btn-sm btn-primary">Cancel NOW</button>
      </td>';
    }
    else{
        echo '<td> Cancellation Window unavailable</td>';
    }
    if(is_null($row['act_ret_time']) && $row['status']!=='cancelled'){
        echo '<td><button type="button" class="retCar btn btn-primary btn-sm">
        Return Car
      </button>
      </td>';
    }
    else{
        echo '<td> Car Returned</td>';
    }
    echo "</tr>";
}

?>
</tbody>
</table>
</div>
<div class="container mt-5">
  
<h1 style='text-align:center'> My Bills </h1>
<table class="table table-striped table-hover">
<thead>
    <tr>
      <th scope="col">Bill ID</th>
      <th scope="col">Bill Date Time</th>
      <th scope="col">Booking ID</th>
      <th scope="col">Base Charge</th>
      <th scope="col">Late Fees</th>
      <th scope="col">Discount</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Status</th>
      
    </tr>
  </thead>
  <tbody>
  <?php
$user = $_SESSION['user'];
$sql = "select bill.bill_id,bill.bill_dt,bill.bid,bill.base_pay,bill.late_fees,bill.discount,bill.total,b.status from booking b,bill where b.bid=bill.bid and user_email='$user'; ";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
    <td>".$row['bill_id']."</td>
    <td>".$row['bill_dt']."</td>
    <td>".$row['bid']."</td>
    <td>".$row['base_pay']."</td>
    <td>".$row['late_fees']."</td>
    <td>".$row['discount']."</td>
    <td>".$row['total']."</td>
    <td>".$row['status']."</td></tr>
    ";
}

?>
</tbody>
</table>
</div>
<script>
cancel = document.getElementsByClassName('cancel');
Array.from(cancel).forEach((element)=>{
    element.addEventListener("click",(e)=>{
        var myModal = new bootstrap.Modal(document.getElementById('cancelModal'), {
        keyboard: false
        })
        console.log("cancel",e.target.parentNode.parentNode);
        tr=e.target.parentNode.parentNode;
        bid=tr.getElementsByTagName("td")[0].innerText;
        pdt=tr.getElementsByTagName("td")[1].innerText;
        console.log("cancel",bid);
        console.log("cancel",pdt);
        var modalToggle = document.getElementById('cancelModal'); // relatedTarget
        myModal.show(modalToggle);
        bookCancel.value=bid;
    })
})
retCar = document.getElementsByClassName('retCar');
Array.from(retCar).forEach((element)=>{
    element.addEventListener("click",(e)=>{
        var myModal = new bootstrap.Modal(document.getElementById('returnModal'), {
        keyboard: false
        })
        console.log(e.target.parentNode.parentNode);
        tr=e.target.parentNode.parentNode;
        bid=tr.getElementsByTagName("td")[0].innerText;
        var modalToggle = document.getElementById('returnModal'); // relatedTarget
        myModal.show(modalToggle);
        bookret.value=bid;
    })
})
pay = document.getElementsByClassName('pay');
Array.from(pay).forEach((element)=>{
    element.addEventListener("click",(e)=>{
        var myModal = new bootstrap.Modal(document.getElementById('payModal'), {
        keyboard: false
        })
        console.log(e.target.parentNode.parentNode);
        tr=e.target.parentNode.parentNode;
        bid=tr.getElementsByTagName("td")[0].innerText;
        var modalToggle = document.getElementById('payModal'); // relatedTarget
        myModal.show(modalToggle);
        paybid.value=bid;
    })
})
</script>
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
