<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Appointments</title>
    <style>
    .popup {
        animation: transitionIn-Y-bottom 0.5s;
    }

    .sub-table {
        animation: transitionIn-Y-bottom 0.5s;
    }
    </style>
</head>

<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    
    

    //import database
    include("../connection.php");
    $userrow = "select * from `admin` where aemail='$useremail'";
    $result = mysqli_query($database,$userrow);
    $userfetch=$result->fetch_assoc();
    $username=$userfetch["aname"];

    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo $username ?></p>
                                    <p class="profile-subtitle"><?php echo $useremail ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out"
                                            class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord">
                        <a href="index.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Dashboard</p>
                        </a>
        </div></a>
        </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor ">
                <a href="doctors.php" class="non-style-link-menu ">
                    <div>
                        <p class="menu-text">Doctors</p>
                </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-schedule ">
            <a href="schedule.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Schedule</p>
                </div>
            </a>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment menu-active menu-icon-appoinment-active">
            <a href="appointment.php" class="non-style-link-menu non-style-link-menu-active">
                <div>
                    <p class="menu-text">Appointment</p>
            </a></div>
        </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-patient">
            <a href="patient.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Patients</p>
            </a></div>
        </td>
    </tr>

    </table>
    </div>
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr>
                <td width="13%">
                    <a href="appointment.php"><button class="login-btn btn-primary-soft btn btn-icon-back"
                            style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                            <font class="tn-in-text">Back</font>
                        </button></a>
                </td>
                <td>
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Appointment Manager</p>

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php 

                        date_default_timezone_set('Asia/Kolkata');

                        echo date('d-m-Y');
                       

                        $list110 = $database->query("select  * from  appointment;");

                        ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>       
            <tr>
                <td colspan="4" style="padding-top:0px;width: 100%;">
                    <center>
                        <table class="filter-container" border="0">
                            <tr>
                                <td width="10%">

                                </td>
                                <td width="5%" style="text-align: center;">
                                    Date:
                                </td>
                                <td width="30%">
                                    <form action="" method="post">

                                        <input type="date" name="sheduledate" id="date"
                                           <?php 
                                            echo 'class="input-text filter-container-items" min="'.date('Y-m-d').'"style="margin: 0;width: 95%";>';
                                           ?>

                                </td>
                                <td width="5%" style="text-align: center;">
                                    Doctor:
                                </td>
                                <td width="30%">
                                    <select name="docid" id="" class="box filter-container-items"
                                        style="width:90% ;height: 37px;margin: 0;">
                                        <option value="" disabled selected hidden>Choose Doctor Name from the list
                                        </option><br />

                                        <?php 
                             
                                $list11 = $database->query("select  * from  doctor order by docname asc;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $sn=$row00["docname"];
                                    $pid=$row00["docid"];
                                    echo "<option value=".$pid.">$sn</option><br/>";
                                };


                                ?>

                                    </select>
                                </td>
                                <td width="12%">
                                    <input type="submit" name="filter" value=" Filter"
                                        class=" btn-primary-soft btn button-icon btn-filter"
                                        style="padding: 15px; margin :0;width:100%">
                                        </form>
                                </td>

                            </tr>
                        </table>

                    </center>
                </td>

            </tr>                
            <?php
                    $today= date('Y-m-d');
                    if($_POST){
                        if(!empty($_POST["sheduledate"]) && !empty($_POST["docid"]) ){
                            $sheduledate=$_POST["sheduledate"];
                            $docid=$_POST["docid"];
                            $sqlmain= "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate='$sheduledate' and doctor.docid=$docid ";
                        }
                        else{
                            if(!empty($_POST["docid"])){
                                $docid=$_POST["docid"];
                                $sqlmain= "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid where doctor.docid=$docid and schedule.scheduledate>='$today' ";
                            }
                            elseif (!empty($_POST["sheduledate"])){
                            $sheduledate=$_POST["sheduledate"];
                            $sqlmain= "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate='$sheduledate'and schedule.scheduledate>='$today' ";
                            }
                            else{
                                $sqlmain= "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today'  order by schedule.scheduledate asc";
                           
                        }      
                    }                 
                    }else{
                        $sqlmain= "select * from schedule inner join doctor on schedule.docid=doctor.docid where schedule.scheduledate>='$today'  order by schedule.scheduledate asc";

                    }

                    $result= $database->query($sqlmain);

                ?>
                <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;">

                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All
                        Appointments (<?php echo $result->num_rows; ?>)</p>
                </td>

            </tr>
           
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">
                                    
                                
                                Session Title
                                
                                </th>
                                
                                <th class="table-headin">
                                    Doctor
                                </th>
                                <th class="table-headin">
                                    
                                    Sheduled Date & Time
                                    
                                </th>
                                <th class="table-headin">
                                    
                               Total Slots
                                    
                                </th>

                                <th class="table-headin">
                                    
                                    Patient Booked
                                        
                                    </th>
                                
                                <th class="table-headin">
                                    
                                    Events
                                    
                                </tr>
                        </thead>
                        <tbody>
                        
                            <?php

                                
                                $result= $database->query($sqlmain);

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $scheduleid=$row["scheduleid"];
                                    $title=$row["title"];
                                    $docname=$row["docname"];
                                    $scheduledate=date("d-m-Y",strtotime($row["scheduledate"]));
                                    $scheduletime=date('h:i a ', strtotime($row["scheduletime"]));
                                    $nop=$row["nop"];
                                    $sqlmain12= "select * from appointment inner join patient on patient.pid=appointment.pid inner join schedule on schedule.scheduleid=appointment.scheduleid where schedule.scheduleid=$scheduleid;";
                                    $result1= $database->query($sqlmain12);
                                    $sql2="select * from appointment where scheduleid=$scheduleid";
                                     $result2= $database->query($sql2);
                                     $apponum=($result2->num_rows)+1;
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($title,0,30)
                                        .'</td>
                                        <td>
                                        '.substr($docname,0,20).'
                                        </td>
                                        <td style="text-align:center;">
                                            '.$scheduledate.'  <br> '.$scheduletime.'
                                        </td>
                                        <td style="text-align:center;">
                                            '.$nop.'
                                        </td>
                                        <td style="text-align:center;">
                                        '.$result1->num_rows.'
                                    </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">                                        
                                        <a href="?action=book&id='.$scheduleid.'&date='.$today.'&apponum='.$apponum.'"class="non-style-link"><button  class="btn-primary-soft btn button-icon "  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Book</font></button></a>
                                        </div>
                                        
                                        </td>
                                    </tr>';
                                    
                                }
                            }
                                 
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                <?php
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='book'){
            $scheduleid=$_GET["id"];
            $date=$_GET["date"];
            $apponum=$_GET["apponum"];
            // $list11 = $database->query("select  * from  patient;");
            // $row00=$list11->fetch_assoc();
            // $pid=$row00["pid"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Choose the Patient name</h2>
                        <a class="close" href="booking.php">&times;</a>
                        <div class="content">
                        <select name="docid" id="" class="box" >
                        <option value="" disabled selected hidden>Choose Patient name from the list</option><br/>';
                            

                            $list11 = $database->query("select  * from  patient;");

                            for ($y=0;$y<$list11->num_rows;$y++){
                                $row00=$list11->fetch_assoc();
                                $sn=$row00["pname"];
                                $pid=$row00["pid"];
                                echo "<option value=".$pid.">$sn</option><br/>";
                            };
                            
            echo     '       </select><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="booking-complete.php?id='.$scheduleid.'date='.$today.'apponum='.$apponum.'pid='.$pid.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"name="booknow"><font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="booking.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }
}

    ?>    
                        
                        
            </table>
        </div>
    </div>
                                        
            </table>

    </div>
    
    
   
</div>

</body>
</html>