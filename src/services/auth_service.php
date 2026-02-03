<?php
require_once __DIR__ . '/../repositories/utilisateur_repo.php';

function login_service($username, $password) {
    $user = utilisateur_find_by_username($username);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}
