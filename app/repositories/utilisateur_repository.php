<?php
require_once __DIR__.'/../config/database.php';

function find_user_by_username($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE username=?");
    $stmt->execute([$username]);
    return $stmt->fetch();
}
?>
