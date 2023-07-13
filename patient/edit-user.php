
    <?php
    session_start();
    

    //import database
    include("../connection.php");



    if($_POST){
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $address=$_POST['address'];
        $newemail=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $id=$_POST['id00'];
        
        // TO Check The Password
        $checker  = "SELECT * FROM `patient` WHERE pemail = '$oldemail'";
        $checkresult = mysqli_query($database, $checker);
        $checkpassword=$checkresult->fetch_assoc()['ppassword'];
        if (password_verify($password, $checkpassword))
        {
           $error='3';
           if ($newemail!=$oldemail){
               $result= $database->query("select * from patient where pemail='$newemail';");
               if($result->num_rows==0){ 
                       $sql1="update patient set pemail='$newemail',pname='$name',ptel='$tele',paddress='$address' where pid=$id ;";
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
               $sql1="update patient set pemail='$newemail',pname='$name',ptel='$tele',paddress='$address' where pid=$id ;;";
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

</body>
</html>