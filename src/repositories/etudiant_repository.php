<?php
require_once __DIR__ . '/../config/database.php';

function etudiant_create($matriEt, $nom, $mail, $classe_id) {
    global $pdo;
    $sql = "INSERT INTO etudiant (matriEt, nom, mail, classe_id)
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$matriEt, $nom, $mail, $classe_id]);
}

function etudiant_find_all() {
    global $pdo;
    return $pdo->query(
        "SELECT e.*, c.libelleClasse
         FROM etudiant e
         LEFT JOIN classe c ON e.classe_id = c.id"
    );
}

function etudiant_delete($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM etudiant WHERE id=?");
    return $stmt->execute([$id]);
}
