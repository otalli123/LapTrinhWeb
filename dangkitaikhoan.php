<?php
    require_once "database_connect_PDO.php";
    session_start();
    
    if(isset($_SESSION["user"])){
        header('location: index.php');
    }

    if(isset($_REQUEST["btnDangki"])){
		$name = filter_var($_REQUEST['username'], FILTER_SANITIZE_STRING);
		$password = strip_tags($_REQUEST['matkhau']);
		$passwordConfirm = strip_tags($_REQUEST['xacnhanmatkhau']);
        $quyentruycap = 0;

        if(strlen($password) < 6){
            $_SESSION['error'] = "Mật khẩu tối thiểu 6 kí tự!";
            header('Location: dangkitaikhoan.php');
            return;
        }

        if($password != $passwordConfirm){
            $_SESSION['error'] = "Mật khẩu không trùng khớp!";
            header('Location: dangkitaikhoan.php');
            return;
        }

        if(!isset($_SESSION['error'])){
            try{
                $select_stmt = $db->prepare("SELECT * FROM taikhoan WHERE HOTEN = :HOTEN");
                $select_stmt->execute([":HOTEN" => $name]);
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

                if(isset($row['HOTEN']) == $name){
                    $_SESSION['error'] = "Tên tài khoản đã tồn tại vui lòng chọn tên khác!";
                    header('Location: dangkitaikhoan.php');
                    return;
                }
                else{
					$hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $insert_stmt = $db->prepare("INSERT INTO taikhoan(HOTEN, PASSWORD, QUYENTRUYCAP) VALUES (:HOTEN, :PASSWORD, :QUYENTRUYCAP)");

                    if($insert_stmt->execute([":HOTEN" => $name, ":PASSWORD" => $hashed_password, ":QUYENTRUYCAP" => $quyentruycap])){
                        $_SESSION['success'] = "Đăng ký tài khoản thành công!";
                        header("location: dangnhap.php");
                        return;
                    }
                }
            }
            catch(PDOEXCEPTION $e){
                echo $e->getMessage();
            }
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
    <link rel="stylesheet" href="css/dangki.css">
    <link rel="stylesheet" href="css/flashmessage.css">
</head>
<body>
    <section class="main-container">
        <div class="header-item">
            <h1>Đăng kí tài khoản</h1>
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
            <form action="dangkitaikhoan.php" method="post" class="form-container">
                <div class="item">
                    <input type="text" name="username" autocomplete="off" required>
                    <label class="title-label">
                        <span class="title">Tên đăng Nhập</span>
                    </label>
                </div>
                <div class="item">
                    <input type="password" name="matkhau" autocomplete="off" required>
                    <label class="title-label">
                        <span class="title">Mật khẩu (tối thiểu 6 kí tự)</span>
                    </label>
                </div>
                <div class="item">
                    <input type="password" name="xacnhanmatkhau" autocomplete="off" required>
                    <label class="title-label">
                        <span class="title">Nhập lại mật khẩu</span>
                    </label>
                </div>
                <div>
                    <div class="navigator-container">
                        <div class="navigator">
                            <a href="dangnhap.php">
                                <button type="button">ĐÃ CÓ TÀI KHOẢN</button>
                            </a> 
                        </div>
                        <div class="navigator">
                            <button type="submit" name="btnDangki">ĐĂNG KÍ</button>
                        </div>
                    </div>
                </div>
            </form>  
        </div>
    </section>
</body>
</html>