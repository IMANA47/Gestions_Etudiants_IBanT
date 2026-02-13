<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/composer_repository.php";
require_once "../_header.php";
check_etudiant();

$id = isset($_SESSION['etudiant_id']) ? (int)$_SESSION['etudiant_id'] : null;
if (!$id) {
    echo "Aucun étudiant associé à la session.";
    exit;
}

$notes = notes_by_etudiant_mysqli($id);
?>

<h2>Mes notes</h2>
<table class="table table-bordered">
<thead><tr><th>Matière</th><th>Note</th><th>Année</th></tr></thead>
<tbody>
<?php while ($n = mysqli_fetch_assoc($notes)) { ?>
<tr>
<td><?= htmlspecialchars($n['libelleMat']) ?></td>
<td><?= htmlspecialchars($n['noteEval']) ?></td>
<td><?= htmlspecialchars($n['anneeAc']) ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<?php require_once "../_footer.php"; ?>
