<?php
session_start();
require_once("connect.php");
require_once("myFunction.php");
$taiKhoan = $_POST['username'];
$matKhau = $_POST['password'];

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taiKhoan = trim($taiKhoan);
    // kiểm tra xem tài khoản có bị trùng không
    $user_check_query = "SELECT * FROM tai_khoan WHERE username = ?  LIMIT 1";
    $stmt = $conn->prepare($user_check_query);
    $stmt->bind_param("s", $taiKhoan);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
        phpAlert("Trùng tài khoản");
        header("refresh:0; url=index.php");
    } 
    // nếu không bị trùng thì thực hiện validate tài khoản và mật khẩu
    else {
        if (strlen($taiKhoan) < 6) {
            $errors[] = 'Tài khoản phải có tối thiểu 6 ký tự';
        }
        if (strlen($matKhau) < 8) {
            $errors[] = 'Mật khẩu phải có tối thiểu 8 ký tự';
        }

        if (empty($errors)) {
            $matKhau = password_hash($matKhau, PASSWORD_DEFAULT);
            $query = "INSERT INTO tai_khoan (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $taiKhoan, $matKhau);
            $stmt->execute();
            if ($conn->affected_rows == 1) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                header('location: index.php');
            }
        } else {
            phpAlert("Đăng ký không thành công");
            header("refresh:0; url=index.php");
        }
    }
    mysqli_close($conn);
}
