
    <?php
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        // $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $spec=$_POST['spec'];
        $newemail=$_POST['newemail'];
        $tele=$_POST['Tele'];
        $id=$_POST['docid'];
        if ($newemail!=$oldemail){
            $result= $database->query("select * from doctor where docemail='$newemail';");
            // $row=$result->num_rows;
            if($result->num_rows==0){ 
                    $sql1="update doctor set docemail='$newemail',docname='$name',doctel='$tele',specialties=$spec where docid='$id' ;";
                    $database->query($sql1);
                    $sql12="update webuser set email='$newemail' where email='$oldemail' ;";
                    $database->query($sql12);
                    $error= '4';
                 }
            else{
                    $error= '1';
                }
                }
        else{
            $sql1="update doctor set docemail='$newemail',docname='$name',doctel='$tele',specialties=$spec where docid='$id' ;";
            $database->query($sql1);
            // $sql1="update webuser set email='$newemail' where email='$oldemail' ;";
            // $database->query($sql1);
            $error= '4';
        }                  
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: doctors.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>