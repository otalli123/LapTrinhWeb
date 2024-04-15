<?php
    require("ketnoiDatabase.php");
    session_start();
    $sql = "SELECT * FROM `bacsi`, `khoa` WHERE `MAKHOA` = `MAKH`";
    $query = mysqli_query($conn,$sql);

    if(!isset($_SESSION['user'])){
        $location = 'dangnhap.php';
    }else{
        $location = 'phieuhen.php?mabs=';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký lịch khám chữa bệnh</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/dangkibacsi.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/flashmessage.css">
</head>
<body>
    <?php
        if(!isset($_SESSION['user'])){
            include "btndangnhap.html";
        }else{
            include "btndangxuat_timkiem.html";
        }
    ?>
    <section class="container">
        <div class="header-title">
            <h1>DANH SÁCH BÁC SĨ KHÁM CHỮA BỆNH</h1>
            <div>
                <?php
                    if(isset($_SESSION['success'])){
                        echo '<p class="success">'.$_SESSION['success'].'</p>';

                        if(isset($_SESSION['maphieudangki'])){
                            echo '<p class="success">Mã phiếu của bạn là: '.$_SESSION['maphieudangki'].'</p>';
                            unset($_SESSION['maphieudangki']);
                        }
                        unset($_SESSION['success']);
                    }

                    if(isset($_SESSION['error'])){
                        echo '<p class="warning">'.$_SESSION['error'].'</p>';
                        unset($_SESSION['error']);
                    }
                ?>
            </div>
        </div>
        <div class="main-container">
            <?php
                while($row = mysqli_fetch_array($query)){
            ?>
            <div class="card">
                <div class="imgB">
                    <img src="images/<?= htmlentities($row["HINHANH"]) ?>" alt="hình bác sĩ <?= htmlentities($row["MABS"]) ?></html> ?>">
                </div>
                <div class="content">
                    <div class="details">
                        <h2><?= $row["HOTEN"]?></h2>
                        <div class="data">
                            <h3>Giới tính: <?= htmlentities($row["GIOITINH"]) ?></h3>
                            <h4><?= htmlentities($row["TENKHOA"]) ?></h4>
                        </div>
                        <div class="btn-container">
                            <?php 
                                if(isset($_SESSION['user'])){
                                    echo "<a href=".$location.$row["MABS"].">Đăng kí lịch</a>";
                                }
                                else{
                                    echo "<a href=".$location.">Đăng kí lịch</a>";
                                }
                            ?>
                            <a target="_blank" href="https://zalo.me/<?= htmlentities($row["SDT"]) ?>" >Liên hệ</a>
                        </div>
                    </div>
                </div>
            </div> 
            <?php } ?>
        </div>
    </section>
</body>
</html>