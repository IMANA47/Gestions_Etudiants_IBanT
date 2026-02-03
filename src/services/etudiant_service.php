<?php
require_once __DIR__ . '/../repositories/etudiant_repo.php';

function ajouter_etudiant_service($data) {
    if (empty($data['nom']) || empty($data['matriEt'])) {
        return false;
    }
    return etudiant_create(
        $data['matriEt'],
        $data['nom'],
        $data['mail'],
        $data['classe']
    );
}
