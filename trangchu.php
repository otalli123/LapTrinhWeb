<?php
    require("ketnoiDatabase.php");
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: index.php');
    }

    $sql = "SELECT * FROM `bacsi`";
    $query = mysqli_query($conn,$sql)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký lịch khám chữa bệnh</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/trangchuadmin.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/flashmessage.css">
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){
            include "btndangxuat.html";
        }
    ?>
    <h1>Quản lí danh sách bác sĩ</h1>
    <div class="flashtext">
        <?php
            if(isset($_SESSION['done'])){
                echo '<p class="success">'.$_SESSION['done'].'</p>';
                unset($_SESSION['done']);
            }

            if(isset($_SESSION['error'])){
                echo '<p class="warning">'.$_SESSION['error'].'</p>';
                unset($_SESSION['error']);
            }
        ?>
    </div>
    <button>
        <a href="thembacsi.php">Thêm bác sĩ</a>
    </button>
    <table id="productList">
        <tr>
            <th>Mã bác sĩ</th>
            <th>Tên bác sĩ</th>
            <th>Số điện thoại</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Giờ khám</th>
            <th>Mã khoa</th>
            <th>Sửa - Xóa</th>
        </tr>
        <?php
            while($row = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?= $row["MABS"]?></td>
            <td><?= $row["HOTEN"]?></td>
            <td><?= $row["SDT"]?></td>
            <td><?= $row["NGAYSINH"]?></td>
            <td><?= $row["DIACHI"]?></td>
            <td><?= $row["GIOITINH"]?></td>
            <td><img style="width: 200px; height: 200px" src="./images/<?= $row["HINHANH"] ?>" alt=""></td>
            <td><?= $row["MOTA"]?></td>
            <td><?= $row["GIOKHAM"]?></td>
            <td><?= $row["MAKH"]?></td>
            <td><a href="suabacsi.php?id=<?= $row['MABS']?>">Sửa</a>
                <a onclick="return xoasanpham()" href="xoabacsi.php?id=<?= $row['MABS']?>">Xóa</a>
            </td>
        </tr>
        <?php }?>
    </table>
    <script>
    function xoasanpham(){
        var conf = confirm('Bạn có chắc chắn xóa bác sĩ này hay không ?');
        return conf;
        }
    </script>
</body>
</html>