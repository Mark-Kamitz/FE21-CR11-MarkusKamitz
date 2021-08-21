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

if ($_GET['animal_id']) {
    $animal_id = $_GET['animal_id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$animal_id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $animal_id = $data['animal_id'];
        $name = $data['name'];
        $picture = $data['picture'];
        $location = $data['location'];
        $description = $data['description'];
        $size = $data['size'];
        $age = $data['age'];
        $hobbies = $data['hobbies'];
        $breed = $data['breed'];
        $status = $data['status'];
        
    } else {
        header("location: animals/error.php");
    }
    mysqli_close($connect);
} else {
    header("location: animals/error.php");
}
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
        }
   </style>
<title>Welcome - To Animal Adoption?></title>
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
    <div class="row my-3">
         
        <div class='col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 my-2' >
            <div class='card h-100 border-0 bg-light shadow rounded-3'>
                <img src='animals/pictures/<?= $picture;?>' class='card-img-top' alt='...'>
                <div class='card-body'>
                    <table class='table '>
                        <tr>
                            <th>Name</th>
                            <td><?= $name;?></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><?= $location;?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?= $description;?></td>
                        </tr>
                        <tr>
                            <th>Size</th>
                            <td><?= $size ;?></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td><?= $age;?></td>
                        </tr>
                        <tr>
                            <th>Hobbies</th>
                            <td><?= $hobbies;?></td>
                        </tr>
                        <tr>
                            <th>Breed</th>
                            <td><?= $breed;?></td>
                        </tr>
                        
                        <tr>
                            <th>Status</th>
                            <td><?= $status;?></td>
                        </tr>
                    </table>
                </div>
                <div class='card-footer d-flex  justify-content-center'>
                <a href='home.php'><button class='btn btn-outline-success btn-sm me-2' type='button'>Back</button></a>
               
            </div>
           
            
            </div>    
        </div> 

    </div>
</div>
</body>
</html>