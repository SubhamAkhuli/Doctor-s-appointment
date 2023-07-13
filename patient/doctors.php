<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Doctors</title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
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

   $useremail=$_SESSION["user"];
   $patientdata  = "SELECT * FROM `patient` WHERE pemail = '$useremail'";
   $checkresult = mysqli_query($database, $patientdata);
   $data=$checkresult->fetch_assoc();
   $userid= $data["pid"];
   $username=$data["pname"];
   
   date_default_timezone_set('Asia/Kolkata');


//echo $userid;
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
                                   <p class="profile-title"><?php echo $username  ?></p>
                                   <p class="profile-subtitle"><?php echo substr($useremail,0,20)  ?>....</p>
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
                   <td class="menu-btn menu-icon-home ">
                       <a href="index.php" class="non-style-link-menu ">
                           <div>
                               <p class="menu-text">Home</p>
                       </a>
       </div></a>
       </td>
       </tr>
       <tr class="menu-row">
           <td class="menu-btn menu-icon-doctor">
               <a href="doctors.php" class="non-style-link-menu">
                   <div>
                       <p class="menu-text">All Doctors</p>
               </a>
   </div>
   </td>
   </tr>

   <tr class="menu-row">
       <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
           <a href="schedule.php" class="non-style-link-menu non-style-link-menu-active">
               <div>
                   <p class="menu-text">Scheduled Sessions</p>
               </div>
           </a>
       </td>
   </tr>
   <tr class="menu-row">
       <td class="menu-btn menu-icon-appoinment">
           <a href="appointment.php" class="non-style-link-menu">
               <div>
                   <p class="menu-text">My Bookings</p>
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
</head>
<body>
   
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">
                        <a href="doctors.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <?php
                 $insertkey="";
                 $searchtype="All Doctors";
                         if($_POST){
                             $keyword=$_POST["search"];
                             if ($keyword!="")
                             {
                             $sqlmain= "select * from doctor where docemail='$keyword' or docname='$keyword' or docname like '$keyword%' or docname like '%$keyword' or docname like '%$keyword%'";
                             $insertkey=$keyword;
                             $searchtype="Search Result : "; 
                             $result = mysqli_query($database, $sqlmain);

                             }else{
                             $sqlmain= "select * from doctor order by docid desc";
                             $insertkey=$keyword;
                             $result = mysqli_query($database, $sqlmain);
                         }
                         }
                         else{
                            $sqlmain= "select * from doctor order by docid desc";
                             $result = mysqli_query($database, $sqlmain);
                         }
                ?>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                        <input type="search" name="search" class="input-text header-searchbar"
                            placeholder="Search Doctor's name or Email id " list="doctors"
                            value="<?php  echo $insertkey ?>">&nbsp;&nbsp;
                            
                            <!-- to show suggestion -->

                            <!-- <?php
                                echo '<datalist id="doctors">';
                                $list11 = $database->query("select  docname,docemail from  doctor;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["docname"];
                                    $c=$row00["docemail"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
?> -->
                            
                       
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 
                        date_default_timezone_set('Asia/Kolkata');

                        echo date('d-m-Y');
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">
                        <?php echo $searchtype."(".$result->num_rows.")"; ?> </p>
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
                                    
                                
                                Doctor Name
                                
                                </th>
                                <th class="table-headin">
                                    Email
                                </th>
                                <th class="table-headin">
                                    
                                    Specialties
                                    
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
                                    <a class="non-style-link" href="doctors.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Doctors &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $docid=$row["docid"];
                                    $name=$row["docname"];
                                    $email=$row["docemail"];
                                    $spe=$row["specialties"];
                                    $spcil_res= $database->query("select sname from specialties where id='$spe'");
                                    $spcil_array= $spcil_res->fetch_assoc();
                                    $spcil_name=$spcil_array["sname"];
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($name,0,30)
                                        .'</td>
                                        <td>
                                        '.substr($email,0,20).'
                                        </td>
                                        <td>
                                            '.substr($spcil_name,0,20).'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$docid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=session&id='.$docid.'&name='.$name.'"  class="non-style-link"><button  class="btn-primary-soft btn button-icon menu-icon-session-active"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Sessions</font></button></a>
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
                       
                        
                        
            </table>
        </div>
    </div>
    <?php 
    if($_GET){
        
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='view'){

            $existSql = "SELECT * FROM doctor WHERE docid='$id'";
            $result = mysqli_query($database, $existSql);
            $row = $result->fetch_assoc();
            $name=$row["docname"];
            $email=$row["docemail"];
            // $nic=$row['docnic'];
            $tele=$row['doctel'];
            $spe=$row["specialties"];

            $spe_sql = "SELECT * FROM specialties WHERE id='$spe'";
            $result = mysqli_query($database, $spe_sql);
            $spcil_array = $result->fetch_assoc();
            $spcil_name=$spcil_array["sname"];
            
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            JustBook Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            '.$spcil_name.'<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='session'){
            $name=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Redirect to Doctors sessions?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            You want to view All sessions by <br>('.$name.').
                            
                        </div>
                        <form action="schedule.php" method="post" style="display: flex">

                                <input type="hidden" name="search" value="'.$name.'">

                                
                        <div style="display: flex;justify-content:center;margin-left:45%;margin-top:6%;;margin-bottom:6%;">
                        
                        <input type="submit"  value="Yes" class="btn-primary btn"   >
                        
                        
                        </div>
                    </center>
            </div>
            </div>
            ';
        }
      
    };

?>
</div>

</body>
</html>