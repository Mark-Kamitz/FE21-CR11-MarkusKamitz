<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}


// $user = $_SESSION['user'];
// $loggeduserid = $user['id'];


// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

if($_GET['Senior']){
    $sql = "SELECT * FROM animals where age > 8 ";
}
else{
    $sql = "SELECT * FROM animals";
}

$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){        
        $tbody .= "
            <div class='col'>
            <div class='card h-100 border-0 bg-light shadow rounded-3'>
                <img src='animals/pictures/".$row['picture']."' class='card-img-top' alt='...'>
                <div class='card-body'>
                    <table class='table '>
                        <tr>
                            <th>Name</th>
                            <td>" .$row['name']."</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>" .$row['location']."</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>" .$row['description']."</td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>" .$row['age']."</td>
                        </tr>
                        <tr>
                            <th>Breed</th>
                            <td>" .$row['breed']."</td>
                        </tr>
                        
                        <tr>
                            <th>Status</th>
                            <td>" .$row['status']."</td>
                        </tr>
                    </table>
                </div>
                <div class='card-footer d-flex  justify-content-center'>
                <a href='adopt.php?animal_id=".$row['animal_id']."'><button class='btn btn-outline-success btn-sm me-2' type='button'>Adopt a Pet</button></a>
                <a href='info.php?animal_id=".$row['animal_id']."'><button class='btn btn-outline-warning btn-sm' type='button'><i class='fas fa-info-circle'></i></button></a>
            </div>
           
            
            </div>    
        </div> 
        
           
           ";
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome - <?php echo $row['first_name']; ?></title>
<?php require_once 'components/boot.php'?>
<style>
.userImage{
width: 200px;
height: 200px;
}
.hero {
    background: rgb(2,0,36);
    background: linear-gradient(24deg, rgba(2,0,36,1) 0%, rgba(0,212,255,1) 100%);   
}
</style>
</head>
<body>
<?php require_once 'components/user_nav.php'?>
<div>
    <img src="pictures/header.jpeg" class="img-fluid shadow" >
</div>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 my-3">
         <?= $tbody;?>
    </div>
</div>
</body>
</html>