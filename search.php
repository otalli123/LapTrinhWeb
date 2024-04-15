<?php
    require_once("database_connect_PDO.php");
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: index.php');
    }

    $maphieuhen = '';
    $ketqua = '';
    $nen = '';
    $khongnen = '';
    $ngaytaikham = '';
    $hinhanh1 = '';
    $hinhanh2 = '';

    if(isset($_POST['timkiem'])){
        $maphieu = strip_tags($_POST['maphieu']);

        try{
            $select_stmt = $db->prepare("SELECT * FROM `ketqua` WHERE MAPHIEU = :maphieu");
            $select_stmt->execute([':maphieu' => $maphieu]);

            if($row = $select_stmt->fetch(PDO::FETCH_ASSOC)){
                $maphieuhen = $row["MAPHIEU"];
                $ketqua = $row["KETQUA"];
                $nen = $row["NEN"];
                $khongnen = $row["KHONGNEN"];
                $ngaytaikham = $row["NGAYTAIKHAM"];
                $hinhanh1 = $row["HINHANH1"];
                $hinhanh2 = $row["HINHANH2"];

                $_SESSION['success'] = "Đã tìm thấy!";
                $_SESSION['maphieu'] = $maphieu;
            }else{
                $_SESSION['error'] = "Mã phiếu hẹn không tồn tại hoặc chưa xử lý, vui lòng thử lại sau!";
                header('Location: index.php');
                return;
            }
        }catch(PDOException $e){
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
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/flashmessage.css">
</head>
<body>
    <section class="main-container">
        <div class="header">
            <h1>Tra cứu thông tin bệnh nhân</h1>
            <p class="success">
                <?php
                    if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
                    }
                ?>
            </p>
        </div>
        <div class="search">
            <form action="search.php" method="post">
                <div class="item input-maphieu">
                    <label for="maphieu">Nhập mã phiếu:</label>
                    <?php
                        $maphieuhen = isset($_SESSION['maphieu']) ? htmlentities($_SESSION['maphieu']) : '';
                    ?>
                    <input type="number" name="maphieu" id="maphieu" value="<?= $maphieuhen ?>">
                </div>
                <div class="item btn-submit">
                    <a href="index.php">Trở về</a>
                    <input type="submit" name="timkiem" value="Tìm kiếm">
                </div>
            </form>
        </div>
    </section>
    <?php
        if(isset($_SESSION['success'])){
            echo '<section class="table-container">';
                echo '<div class="header-table">';
                    echo '<div>Mã phiếu hẹn</div>';
                    echo '<div>Kết quả</div>';
                    echo '<div>Nên</div>';
                    echo '<div>Không nên</div>';
                    echo '<div>Ngày tái khám</div>';
                    echo '<div>Hình ảnh 1</div>';
                    echo '<div>Hình ảnh 2</div>';
                echo '</div>';
                echo '<div class="table-data">';
                    echo '<div>'.$maphieuhen.'</div>';
                    echo '<div>'.$ketqua.'</div>';
                    echo '<div>'.$nen.'</div>';
                    echo '<div>'.$khongnen.'</div>';
                    echo '<div>'.$ngaytaikham.'</div>';
                    echo '<div>'.$hinhanh1.'</div>';
                    echo '<div>'.$hinhanh2.'</div>';
                echo '</div>';
            echo '</section>';
        }
        unset($_SESSION['success']);
        unset($_SESSION['maphieu']);
    ?>
</body>
</html>