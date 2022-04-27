<?php


   include('sqlconn.php');


   $sql = "SELECT distinct(city) from location where street='".$_GET['id']."';";


   $result = mysqli_query($conn, $sql);


   $json = array();
   while($row = mysqli_fetch_assoc($result)){
       $city= $row['city'];
        $json[] = array("city"=> $city );
   }


   echo json_encode($json);
?>