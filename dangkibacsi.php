<?php
    require("ketnoiDatabase.php");
    session_start();
    $sql = "SELECT * FROM `bacsi`, `khoa` WHERE `MAKHOA` = `MAKH`";
    $query = mysqli_query($conn,$sql)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký lịch khám chữa bệnh</title>
    <link rel="stylesheet" href="css/dangkibacsi.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/btn-dangxuat.css">
</head>
<body>
    <div class="btn-dangxuat">
        <a href="logout.php">Đăng xuất</a>
    </div>
    <div class="header-title">
        <h1>DANH SÁCH BÁC SĨ KHÁM CHỮA BỆNH</h1>
    </div>
    <?php
        while($row = mysqli_fetch_array($query)){
    ?>
        <div class="main-container">
            <div class="card">
                <div class="imgB">
                    <img src="./images/<?= $row["HINHANH"] ?>" alt="">
                </div>
                <div class="content">
                    <div class="details">
                        <h2><?= $row["HOTEN"]?></h2><br><span><?= $row["CHUCVU"]?></span>
                        <div class="data">
                            <h3>Giới tính: <?= $row["GIOITINH"]?></h3>
                            <h4>Phòng khám: <?= $row["TENKHOA"]?></h4>
                        </div>
                        <div class="btn-container">
                            <a href="phieuhen.php">Đăng kí lịch</a>
                            <a target="_blank" href="https://zalo.me/<?= $row["SDT"]?>" >Liên hệ</a>
                        </div>
                    </div>
                </div>
            </div> 
    <?php }?>
</body>
</html>