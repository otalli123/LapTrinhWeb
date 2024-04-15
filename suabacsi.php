<?php
    require("ketnoiDatabase.php");
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: index.php');
    }
    
    $mabs = (int) $_GET['id'];
    $sql = "SELECT * FROM `bacsi` WHERE `MABS` = '$mabs'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $img = $row['HINHANH']; 

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
        $targer_dir = "./images/";
        if ($hinhanh){
            if (file_exists("./images/".$img)){
                unlink("./images/".$img);
            }
            $targer_file = $targer_dir.$hinhanh;
        }else{
            $targer_file = $targer_dir.$img;
            $hinhanh = $img;
        }       
        //check đủ các trường thông tin
        if(isset($hoten) && isset($sdt) && isset($ngaysinh) &&  
        isset($diachi) && isset($gioitinh) && isset($hinhanh) && isset($mota) && 
        isset($giokham) && isset($makhoa)){
            move_uploaded_file($_FILES["HINHANH"]["tmp_name"],$targer_file);
            $sql = "UPDATE `bacsi` SET `HOTEN` = '$hoten', `SDT` = '$sdt',
            `NGAYSINH` = '$ngaysinh', `DIACHI` = '$diachi',`GIOITINH` = '$gioitinh',
            `HINHANH` = '$hinhanh',`MOTA` = '$mota',`GIOKHAM` = '$giokham',
            `MAKH` = '$makhoa'
            WHERE `bacsi`.`MABS` = '$mabs';";       
            mysqli_query($conn, $sql);

            $_SESSION['done'] = "Cập nhật thành công bác sĩ! ".$hoten;
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
    <link rel="stylesheet" href="css/suabacsi.css">
</head>
<body>
    <section class="header-btn">
        <div>
            <a href="trangchu.php">Quay về</a>
        </div>
    </section>
    <section class="main-container">
        <div class="header-item">
            <h1>Cập nhật thông tin bác sĩ</h1>
        </div>
        <div class="form-item">
            <form class="form-container" action="suabacsi.php?id=<?= $mabs ?>" method="post" enctype="multipart/form-data">
                <div class="item hovaten">
                    <label for="hoten">Họ tên bác sĩ</label>
                    <input type="text" id="hoten" name="hoten" value="<?= $row["HOTEN"] ?>">
                </div>
                <div class="item sodienthoai-container">
                    <label for="sdt">SDT</label>
                    <input type="text" id="sdt" name="sdt" value="<?= $row["SDT"] ?>">
                </div>
                <div class="item diachi-container">
                    <label for="dc">Địa chỉ</label>
                    <input type="text" id="dc" name="diachi" require value="<?= $row["DIACHI"] ?>">
                </div>
                <div class="item container-gtinh-nsinh">
                    <div class="item-gtinh">
                        <label for="gioitinh">Giới tính:</label>
                        <input type="text" id="gioitinh" name="gioitinh" value="<?= $row["GIOITINH"] ?>">
                    </div>
                    <div class="item-nsinh">
                        <label for="ns">Ngày sinh:</label>
                        <input type="datetime" id="ns" name="ngaysinh" value="<?= $row["NGAYSINH"]?>" require>
                    </div>
                </div>
                <div class="item hinhanh-container">
                    <div class="hinhanh">
                        <img src="images/<?= $row["HINHANH"] ?>" alt="">
                    </div>
                    <div>
                        <label for="file">Hình ảnh</label>
                        <input type="file" id="hinhanh" name="hinhanh" value="Choose File" >
                    </div>
                </div>
                <div class="item container-gtinh-nsinh">
                    <div class="item-gtinh">
                        <label for="giokham">Giờ khám:</label>
                        <input type="datetime-local" id="giokham" name="giokham" value="<?= $row["GIOKHAM"] ?>">
                    </div>
                    <div class="item-nsinh">
                        <label for="makhoa">Mã khoa</label>
                        <input type="text" id="makhoa" name="makhoa" value="<?= $row["MAKH"] ?>">
                    </div>
                </div>
                <div class="item mo-ta">
                    <label for="mota">Mô tả</label>
                    <textarea name="mota" id="mota" cols="30" rows="10"><?= $row["MOTA"] ?></textarea>
                </div>
                <div class="item">
                    <button type="submit" name="submit">Cập nhật thông tin bác sĩ</button>
                </div>
            </form>
        </div>
    </section>
    
</body>
</html>