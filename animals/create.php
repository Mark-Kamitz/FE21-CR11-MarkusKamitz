<?php
    function checkSession($level){
        session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: $levelindex.php");
        exit;
    }
    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
        exit;
    }
    }
    session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../index.php");
        exit;
    }
    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
        exit;
    }

    // require_once "../components/db_connect.php";

    // $sql = "SELECT * from animals";
    // $result = mysqli_query($connect, $sql);
    // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // $animals = "";
    // foreach($rows as $row){
    //     $animals .= "<option value='".$row["animal_id"]."'>".$row["name"]."</option>";
    // }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../components/boot.php'?>
        <title>Adoption  |  Add Animal</title>
        <style>
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }       
        </style>
    </head>
    <body>
    <?php require_once '../components/animal_nav.php'?>
        <fieldset>
            <legend class='h2'>Add Animal</legend>
            <form action="actions/a_create.php" method= "POST" enctype="multipart/form-data">
                <table class='table'>
                <tr>
                        <th>Picture</th>
                        <td><input class='form-control' type="file" name="picture"  placeholder="Picture" ></td>
                    </tr> 
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name"  placeholder="Name" ></td>
                    </tr>    
                    <tr>
                        <th>Location</th>
                        <td><input class='form-control' type="text" name= "location" placeholder="Location"  ></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name="description" placeholder="Description" ></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td><input class='form-control' type="text" name= "size" placeholder="Size" /></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="text" name="age" placeholder="Age" ></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class='form-control' type="text" name="hobbies" placeholder="Hobbies" ></td>
                    </tr>
                    <tr>
                        <th>Breed</th>
                        <td><input class='form-control' type="text" name="breed" placeholder="Breed" ></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><input class='form-control' type="text" name= "status" placeholder="Status" /></td>  
                    </tr>
                    <tr>
                        <td><button class='btn btn-outline-success btn-sm' type="submit">Add Animal</button></td>
                        <td><a href="index.php"><button class='btn btn-outline-warning btn-sm' type="button">Home</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>