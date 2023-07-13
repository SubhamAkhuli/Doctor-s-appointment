
    <?php
    
    session_start();

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $spec=$_POST['spec'];
        $newemail=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $id=$_POST['id00'];


         // TO Check The Password
         $checker  = "SELECT * FROM `doctor` WHERE docemail = '$oldemail'";
         $checkresult = mysqli_query($database, $checker);
         $checkpassword=$checkresult->fetch_assoc()['docpassword'];
         if (password_verify($password, $checkpassword))
         {
            $error='3';
            // $result= $database->query("select doctor.docid from doctor inner join webuser on doctor.docemail=webuser.email where webuser.email='$oldemail';");
            if ($newemail!=$oldemail){
                $result= $database->query("select * from doctor where docemail='$newemail';");
                if($result->num_rows==0){ 
                        $sql1="update doctor set docemail='$newemail',docname='$name',doctel='$tele',specialties=$spec where docid='$id' ;";
                        $database->query($sql1);
                        $sql1="update webuser set email='$newemail' where email='$oldemail' ;";
                        $database->query($sql1);
                        $error= '4';
                        session_destroy();
                            
                        // redirecting the user to the login page
                        header("location: ../login.php");
                     }
                else{
                        $error= '1';
                    }
                }
            else{
                $sql1="update doctor set docemail='$newemail',docname='$name',doctel='$tele',specialties=$spec where docid='$id' ;";
                $database->query($sql1);
                $sql1="update webuser set email='$newemail' where email='$oldemail' ;";
                $database->query($sql1);
                $error= '4';
            } 
        }  
        else{
                $error='2';
            }
           
    }
    else{
            //header('location: signup.php');
            $error='3';
        }
        header("location: settings.php?action=edit&error=".$error."&id=".$id);
        ?>        









        <!-- //     // TO check the email is present or not
        //     $result= $database->query("select doctor.docid from doctor  where doctor.docemail='$email';");
        //     // $id2=$result->fetch_assoc()["docid"];
        //     if($emailresult->num_rows==1){
        //         $id2=$result->fetch_assoc()["docid"];
        //     }else{
        //         $id2=$id;
        //     }
        //     if($id2!=$id){
        //         $error='1';
        //         // header("location: settings.php?action=edit&error=".$error."&id=".$id);
        //     }
        //     else{  
        //         $sql1="update webuser set email='$email' where email='$oldemail' ;";
        //         $database->query($sql1);

        //         $sql1="update doctor set docemail='$email',docname='$name',doctel='$tele',specialties=$spec where docid=$id ;";
        //         $database->query($sql1);

                
        //         $error= '4';
        //         if ($oldemail!=$email)
        //         {
        //             session_destroy();
            
        //             // redirecting the user to the login page
        //             header("location: ../login.php");
        //         }
                
        //     }
        // }   
        else{
            $error='2';
        }
    
    }else{
        //header('location: signup.php');
        $error='3';
    }
    // if ($oldemail!=$email)
    // {
    //     session_destroy();

	//     // redirecting the user to the login page
	//     header("location: ../login.php");
    // }
    // else
    // {
    //     header("location: settings.php?action=edit&error=".$error."&id=".$id);
    // }
    header("location: settings.php?action=edit&error=".$error."&id=".$id);
    ?> -->
