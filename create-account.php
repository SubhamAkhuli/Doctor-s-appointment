<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">

    <title>Create Account</title>
    <style>
    .container {
        animation: transitionIn-X 0.5s;
    }
    </style>
</head>

<body>
    <?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
include("connection.php");





if($_POST){

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $address=$_SESSION['personal']['address'];
    $dob=$_SESSION['personal']['dob'];
    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    
    if ($newpassword==$cpassword){
        $existSql = "SELECT * FROM `webuser` WHERE email = '$email'";
        $result = mysqli_query($database, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{
            //TODO
            $hash = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `patient` (`pemail`, `pname`, `ppassword`, `paddress`, `pdob`, `ptel`) VALUES ('$email','$name','$hash','$address','$dob','$tele');";
             $result = mysqli_query($database, $sql);
             $usersql = "INSERT INTO `webuser` (`email`, `usertype`) VALUES ('$email', 'p')";
             $userresult = mysqli_query($database, $usersql);
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: login.php');
        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }



    
}else{
    //header('location: signup.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>


    <center>
        <div class="container">
            <table border="0" style="width: 69%;">
                <tr>
                    <td colspan="2">
                        <p class="header-text">Let's Get Started</p>
                        <p class="sub-text">It's Okey, Now Create User Account.</p>
                    </td>
                </tr>
                <tr>
                    <form action="" method="POST">
                        <td class="label-td" colspan="2">
                            <label for="newemail" class="form-label">Email: </label>
                        </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                    </td>

                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="tele" class="form-label">Mobile Number: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="tel" name="tele" class="input-text" placeholder="ex: 0712345678">
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="newpassword" class="form-label">Create New Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="newpassword" class="input-text" placeholder="New Password"
                            required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="cpassword" class="form-label">Conform Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="cpassword" class="input-text" placeholder="Conform Password"
                            required>
                    </td>
                </tr>

                <tr>

                    <td colspan="2">
                        <?php echo $error ?>

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                    </td>
                    <td>
                        <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>

                </form>
                </tr>
            </table>

        </div>
    </center>
</body>

</html>