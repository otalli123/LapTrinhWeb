<?php
require("ketnoiDatabase.php");
session_start();

if(!isset($_SESSION['admin'])){
    header('Location: index.php');
}

if(isset($_POST["submit"])){
    $hoten = $_POST["hoten"];
    $sdt = $_POST["sdt"];
    $ngaysinh = $_POST["ngaysinh"];
    $diachi = $_POST["diachi"];
    $gioitinh = $_POST["gioitinh"];
    $hinhanh=$_FILES["hinhanh"]["name"];
    $mota = $_POST["mota"];
    $giokham = $_POST["giokham"];
    $makhoa = $_POST["makhoa"];
    // tạo thư mực => note, tạo thư mục images ở bên ngoài trước nhé
    $targer_dir = "./images/";
    //tạo đường dẫn đến file
    $targer_file = $targer_dir.$hinhanh;
    //check đủ các trường thông tin
    if(isset($hoten) && isset($sdt) && isset($ngaysinh) &&  
    isset($diachi) && isset($gioitinh) && isset($hinhanh) && isset($mota) && 
    isset($giokham) && isset($makhoa)){
        move_uploaded_file($_FILES["hinhanh"]["tmp_name"],$targer_file);
        $sql = "INSERT INTO `bacsi`(`MABS`,`HOTEN`, `SDT`, `NGAYSINH`,
        `DIACHI`, `GIOITINH`, `HINHANH`, `MOTA`, `GIOKHAM`, `MAKH`) 
        VALUES (NULL, '$hoten', '$sdt', '$ngaysinh', 
        '$diachi', '$gioitinh', '$hinhanh', '$mota', '$giokham', '$makhoa')";
        mysqli_query($conn, $sql);
        
        $_SESSION['done'] = "Thêm thành công bác sĩ! ".$hoten;
        header("Location: trangchu.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký lịch khám chữa bệnh</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/phieuhen.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/thembacsi.css">
</head>
<body>
    <section class="header-btn">
        <div>
            <a href="trangchu.php">Quay về</a>
        </div>
    </section>
    <section class="main-container">
        <div class="header-item">
            <h1>Thêm bác sĩ</h1>
        </div>
        <div class="form-item">
            <form action="thembacsi.php" method="post" enctype="multipart/form-data" class="form-container">
                <div class="item hovaten">
                    <label for="hoten">Tên bác sĩ</label>
                    <input type="text" id="hoten" name="hoten" require>
                </div>
                <div class="item sodienthoai-container">
                    <label for="sdt">SĐT</label>
                    <input class="sodienthoai-item" type="number" id="sdt" name="sdt" require>
                </div>
                <div class="item diachi-container">
                    <label for="dc">Địa chỉ</label>
                    <input type="text" id="dc" name="diachi" require>
                </div>
                <div class="item container-gtinh-nsinh">
                    <div class="item-gtinh">
                        <label for="gt">Giới tính:</label>
                        <input type="radio" id="gt" name="gioitinh" value="nam" checked>
                        <label>Nam</label> 
                        <input type="radio" id="gt" name="gioitinh" value="nữ">
                        <label>Nữ</label>
                    </div>
                    <div class="item-nsinh">
                        <label for="ns">Ngày sinh:</label>
                        <input type="datetime" id="ns" name="ngaysinh" require>
                    </div>
                </div>
                <div class="item ngaykham-container">
                    <div class="ngaykham-item">   
                        <label for="file">Hình ảnh</label>
                        <input type="file" id="file" name="hinhanh" value="Choose File" require>
                    </div>
                    <div class="giokham-item">
                        <label>Giờ khám:</label>
                        <select name="giokham">
                            <option value="7">Ca 1: 7h00 - 8h30</option>
                            <option value="9">Ca 2: 9h00 - 10h30</option>
                            <option value="11">Ca 3: 11h00 - 12h30</option>
                            <option value="13">Ca 4: 13h00 - 14h30</option>
                            <option value="15">Ca 5: 15h00 - 16h30</option>
                        </select>
                    </div>   
                </div>
                <div class="item mo-ta">
                    <label for="mota">Mô tả</label>
                    <textarea name="mota" id="mota" cols="30" rows="10" require></textarea>
                </div>
                <div class="item ngaykham-container">
                    <div class="item">
                        <label for="gk">Giờ khám:</label>
                        <input type="datetime-local" id="gk" name="giokham" require>
                    </div>
                    <div class="item">
                        <label for="mk">Mã khoa</label>
                        <input type="text" id="mk" name="makhoa" require>
                    </div>
                </div>
                <div class="item btn-thembacsi">
                    <button type="submit" name="submit">Thêm bác sĩ</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>