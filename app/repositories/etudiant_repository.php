<?php
require_once __DIR__ . "/../../config/database.php";

function getAllEtudiants() {
    global $conn;
    return mysqli_query($conn, "SELECT e.*, c.libelleClasse FROM etudiant e LEFT JOIN classe c ON e.classe_id = c.id ORDER BY e.nom");
}

function findEtudiantsByName($keyword) {
    global $conn;
    $like = "%" . $keyword . "%";
    $stmt = mysqli_prepare($conn, "SELECT e.*, c.libelleClasse FROM etudiant e LEFT JOIN classe c ON e.classe_id = c.id WHERE e.nom LIKE ? ORDER BY e.nom");
    mysqli_stmt_bind_param($stmt, 's', $like);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function getEtudiant($id) {
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT * FROM etudiant WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

function addEtudiant($matri, $nom, $mail, $classe) {
    global $conn;
    $sql = "INSERT INTO etudiant(matriEt,nom,mail,classe_id)
            VALUES(?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $matri, $nom, $mail, $classe);
    return mysqli_stmt_execute($stmt);
}

function updateEtudiant($id, $matri, $nom, $mail, $classe) {
    global $conn;
    $stmt = mysqli_prepare($conn, "UPDATE etudiant SET matriEt=?, nom=?, mail=?, classe_id=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'sssii', $matri, $nom, $mail, $classe, $id);
    return mysqli_stmt_execute($stmt);
}

function deleteEtudiant($id) {
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM etudiant WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    return mysqli_stmt_execute($stmt);
}
