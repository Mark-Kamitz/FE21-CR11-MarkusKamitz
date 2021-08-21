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
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Product</title>
        <?php require_once '../components/boot.php'?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
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
            <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
            <form action="actions/a_update.php"  method="post" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><input class="form-control" type="text"  name="name" placeholder ="Product Name" value="<?php echo $name ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Picture</th>
                        <td><input class="form-control" type="file" name= "picture" /></td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td><input class="form-control" type= "text" name="location"   placeholder="Location" value ="<?php echo $location ?>" /></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input class="form-control" type= "text" name="description"   placeholder="Description" value ="<?php echo $description ?>" /></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <td><input class="form-control" type= "text" name="size"   placeholder="Size" value ="<?php echo $size ?>" /></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><input class="form-control" type= "text" name="age"   placeholder="Age" value ="<?php echo $age ?>" /></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class="form-control" type= "text" name="hobbies"   placeholder="Hobbies" value ="<?php echo $hobbies ?>" /></td>
                    </tr>
                    <tr>
                        <th>Breed</th>
                        <td><input class="form-control" type= "text" name="breed"   placeholder="Breed" value ="<?php echo $breed ?>" /></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><input class="form-control" type= "text" name="status"   placeholder="Status" value ="<?php echo $status ?>" /></td>
                    </tr>
                    <tr>
                        <input type= "hidden" name= "animal_id" value= "<?php echo $data['animal_id'] ?>" />
                        <input type= "hidden" name= "picture" value= "<?php echo $data['picture'] ?>" />
                        <td><button class="btn btn-outline-success btn-sm" type= "submit">Save Changes</button></td>
                        <td><a href= "index.php"><button class="btn btn-outline-warning btn-sm" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>