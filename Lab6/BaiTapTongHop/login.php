<?php
session_start();
require_once("connect.php");
require_once("myFunction.php");
if (!isset($_POST['username'], $_POST['password'])) {
    exit('Please fill both the username and password fields!');
}
if ($stmt = $conn->prepare('SELECT id, password FROM tai_khoan WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            header("Location: " . "index.php");
        } else {
            // Incorrect password
            phpAlert("Sai tài khoản hoặc mật khẩu");
            header("refresh:0; url=index.php");
        }
    } else {
        // Incorrect username
        phpAlert("Sai tài khoản hoặc mật khẩu");
        header("refresh:0; url=index.php");
    }
    $stmt->close();
    mysqli_close($conn);
}
