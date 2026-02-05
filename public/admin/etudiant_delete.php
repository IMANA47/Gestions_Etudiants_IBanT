<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/etudiant_repository.php";
check_admin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    $_SESSION['flash'] = 'Identifiant manquant.';
    header('Location: etudiant.php');
    exit;
}

if (deleteEtudiant($id)) {
    $_SESSION['flash'] = 'Étudiant supprimé.';
} else {
    $_SESSION['flash'] = 'Erreur lors de la suppression.';
}
header('Location: etudiant.php');
exit;