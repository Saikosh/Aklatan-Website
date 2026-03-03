<?php
include('connect.php');
session_start();

if (isset($_POST['user_login'])) {
    $user = $_POST['user_username'];
    $pass = $_POST['user_password'];

    // Secure the input (prevent SQL injection)
    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user;
        header("Location: dashboard.php"); // Where to go after success
    } else {
        echo "<script>alert('Invalid Username or Password'); window.location='index.php';</script>";
    }
}
?>