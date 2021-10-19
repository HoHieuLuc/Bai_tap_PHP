<?php
session_start();
require_once("connect.php");
$taiKhoan = $_POST['username'];
$matKhau = $_POST['password'];

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taiKhoan = trim($taiKhoan);
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
    }
}
/* if (!empty($errors)) {
        $thongBao = "Lỗi:" . "<br>";
        foreach ($errors as $err) {
            $thongBao .= "- " . $err . "<br>";
        }
        echo $thongBao;
    } */
