<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/composer_repository.php";
check_admin();

$notes = get_all_notes_mysqli();
?>

<h2>Notes (tous les étudiants par classes)</h2>
<a class="btn btn-success mb-3" href="notes_add.php">Ajouter une note</a>
<table class="table table-bordered">
<thead><tr><th>Classe</th><th>Étudiant</th><th>Matière</th><th>Note</th><th>Type</th><th>Année</th></tr></thead>
<tbody>
<?php while ($n = mysqli_fetch_assoc($notes)): ?>
<tr>
<td><?= htmlspecialchars($n['classe_id']) ?></td>
<td><?= htmlspecialchars($n['nom']) ?></td>
<td><?= htmlspecialchars($n['libelleMat']) ?></td>
<td><?= htmlspecialchars($n['noteEval']) ?></td>
<td><?= htmlspecialchars($n['natureEval']) ?></td>
<td><?= htmlspecialchars($n['anneeAc']) ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>