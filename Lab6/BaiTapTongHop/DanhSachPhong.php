<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách phòng ban</title>
</head>

<body>
    <?php
    require_once("CheckLogin.php");
    include("index.php");
    ?>
    <h2 class="center">Danh sách phòng ban</h2>
    <?php
    require_once("connect.php");
    require_once("myFunction.php");

    $rowsPerPage = 5;
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    $offset = ($_GET['page'] - 1) * $rowsPerPage;

    $maPhong = $_GET['maPhong'] ?? '';
    $tenPhong = $_GET['tenPhong'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query =
            "SELECT * FROM phong_ban 
            WHERE ma_phong LIKE CONCAT('%', ?, '%')
            AND ten_phong LIKE CONCAT('%', ?, '%')
            ORDER BY ma_phong
            LIMIT $offset, $rowsPerPage
            ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $maPhong, $tenPhong);
        $stmt->execute();
        $phongs = $stmt->get_result();
        //
        $query =
            "SELECT * FROM phong_ban 
            WHERE ma_phong LIKE CONCAT('%', ?, '%')
            AND ten_phong LIKE CONCAT('%', ?, '%')
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $maPhong, $tenPhong);
        $stmt->execute();
        $maxPage = ceil($stmt->get_result()->num_rows / $rowsPerPage);
    }


    $tableHeaders = array('Mã phòng', 'Tên phòng');

    $queryData = array(
        'maPhong' => $maPhong,
        'tenPhong' => $tenPhong
    );

    ?>
    <a href="ThemPhong.php">Thêm mới</a>
    <div class="center">
        <form action="" method="GET" class="my-form no-border">
            <div class="grid-container">
                Mã phòng
                <input type="text" name="maPhong" value="<?php echo $maPhong ?>">
                Tên phòng
                <input type="text" name="tenPhong" value="<?php echo $tenPhong ?>">
            </div>
            <div class="center">
                <div class="grid-container-same-width">
                    <input type="submit" name="timKiem" value="Tìm kiếm" class="simple-button">
                    <input type="reset" value="Nhập lại" onclick="window.location = window.location.pathname + window.location.hash;" class="simple-button">
                </div>
            </div>
        </form>
    </div>

    <?php
    buildTable(
        $phongs,
        "EditPhong.php",
        "DeletePhong.php",
        $tableHeaders,
        id1: "ma_phong",
        searchQuery: getSearchQuery($queryData),
        maxPage: $maxPage
    );
    ?>
</body>

</html>