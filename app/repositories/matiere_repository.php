<?php
require_once __DIR__ . '/../config/database.php';

// Unified functions: prefer mysqli (legacy) when available, fall back to PDO
function matiere_all() {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        return mysqli_query($conn, "SELECT * FROM matiere ORDER BY libelleMat");
    }
    return $pdo->query("SELECT * FROM matiere ORDER BY libelleMat");
}

function matiere_create($idMat, $libelle) {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        $stmt = mysqli_prepare($conn, "INSERT INTO matiere (idMat, libelleMat) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, 'ss', $idMat, $libelle);
        return mysqli_stmt_execute($stmt);
    }
    $stmt = $pdo->prepare("INSERT INTO matiere (idMat, libelleMat) VALUES (?, ?)");
    return $stmt->execute([$idMat, $libelle]);
}

function matiere_delete($id) {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        $stmt = mysqli_prepare($conn, "DELETE FROM matiere WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
    $stmt = $pdo->prepare("DELETE FROM matiere WHERE id=?");
    return $stmt->execute([$id]);
}

function matiere_get($id) {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        $stmt = mysqli_prepare($conn, "SELECT * FROM matiere WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($res);
    }
    $stmt = $pdo->prepare("SELECT * FROM matiere WHERE id=?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function matiere_update($id, $idMat, $libelle) {
    global $conn, $pdo;
    if (isset($conn) && $conn) {
        $stmt = mysqli_prepare($conn, "UPDATE matiere SET idMat=?, libelleMat=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'ssi', $idMat, $libelle, $id);
        return mysqli_stmt_execute($stmt);
    }
    $stmt = $pdo->prepare("UPDATE matiere SET idMat=?, libelleMat=? WHERE id=?");
    return $stmt->execute([$idMat, $libelle, $id]);
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

function matiere_search($keyword) {
    global $conn, $pdo;
    $like = "%" . $keyword . "%";
    if (isset($conn) && $conn) {
        $stmt = mysqli_prepare($conn, "SELECT * FROM matiere WHERE libelleMat LIKE ? ORDER BY libelleMat");
        mysqli_stmt_bind_param($stmt, 's', $like);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }
    $stmt = $pdo->prepare("SELECT * FROM matiere WHERE libelleMat LIKE ? ORDER BY libelleMat");
    $stmt->execute([$like]);
    return $stmt;
}