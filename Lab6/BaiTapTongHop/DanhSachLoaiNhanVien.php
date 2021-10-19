<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Loại nhân viên</title>
</head>

<body>
    <?php
    require_once("CheckLogin.php");
    include("index.php");
    ?>
    <h2 class="center">Danh sách Loại nhân viên</h2>
    <?php
    require_once("connect.php");
    require_once("myFunction.php");

    $rowsPerPage = 5;
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    $offset = ($_GET['page'] - 1) * $rowsPerPage;

    $maLoaiNV = $_GET['maLoaiNV'] ?? '';
    $tenLoaiNV = $_GET['tenLoaiNV'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $query =
            "SELECT * FROM loai_nhanvien
            WHERE ma_loai_nv LIKE CONCAT('%', ?, '%')
            AND ten_loai_nv LIKE CONCAT('%', ?, '%')
            LIMIT $offset, $rowsPerPage
            ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $maLoaiNV, $tenLoaiNV);
        $stmt->execute();
        $loaiNhanViens = $stmt->get_result();

        $query =
            "SELECT * FROM loai_nhanvien
            WHERE ma_loai_nv LIKE CONCAT('%', ?, '%')
            AND ten_loai_nv LIKE CONCAT('%', ?, '%')
            ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $maLoaiNV, $tenLoaiNV);
        $stmt->execute();
        $maxPage = ceil($stmt->get_result()->num_rows / $rowsPerPage);
    }

    $tableHeaders = array('Mã loại nhân viên', 'Tên loại nhân viên');

    $queryData = array(
        'maLoaiNV' => $maLoaiNV,
        'tenLoaiNV' => $tenLoaiNV,
    );
    ?>
    <a href="ThemLoaiNhanVien.php">Thêm mới</a>
    <div class="center">
        <form action="" method="GET" class="my-form no-border">
            <div class="grid-container">
                Mã loại nhân viên
                <input type="text" name="maLoaiNV" value="<?php echo $maLoaiNV ?>">
                Tên loại nhân viên
                <input type="text" name="tenLoaiNV" value="<?php echo $tenLoaiNV ?>">
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
        $loaiNhanViens,
        "EditLoaiNhanVien.php",
        "DeleteLoaiNhanVien.php",
        $tableHeaders,
        id1: "ma_loai_nv",
        maxPage: $maxPage,
        searchQuery: getSearchQuery($queryData)
    );
    ?>
</body>

</html>