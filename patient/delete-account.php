<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
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

        $sqlmain = "select * from `patient` where pid=$id";
        $result = mysqli_query($database,$sqlmain);
        $row = $result->fetch_assoc();
        $email = $row["pemail"];


        //delete from the apointment list 
        $sqlmain = " DELETE FROM `appointment` WHERE `appointment`.`pid` = $id ";
        $result = mysqli_query($database,$sqlmain);

        // delete form the webuser list
        $sqlmain = "delete from `webuser` where email='$email'";
        $result = mysqli_query($database,$sqlmain);


        // delete form the user list
        $sqlmain = "delete from `patient` where pid=$id";
        $result = mysqli_query($database,$sqlmain);

        //print_r($email);
        header("location: ../logout.php");
    }


?>