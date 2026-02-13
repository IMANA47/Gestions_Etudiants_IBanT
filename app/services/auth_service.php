<?php
require_once __DIR__ . "/../../config/database.php";

function login($username, $password) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    global $conn;

    $sql = "SELECT * FROM utilisateur WHERE username=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['etudiant_id'] = $user['etudiant_id'];
        return true;
    }
    return false;
}
?>