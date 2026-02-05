<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/composer_repository.php";
check_admin();

$notes = get_all_notes();
?>

<h2>Notes (tous les étudiants)</h2>
<table border="1">
<tr><th>Étudiant</th><th>Matière</th><th>Note</th><th>Type</th><th>Année</th></tr>
<?php while($n = $notes->fetch()): ?>
<tr>
<td><?= htmlspecialchars($n['nom']) ?></td>
<td><?= htmlspecialchars($n['libelleMat']) ?></td>
<td><?= htmlspecialchars($n['noteEval']) ?></td>
<td><?= htmlspecialchars($n['natureEval']) ?></td>
<td><?= htmlspecialchars($n['anneeAc']) ?></td>
</tr>
<?php endwhile; ?>
</table>
