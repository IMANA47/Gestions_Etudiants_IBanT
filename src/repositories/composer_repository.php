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
    global $pdo;
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
