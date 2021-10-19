<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/myStyle.css">
    <link rel="stylesheet" href="../../css/modal.css">
    <title>Index</title>
</head>

<body>
    <div class="flexbox">
        <a href="index.php">Trang chủ</a>
        <a href="DanhSachNhanVien.php">Danh sách nhân viên</a>
        <a href="DanhSachPhong.php">Danh sách phòng</a>
        <a href="DanhSachLoaiNhanVien.php">Danh sách loại nhân viên</a>
        <div class="last-item">
            <?php
            if (!isset($_SESSION)) {
                session_start();
            }
            if (isset($_SESSION['loggedin'])) {
            ?>
                <div class="flexbox">
                    <p>Xin chào, <?php echo $_SESSION['name'] ?> </p>
                    <button id="logout-button" class="login-button logout-button">Đăng xuất</button>
                </div>
            <?php
            } else {
            ?>
                <button onclick="document.getElementById('login-modal').style.display='block'" class="login-button">Đăng nhập</button>
            <?php } ?>
        </div>
    </div>
    <!-- The Modal -->
    <div id="login-modal" class="modal">
        <span onclick="document.getElementById('login-modal').style.display='none'" class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <form class="modal-content animate" action="login.php" method="POST">
            <div class="container">
                <label for=""><b>Tài khoản</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for=""><b>Mật khẩu</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <div class="grid-container-same-width">
                    <button type="button" onclick="document.getElementById('login-modal').style.display='none'" class="cancelbtn">Hủy</button>
                    <button type="submit">Đăng nhập</button>
                </div>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <span id="register-link">Chưa có tài khoản</span>
            </div>
        </form>
    </div>

    <!-- The Modal -->
    <div id="register-modal" class="modal">
        <span onclick="document.getElementById('register-modal').style.display='none'" class="close" title="Close Modal">&times;</span>

        <!-- Modal Content -->
        <form class="modal-content animate" action="DangKy.php" method="POST">
            <div class="container">
                <label for=""><b>Tài khoản</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for=""><b>Mật khẩu</b></label>
                <input type="password" placeholder="Enter Password" id="password" name="password" required>

                <label for=""><b>Nhập lại mật khẩu</b></label>
                <input type="password" placeholder="Enter Password" id="password2" required>
                <span id="error"></span>
                <div class="grid-container-same-width">
                    <button type="button" onclick="document.getElementById('register-modal').style.display='none'" class="cancelbtn">Hủy</button>
                    <button id="register-button" type="submit">Đăng ký</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Get the modal
        var loginModal = document.getElementById('login-modal');
        var registerModal = document.getElementById('register-modal');
        var registerButton = document.getElementById('register-button');
        var password = document.getElementById('password');
        var password2 = document.getElementById('password2');
        var verifyPasswordError = document.getElementById('error');
        password.addEventListener('input', kiemTraPassword);
        password2.addEventListener('input', kiemTraPassword);

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == loginModal) {
                loginModal.style.display = "none";
            }
            if (event.target == registerModal) {
                registerModal.style.display = "none";
            }
        }

        document.getElementById('register-link').onclick = function() {
            loginModal.style.display = "none";
            registerModal.style.display = "block";
        }

        document.getElementById("logout-button").onclick = function() {
            location.href = "logout.php";
        };

        function kiemTraPassword(){
            if (password2.value !== password.value){
                verifyPasswordError.innerHTML = "Mật khẩu không khớp";
                verifyPasswordError.style.color = "red";
                registerButton.disabled = true;
                registerButton.style.backgroundColor = "gray";
            }
            else {
                verifyPasswordError.innerHTML = "";
                registerButton.disabled = false;
                registerButton.style.backgroundColor = "#04AA6D";
            }
        }
    </script>

    <hr>
</body>

</html>