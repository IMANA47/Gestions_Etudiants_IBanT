<?php
require_once __DIR__ . '/../config/database.php';

function classe_all() {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        return mysqli_query($conn, "SELECT * FROM classe ORDER BY libelleClasse");
    }
    return $pdo->query("SELECT * FROM classe ORDER BY libelleClasse");
}

function classe_create($idClasse, $libelle) {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        $stmt = mysqli_prepare($conn, "INSERT INTO classe (idClasse, libelleClasse) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, 'ss', $idClasse, $libelle);
        return mysqli_stmt_execute($stmt);
    }
    $stmt = $pdo->prepare("INSERT INTO classe (idClasse, libelleClasse) VALUES (?, ?)");
    return $stmt->execute([$idClasse, $libelle]);
}

function classe_delete($id) {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        $stmt = mysqli_prepare($conn, "DELETE FROM classe WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
    $stmt = $pdo->prepare("DELETE FROM classe WHERE id=?");
    return $stmt->execute([$id]);
}

// Procedural helper for existing pages that use mysqli
function getAllClasses() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM classe ORDER BY libelleClasse");
}
// Procedural helper for existing pages that use mysqli
function getAllClasses() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM classe ORDER BY libelleClasse");
}
?>
