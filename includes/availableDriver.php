<?php


   include('sqlconn.php');


   $sql = "SELECT d.dl_num,d.fname,d.lname,d.experience FROM driver d
         WHERE d.city='".$_GET['city']."' and not exists(select * from driver_booking db,booking b where db.dl_num=d.dl_num and b.bid=db.bid 
         and b.end_date>='".$_GET['pickup']."' and b.start_date<='".$_GET['dropdt']."');"; 


   $result = mysqli_query($conn, $sql);


   $json = array();
   while($row = mysqli_fetch_assoc($result)){
       $dlno= $row['dl_num'];
       $fname = $row['fname'];
       $lname = $row['lname'];
       $experience = $row['experience'];
        $json[] = 
            array(
                "dl_num"=> $dlno,
                "fname"=>$fname,
                "lname"=>$lname,
                "experience"=>$experience
            );
   }


   echo json_encode($json);
?>