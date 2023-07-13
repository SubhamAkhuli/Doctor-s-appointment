<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        
        $sql = "DELETE FROM `appointment` WHERE `appointment`.`appoid` = $id";
        $result = mysqli_query($database,$sql);
        header("location: appointment.php");
    }


?>