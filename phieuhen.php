<?php
    require_once "database_connect_PDO.php";
    session_start();
    
    $hoten = '';
    $sdt = '';
    $diachi = '';
    $gioitinh = '';
    $namsinh = '';
    $ngaykham = '';
    $giokham = '';
    $mota = '';
    $maphieu = '';
    $maxacthuc = '';
    $mabs = '';
    $trangthai = '';

    if(!isset($_SESSION['user'])){
        header('location: index.php');
    }

    if(isset($_GET['mabs'])){
        $mabs = $_GET['mabs'];
    }else{
        $_SESSION['error'] = "Có lỗi xảy ra vui lòng thử lại sau!";
        header('Location: index.php');
        return;
    }

    if(isset($_POST['btn-DatLich'])){
        $hoten = filter_var($_POST['hovaten'], FILTER_SANITIZE_STRING);
        $sdt = strip_tags($_POST['sodienthoai']);
        $diachi = filter_var($_POST['diachi'], FILTER_SANITIZE_STRING);
        $gioitinh = filter_var($_POST['gioitinh'], FILTER_SANITIZE_STRING);
        $namsinh = filter_var($_POST['namsinh'], FILTER_SANITIZE_STRING);
        $ngaykham = filter_var($_POST['ngaykham'], FILTER_SANITIZE_STRING);
        $giokham = filter_var($_POST['giokham'], FILTER_SANITIZE_STRING);
        $mota = filter_var($_POST['moTa'], FILTER_SANITIZE_STRING);
        $maphieu = rand(1, 100);
        $maxacthuc = rand(1, 100);
        $trangthai = "Đang xử lý";

        if (preg_match('#[0-9]#',$hoten)){
            $_SESSION['error'] = "Nhập vào họ tên không chứa số!";
            header('Location: phieuhen.php?mabs='.$mabs);
            return;
        } 

        if(strlen($sdt) < 10){
            $_SESSION['error'] = "Số điện thoại phải có 10 chữ số!";
            header('Location: phieuhen.php?mabs='.$mabs);
            return;
        }

        if(strlen($namsinh) < 4){
            $_SESSION['error'] = "Nhập lại năm sinh!";
            header('Location: phieuhen.php?mabs='.$mabs);
            return;
        }
        
        try{
            $insert_stmt = $db->prepare("INSERT INTO `phieuhen` (`MAPHIEU`, `HOTEN`, `GIOITINH`, `NAMSINH`, `DIACHI`, `SDT`, `NGAYKHAM`, `GIOKHAM`, `MOTA`, `MAXACTHUC`, `TRANGTHAI`, `MABS`) 
                                                 VALUES (:maphieu, :hoten, :gioitinh, :namsinh, :diachi, :sdt, :ngaykham, :giokham, :mota, :maxacthuc, :trangthai, :mabs)");
                                                 
            if($insert_stmt->execute([':maphieu' => $maphieu, ':hoten' => $hoten, ':gioitinh' => $gioitinh, ':namsinh' => $namsinh, ':diachi' => $diachi, ':sdt' => $sdt, 
                                    ':ngaykham' => $ngaykham, ':giokham' => $giokham, ':mota' => $mota, ':maxacthuc' => $maxacthuc, ':trangthai' => $trangthai, ':mabs' => $mabs]))
            {
                $_SESSION['success'] = "Đăng lịch thành công!";
                $_SESSION['maphieudangki'] = $maphieu;
                header('Location: index.php');
                return;
            }else{
                $_SESSION['error'] = "Có lỗi xảy ra!";
                header('Location: index.php');
                return;
            }
        }catch(PDOException $e){
            $_SESSION['error'] = "Có lỗi xảy ra!";
            header('Location: index.php');
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
    <link rel="stylesheet" href="css/flashmessage.css">
</head>
<body class="body">
    <?php
        $hoten = isset($hoten) ? htmlentities($hoten) : '' ;
        $sdt = isset($sdt) ? htmlentities($sdt) : '';
        $diachi = isset($diachi) ? htmlentities($diachi) : '';
        $namsinh = isset($namsinh) ? htmlentities($namsinh) :'';
        $mota = isset($mota) ? htmlentities($mota) : '';
    ?>
    <section class="main-container">
        <div class="header-item">
            <h1>PHIẾU HẸN KHÁM CHỮA BỆNH</h1>
            <p class="warning">
                <?php
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                ?>
            </p>
        </div>
        <div class="form-item">
            <form action="phieuhen.php?mabs=<?= $mabs ?>" method="post" class="form-container">
                <div class="item hovaten">
                    <label>Họ và tên:</label>
                    <input type="text" name="hovaten" autocomplete="off" required value="<?= $hoten ?>">
                </div>
                <div class="item sodienthoai-container">
                    <label>Số điện thoại:</label>
                    <input type="number" autocomplete="off" name="sodienthoai" autocomplete="off" required value="<?= $sdt ?>">
                </div>
                <div class="item diachi-container">
                    <label>Địa chỉ:</label>
                    <input autocomplete="off" type="text" name="diachi" required value="<?= $diachi ?>">
                </div>
                <div class="item container-gtinh-nsinh">
                    <div class="item-gtinh">
                        <label>Giới tính:</label>
                        <input type="radio" name="gioitinh" value="nam" checked>
                        <label>Nam</label> 
                        <input type="radio" name="gioitinh" value="nữ">
                        <label>Nữ</label>
                    </div>
                    <div class="item-nsinh">
                        <label>Năm sinh:</label>
                        <input class="birthday-item" type="number" autocomplete="off" name="namsinh" required value="<?= $namsinh ?>">
                    </div>
                </div>
                <div class="item ngaykham-container">
                    <div class="ngaykham-item">
                        <label>Ngày khám:</label>   
                        <input type="date" name="ngaykham" required>
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
                    <label>Mô tả:</label>
                    <textarea name="moTa"><?= $mota ?></textarea>     
                </div>  
                <div class="item datlich-button">
                    <a href="index.php">Trở về</a>
                    <input type="submit" name="btn-DatLich" value="Đặt Lịch">
                </div>    
            </form>  
        </div>
    </section>
</body>
</html>