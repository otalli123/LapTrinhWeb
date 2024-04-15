<?php
    require("ketnoiDatabase.php");
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: index.php');
    }

    if(!isset($_SESSION['admin'])){
        header('Location: index.php');
    }
    $mabs = (int) $_GET['id'];
    $image = "SELECT HINHANH FROM `bacsi` WHERE `bacsi`.`MABS`= $mabs";
    $query = mysqli_query($conn, $image);
    $after = mysqli_fetch_assoc($query);

    //DELETE file img
    if (file_exists("./imgages/".$after['HINHANH'])){
        unlink("./images".$after['HINHANH']);
    }
    $sql = "DELETE FROM `bacsi` WHERE `bacsi`.`MABS` = $mabs";
    
    mysqli_query($conn,$sql);
    header("location: trangchu.php");
?>