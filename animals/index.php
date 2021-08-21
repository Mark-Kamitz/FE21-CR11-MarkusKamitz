<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../index.php");
    exit;
}
if(isset($_SESSION["user"])){
    header("Location: ../home.php");
    exit;
}
require_once '../components/db_connect.php';
$sql = "SELECT * FROM animals";
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){       
        $tbody .= "<tr>
            <td><img class='img-thumbnail' src='pictures/" .$row['picture']."'</td>
            
            <td>" .$row['name']."</td>
            <td>" .$row['location']."</td>
            <td>" .$row['description']."</td>
            <td>" .$row['size']."</td>
            <td>" .$row['age']."</td>
            <td>" .$row['hobbies']."</td>
            <td>" .$row['breed']."</td>
            <td>" .$row['status']."</td>
            <td>
                <a href='update.php?animal_id=" .$row['animal_id']."'><button class='btn btn-outline-warning btn-sm' type='button'><i class='far fa-edit'></i></button></a>
                <a href='delete.php?animal_id=" .$row['animal_id']."'><button class='btn btn-outline-danger btn-sm' type='button'><i class='far fa-trash-alt'></i></button></a>
            </td>


            </tr>";
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
        <title>PHP CRUD</title>
        <?php require_once '../components/boot.php'?>
        <style type="text/css">
            .manageProduct {           
                margin: auto;
            }
            .img-thumbnail {
                width: 70px !important;
                height: 70px !important;
            }
            td {          
                text-align: left;
                vertical-align: middle;
            }
            tr {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <?php require_once '../components/animal_nav.php'?>
        <div class="manageProduct w-75 my-5">    
            
            <p class='h2'>Animals</p>
            <table class='table table-striped'>
            <thead class='table-light'>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Age</th>
                    <th>Hobbies</th>
                    <th>Breed</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?=$tbody?>
            </tbody>
        </table>
        </div>
    </body>
</html>