<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function secure_input($data) {
    return htmlspecialchars(trim($data));
}

function check_admin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: /gestions_etudiants_ibant/auth/login.php");
        exit;
    }
}

function check_etudiant() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'etudiant') {
        header("Location: /gestions_etudiants_ibant/auth/login.php");
        exit;
    }
}
