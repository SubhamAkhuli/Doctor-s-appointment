<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Dashboard</title>
    <style>
    .dashbord-tables,
    .doctor-heade {
        animation: transitionIn-Y-over 0.5s;
    }

    .filter-container {
        animation: transitionIn-Y-bottom 0.5s;
    }

    .sub-table,
    #anim {
        animation: transitionIn-Y-bottom 0.5s;
    }

    .doctor-heade {
        animation: transitionIn-Y-over 0.5s;
    }
    </style>


</head>

<body>
<?php

//learn from w3schools.com

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
// $userrow = $database->query("select * from doctor where docemail='$useremail'");
// $userfetch=$userrow->fetch_assoc();

$userrow = "select * from `doctor` where docemail='$useremail'";
$result = mysqli_query($database,$userrow);
$userfetch=$result->fetch_assoc();
$userid= $userfetch["docid"];
$username=$userfetch["docname"];


//echo $userid;
//echo $username;

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
                                <p class="profile-subtitle"><?php echo substr($useremail,0,15)  ?>....</p>
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
                <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                    <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                        <div>
                            <p class="menu-text">Dashboard</p>
                    </a>
    </div></a>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-appoinment">
            <a href="appointment.php" class="non-style-link-menu">
                <div>
                    <p class="menu-text">My Appointments</p>
            </a>
</div>
</td>
</tr>

<tr class="menu-row">
    <td class="menu-btn menu-icon-session">
        <a href="schedule.php" class="non-style-link-menu">
            <div>
                <p class="menu-text">My Sessions</p>
            </div>
        </a>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-patient">
        <a href="patient.php" class="non-style-link-menu">
            <div>
                <p class="menu-text">My Patients</p>
        </a></div>
    </td>
</tr>
<tr class="menu-row">
    <td class="menu-btn menu-icon-settings">
        <a href="settings.php" class="non-style-link-menu">
            <div>
                <p class="menu-text">Settings</p>
        </a></div>
    </td>
</tr>

</table>
</div>
    <div class="dash-body" style="margin-top: 15px">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">

            <tr>

                <td colspan="1" class="nav-bar">
                    <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Dashboard</p>

                </td>
                <td width="25%">

                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Today's Date
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php 
                                date_default_timezone_set('Asia/Kolkata');
        
                                $today = date('d-m-Y');
                                // echo $today;
                                echo date('d-m-Y');


                                // $patientrow = $database->query("select  * from  patient;");
                                // $doctorrow = $database->query("select  * from  doctor;");
                                // $appointmentrow = $database->query("select  * from  appointment where appodate>='$today';");
                                // $schedulerow = $database->query("select  * from  schedule where scheduledate='$today';");


                                ?>
                    </p>
                </td>
                <td width="10%">
                    <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img
                            src="../img/calendar.svg" width="100%"></button>
                </td>


            </tr>
            <tr>
                <td colspan="4">

                    <center>
                        <table class="filter-container doctor-header" style="border: none;width:95%" border="0">
                            <tr>
                                <td>
                                    <h3>Welcome!</h3>
                                    <h1><?php echo $username  ?>.</h1>
                                    <p>Thanks for joinnig with us. We are always trying to get you a complete
                                        service<br>
                                        You can view your dailly schedule, Reach Patients Appointment at home!<br><br>
                                    </p>
                                    <a href="appointment.php" class="non-style-link"><button class="btn-primary btn"
                                            style="width:30%">View My Appointments</button></a>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </center>

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table border="0" width="100%"">
                            <tr>
                                <td>


                            
                                    <p id=" anim" style="font-size: 20px;font-weight:600;padding-left: 40px;">Your Up
                        Coming Sessions until Next <?php  
                                        echo date("l",strtotime("+1 week"));
                                        ?></p>
                        <center>
                            <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                <table width="85%" class="sub-table scrolldown" border="0">
                                    <thead>

                                        <tr>
                                            <th class="table-headin">


                                                Session Title

                                            </th>

                                            <th class="table-headin">
                                                Sheduled Date
                                            </th>
                                            <th class="table-headin">

                                                Time

                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $today = date('Y-m-d');
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate<= '$today' and schedule.scheduledate>='$nextweek' order by schedule.scheduledate desc"; 
                                                $result= $database->query($sqlmain);
                                                    if($result->num_rows==0){
                                                        echo '<tr>
                                                        <td colspan="4">
                                                        <br><br><br><br>
                                                        <center>
                                                        <img src="../img/notfound.svg" width="25%">
                                                        
                                                        <br>
                                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">You have no Sessions in this week!</p>
                                                        <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; See Your further Sessions &nbsp;</font></button>
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
                                                        // $nop=$row["nop"];
                                                        echo '<tr>
                                                            <td style="padding:20px;"> &nbsp;'.
                                                            $title
                                                            .'</td>
                                                            <td style="padding:20px;font-size:13px;">
                                                            '.$scheduledate.'
                                                            </td>
                                                            <td style="text-align:center;">
                                                                '.$scheduletime.'
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
        </table>
        </td>
        <tr>
            </table>
    </div>
    </div>


</body>

</html>