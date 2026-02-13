<?php
require_once __DIR__ . '/../repositories/composer_repository.php';

function ajouter_note_service($data) {
    return composer_add(
        $data['etudiant'],
        $data['matiere'],
        $data['nature'],
        $data['note'],
        $data['annee']
    );
}
