<?php
    require_once "database_connect_PDO.php";
    session_start();

    if(isset($_REQUEST['user'])){
        header('location: index.php');
    }

    if(isset($_REQUEST['btnDangnhap'])){
        $name = filter_var($_REQUEST['tentaikhoan'], FILTER_SANITIZE_STRING);
		$password = strip_tags($_REQUEST['matkhau']);

        try
        {
            $select_stmt = $db->prepare("SELECT * FROM taikhoan WHERE HOTEN = :HOTEN LIMIT 1");
            $select_stmt->execute([':HOTEN' => $name]);
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if($select_stmt->rowCount() > 0)
            {
                if(password_verify($password, $row['PASSWORD']))
                {
                    $_SESSION['user']['HOTEN'] = $row['HOTEN'];
                    $_SESSION['user']['ID'] = $row['ID'];
                    $_SESSION['user']['QUYENTRUYCAP'] = $row['QUYENTRUYCAP'];
                    $_SESSION['success'] = "Đăng nhập thành công!";
                    
                    if($row['QUYENTRUYCAP'] == 1){
                        $_SESSION['admin']['HOTEN'] = $row['HOTEN'];
                        $_SESSION['admin']['ID'] = $row['ID'];
                        header('location: trangchu.php');
                        return;
                    }else{
                        header('location: index.php');
                        return;
                    }
                    
                    
                }
                else
                {
                    $_SESSION['error']= "Sai tên đăng nhập hoặc mật khẩu!";
                    header('Location: dangnhap.php');
                    return;
                }
            }
        }
        catch(PDOEXCEPTION $e){
            echo $e->getMessage();
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
    <link rel="stylesheet" href="css/dangnhap.css">
    <link rel="stylesheet" href="css/flashmessage.css">
</head>
<body>
    <section class="main-container">
        <div class="header-item">
            <h1>Đăng nhập</h1>
            <div>
                <?php
                    if(isset($_SESSION['success'])){
                        echo '<p class="success">'.$_SESSION['success'].'</p>';
                        unset($_SESSION['success']);
                    }

                    if(isset($_SESSION['error'])){
                        echo '<p class="warning">'.$_SESSION['error'].'</p>';
                        unset($_SESSION['error']);
                    }
                ?>
            </div>
        </div>
        <div class="form-item">
            <form action="dangnhap.php" method="post">
                <div class="form">
                    <input type="text" name="tentaikhoan" autocomplete="off" required>
                    <label class="label-dnhap">
                        <span class="text-dnhap">Họ và tên</span>
                    </label>
                </div>
                <div class="form matkhau">
                    <input type="password" name="matkhau" required>
                    <label class="label-dnhap">
                        <span class="text-dnhap">Mật khẩu</span>
                    </label>
                </div>
                <div class="question">
                    <a href="dangkitaikhoan.php">
                        <p>Chưa có tài khoản?</p>
                    </a>
                </div>
                <div class="submit-button">
                    <button type="submit" name="btnDangnhap">ĐĂNG NHẬP</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
