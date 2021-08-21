<?php
session_start();
require_once 'components/db_connect.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

    $password = hash('sha256', $pass);  //password hashing

        $sql = "SELECT id, first_name, password, status FROM users WHERE email = '$email'";
        var_dump($email);
        var_dump($pass);
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1 && $row['password'] == $password) {
            if($row['status'] == 'adm'){
            $_SESSION['adm'] = $row['id'];           
            header( "Location: dashboard.php");}
            else{
                $_SESSION['user'] = $row['id']; 
               header( "Location: home.php");
            }          
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type= "text/css">
       .oida {
            margin: 0 auto;
            margin-top: 100px;
            width: 70% ;
        }
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }
   </style>
<title>Login & Registration System</title>
<?php require_once 'components/boot.php'?>
</head>
<body>
<nav class=" navbar  sticky-top shadow navbar-expand-lg navbar-light bg-light ">
        <div class=" container d-flex flex-row justify-content-between ">
            <div >
            </div>
            <div class="h2 text-dark">Pet Adoption</div>
            <div>
            </div>
        </div>
</nav>
<div>
    <img src="pictures/header.jpeg" class="img-fluid shadow" >
</div>
    <div class="container">  
        <div class="oida">
            <form class="w-75 mb-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <h2>LogIn to adopt a Pet</h2>
                <hr/>
                <?php
                if (isset($errMSG)) {
                    echo $errMSG;
                }
                ?>
            
                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>"  maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>

                <input type="password" name="pass"  class="form-control" placeholder="Your Password" maxlength="15"  />
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr/>
                <button class="btn btn-block btn-outline-warning btn-sm" type="submit" name="btn-login">Sign In</button>
                <hr/>
                <a href="register.php">Not registered yet? Click here</a>
            </form>
        </fieldset>
    </div>
</body>
</html>