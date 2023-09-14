<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    

    //import database
    include("../connection.php");

    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];

        $sqlmain = "select * from `doctor` where docid=$id";
        $result = mysqli_query($database,$sqlmain);
        $row = $result->fetch_assoc();
        $email = $row["docemail"];


         //delete from the apointment list 
         $sqlmain= "select schedule.scheduleid from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid where schedule.docid=$id ";
         $result1 = mysqli_query($database,$sqlmain);
         for ( $x=0; $x<$result1->num_rows;$x++){
             $row=$result1->fetch_assoc();
             $sid=$row["scheduleid"];
             $sqlmain1 = " DELETE FROM `appointment` WHERE `appointment`.`scheduleid` = $sid ";
             $result = mysqli_query($database,$sqlmain1);
         }

         //delete from the schedule list 
         $sqlmain = "delete from `schedule` where docid=$id";
         $result = mysqli_query($database,$sqlmain);

        // delete form the webuser list
        $sqlmain = "delete from `webuser` where email='$email'";
        $result = mysqli_query($database,$sqlmain);


        // delete form the doctor list
        $sqlmain = "delete from `doctor` where docid=$id";
        $result = mysqli_query($database,$sqlmain);
        // echo $id;
        //print_r($email);
        header("location: ../logout.php");
    }


?>