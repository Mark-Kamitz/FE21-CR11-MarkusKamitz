<?php
session_start(); // start a new session or continues the previous
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
$error = false;
$fname = $lname = $email = $phone = $address = $picture = $pass = '';


if (isset($_POST['btn-signup'])) {

    // sanitize user input to prevent sql injection
    $fname = trim($_POST['fname']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $fname = strip_tags($fname);

    // strip_tags -- strips HTML and PHP tags from a string

    $fname = htmlspecialchars($fname);
    // htmlspecialchars converts special characters to HTML entities
    
    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);    

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $phone = trim($_POST['phone']);
    $phone = strip_tags($phone);
    $phone = htmlspecialchars($phone);

    $address = trim($_POST['address']);
    $address = strip_tags( $address);
    $address = htmlspecialchars( $address);

    $uploadError = '';
    $picture = file_upload($_FILES['picture']);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

   




    // basic name validation
    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }
   
    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
    // checks whether the email exists or not
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    //checks if the phone input was left empty
    if (empty($phone)) {
        $error = true;
        $phoneError = "Please enter your phone number.";
    }
    //checks if the address input was left empty
    if (empty($address)) {
        $error = true;
        $addressError = "Please enter your address.";
    }
    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);
    // if there's no error, continue to signup
    if (!$error) {

        $query = "INSERT INTO users(first_name, last_name, email, phone, address, picture, password)
                  VALUES('$fname', '$lname', '$email' , '$phone' , '$address', '$picture->fileName' , '$password')";
        
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <?php require_once 'components/boot.php'?>
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
    <div class="oida mb-5">
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
                    <h2>Sign Up.</h2>
                    <hr/>
                    <?php
                    if (isset($errMSG)) {
                    ?>
                    <div class="alert alert-<?php echo $errTyp ?>" >
                                <p><?php echo $errMSG; ?></p>
                                <p><?php echo $uploadError; ?></p>
                    </div>

                    <?php
                    }
                    ?>

                    <input type ="text"  name="fname"  class="form-control"  placeholder="First name" maxlength="50" value="<?php echo $fname ?>"  />           
                    <span class="text-danger"> <?php echo $fnameError; ?> </span>

                    <input type ="text"  name="lname"  class="form-control"  placeholder="Surname" maxlength="50" value="<?php echo $lname ?>"  />
                    <span class="text-danger"> <?php echo $fnameError; ?> </span>

                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value ="<?php echo $email ?>"  />
                    <span  class="text-danger"> <?php echo $emailError; ?> </span>

                    <input type="text"  name="phone" class="form-control" placeholder="Enter Your Phone Number" maxlength="50" value ="<?php echo $phone ?>"/>
                        <span class="text-danger"> <?php echo $phoneError; ?> </span>
                    
                    <input type="text"  name="address" class="form-control" placeholder="Enter Your Address" maxlength="50" value ="<?php echo $address ?>"/>
                        <span class="text-danger"> <?php echo $addressError; ?> </span>

                    <input  type="file" name="picture" >
                        <span class="text-danger"> <?php echo $picError; ?> </span>
                
                    <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15"  />
                    <span class="text-danger"> <?php echo $passError; ?> </span>

                    <hr/>
                    <button type="submit" class="btn btn-outline-warning btn-sm" name="btn-signup">Sign Up</button>
                    <hr/>
                    <a href="index.php">Sign in Here...</a>
        </form>
   </div>
</div>
</body>
</html>