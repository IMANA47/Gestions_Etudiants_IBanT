<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/composer_repository.php";

check_etudiant();

$id = isset($_SESSION['etudiant_id']) ? (int)$_SESSION['etudiant_id'] : null;
if (!$id) {
    echo "Aucun étudiant associé à la session.";
    exit;
}

$notes = notes_by_etudiant($id);
?>

<table border="1">
<tr><th>Matière</th><th>Note</th><th>Année</th></tr>
<?php while ($n = $notes->fetch()) { ?>
<tr>
<td><?= htmlspecialchars($n['libelleMat']) ?></td>
<td><?= htmlspecialchars($n['noteEval']) ?></td>
<td><?= htmlspecialchars($n['anneeAc']) ?></td>
</tr>
<?php } ?>
</table>
