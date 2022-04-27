<?php


   include('sqlconn.php');


   $sql = "SELECT c.regno,c.model,c.make,c.model_year,c.mileage FROM car c
         WHERE c.category='".$_GET['id']."' 
         and not exists(select * from car_booking cb,booking b where cb.regno=c.regno and b.bid=cb.bid 
         and b.end_date>='".$_GET['pickup']."' and b.start_date<='".$_GET['dropdt']."');"; 


   $result = mysqli_query($conn, $sql);
    if($result){
        $json = array();
   while($row = mysqli_fetch_assoc($result)){
       $regno= $row['regno'];
       $model = $row['model'];
       $make = $row['make'];
       $model_year = $row['model_year'];
       $mileage = $row['mileage'];
        $json[] = 
            array(
                "regno"=> $regno,
                "model"=>$model,
                "make"=>$make,
                "model_year"=>$model_year,
                "mileage"=>$mileage
            );
   }


   echo json_encode($json);
    }

   
?>