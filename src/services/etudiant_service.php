<?php
require_once __DIR__.'/../repositories/etudiant_repository.php';

function ajouter_etudiant($data) {
    return etudiant_create(
        $data['matriEt'],
        $data['nom'],
        $data['mail'],
        $data['classe']
    );
}
?>
