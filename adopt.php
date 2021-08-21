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

$id = $_SESSION['user'];
$animal_id = $_GET['animal_id'];

$sql = "INSERT INTO pet_adoption (id, animal_id) VALUES   ('$id', '$animal_id')";
$sql2 = "UPDATE animals SET status = 'adopted' WHERE animal_id = {$animal_id}";

if (mysqli_query($connect, $sql) === true) {     
    $class = "alert alert-success";
    $message = "The record was successfully updated";
    $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
    // header("refresh:1;url=update.php?id={$id}");

    if (mysqli_query($connect, $sql2) === true) {     
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:1;url=info.php?animal_id={$animal_id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        // header("refresh:1;url=update.php?id={$id}");
    }

} else {
    $class = "alert alert-danger";
    $message = "Error while updating record : <br>" . $connect->error;
    $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
    // header("refresh:1;url=update.php?id={$id}");
}
?>


