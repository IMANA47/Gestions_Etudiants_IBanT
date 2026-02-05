<?php
require_once __DIR__ . '/../config/database.php';

function matiere_all() {
    global $pdo;
    return $pdo->query("SELECT * FROM matiere");
}

function matiere_create($idMat, $libelle) {
    global $pdo;
    $stmt = $pdo->prepare(
        "INSERT INTO matiere (idMat, libelleMat) VALUES (?, ?)"
    );
    return $stmt->execute([$idMat, $libelle]);
}

function matiere_delete($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM matiere WHERE id=?");
    return $stmt->execute([$id]);
}

// Procedural (mysqli) helpers
function matiere_all_mysqli() {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM matiere ORDER BY libelleMat");
}

function matiere_get_mysqli($id) {
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT * FROM matiere WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

function matiere_create_mysqli($idMat, $libelle) {
    global $conn;
    $stmt = mysqli_prepare($conn, "INSERT INTO matiere (idMat, libelleMat) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'ss', $idMat, $libelle);
    return mysqli_stmt_execute($stmt);
}

function matiere_update_mysqli($id, $idMat, $libelle) {
    global $conn;
    $stmt = mysqli_prepare($conn, "UPDATE matiere SET idMat=?, libelleMat=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'ssi', $idMat, $libelle, $id);
    return mysqli_stmt_execute($stmt);
}

function matiere_search_mysqli($keyword) {
    global $conn;
    $like = "%" . $keyword . "%";
    $stmt = mysqli_prepare($conn, "SELECT * FROM matiere WHERE libelleMat LIKE ? ORDER BY libelleMat");
    mysqli_stmt_bind_param($stmt, 's', $like);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}