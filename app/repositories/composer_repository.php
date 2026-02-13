<?php
require_once __DIR__ . '/../config/database.php';

function composer_add($etudiant, $matiere, $nature, $note, $annee) {
    global $pdo;
    $stmt = $pdo->prepare(
        "INSERT INTO composer (etudiant_id, matiere_id, natureEval, noteEval, anneeAc)
         VALUES (?, ?, ?, ?, ?)"
    );
    return $stmt->execute([$etudiant, $matiere, $nature, $note, $annee]);
}

function notes_by_etudiant($id) {
    global $pdo;
    $stmt = $pdo->prepare(
        "SELECT m.libelleMat, c.noteEval, c.anneeAc
         FROM composer c
         JOIN matiere m ON c.matiere_id = m.id
         WHERE c.etudiant_id=?"
    );
    $stmt->execute([$id]);
    return $stmt;
}

function get_all_notes() {
    global $pdo, $conn;
    if (isset($conn) && $conn) {
        return get_all_notes_mysqli();
    }
    $stmt = $pdo->prepare(
        "SELECT e.nom, m.libelleMat, c.noteEval, c.natureEval, c.anneeAc
         FROM composer c
         JOIN matiere m ON c.matiere_id = m.id
         JOIN etudiant e ON c.etudiant_id = e.id
         ORDER BY e.nom, m.libelleMat"
    );
    $stmt->execute();
    return $stmt;
}

// Procedural (mysqli) helpers
function composer_add_mysqli($etudiant, $matiere, $nature, $note, $annee) {
    global $conn;
    $stmt = mysqli_prepare($conn, "INSERT INTO composer (etudiant_id, matiere_id, natureEval, noteEval, anneeAc) VALUES (?, ?, ?, ?, ?)");
    // types: i (int), s (string), d (double)
    mysqli_stmt_bind_param($stmt, 'iisdi', $etudiant, $matiere, $nature, $note, $annee);
    return mysqli_stmt_execute($stmt);
}

function get_all_notes_mysqli() {
    global $conn;
    $sql = "SELECT e.nom, c.etudiant_id, m.libelleMat, c.noteEval, c.natureEval, c.anneeAc, e.classe_id
            FROM composer c
            JOIN matiere m ON c.matiere_id = m.id
            JOIN etudiant e ON c.etudiant_id = e.id
            ORDER BY e.classe_id, e.nom, m.libelleMat";
    return mysqli_query($conn, $sql);
}

function notes_by_etudiant_mysqli($id) {
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT m.libelleMat, c.noteEval, c.anneeAc, c.natureEval FROM composer c JOIN matiere m ON c.matiere_id = m.id WHERE c.etudiant_id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}
