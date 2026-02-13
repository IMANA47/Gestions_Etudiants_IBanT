<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/matiere_repository.php";
check_admin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    $_SESSION['flash'] = 'Identifiant manquant.';
    header('Location: matiere.php');
    exit;
}

if (matiere_delete($id)) {
    $_SESSION['flash'] = 'Matière supprimée.';
} else {
    $_SESSION['flash'] = 'Erreur lors de la suppression.';
}
header('Location: matiere.php');
exit;