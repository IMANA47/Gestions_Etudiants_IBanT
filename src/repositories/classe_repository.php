<?php
require_once __DIR__ . '/../config/database.php';

function classe_all() {
    global $pdo;
    return $pdo->query("SELECT * FROM classe");
}

function classe_create($idClasse, $libelle) {
    global $pdo;
    $stmt = $pdo->prepare(
        "INSERT INTO classe (idClasse, libelleClasse) VALUES (?, ?)"
    );
    return $stmt->execute([$idClasse, $libelle]);
}

function classe_delete($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM classe WHERE id=?");
    return $stmt->execute([$id]);
}

// Procedural helper for existing pages that use mysqli
function getAllClasses() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM classe ORDER BY libelleClasse");
}
