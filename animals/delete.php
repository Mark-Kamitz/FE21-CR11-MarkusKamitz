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

if ($_GET['animal_id']) {
    $id = $_GET['animal_id'];
    $sql = "SELECT * FROM animals WHERE animal_id = {$id}" ;
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $name = $data['name'];
        $picture = $data['picture'];
        $location = $data['location'];
        $description = $data['description'];
        $breed = $data['breed'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
} 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Product</title>
        <?php require_once '../components/boot.php'?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 70% ;
            }     
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }    
        </style>
    </head>
    <body>
    <?php require_once '../components/animal_nav.php'?>
        <fieldset>
            <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
            <h5>You have selected the data below:</h5>
            <table class="table w-75 mt-3">
                <tr>
                    <th>Name</th>
                    <td><?php echo $name?></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><?php echo $breed?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $description?></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><?php echo $location?></td>
                </tr>
            </table>

            <h3 class="mb-4">Do you really want to delete this product?</h3>
            <form action ="actions/a_delete.php" method="post">
                <input type="hidden" name="animal_id" value="<?php echo $id ?>" />
                <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                <button class="btn btn-danger btn-sm" type="submit">Yes, delete it!</button>
                <a href="index.php"><button class="btn btn-warning btn-sm" type="button">No, go back!</button></a>
            </form>
        </fieldset>
    </body>
</html>