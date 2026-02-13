<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/matiere_repository.php";
check_admin();

$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $matieres = matiere_search($q);
} else {
    $matieres = matiere_all();
}
?>

<h2>Matières</h2>
<form method="get" class="mb-3">
  <div class="input-group">
    <input type="search" name="q" value="<?= htmlspecialchars($q) ?>" class="form-control" placeholder="Rechercher par libellé">
    <button class="btn btn-primary" type="submit">Rechercher</button>
    <a class="btn btn-success ms-2" href="matiere_add.php">Ajouter</a>
  </div>
</form>

<table class="table table-bordered">
<thead><tr><th>Code</th><th>Libellé</th><th>Actions</th></tr></thead>
<tbody>
<?php
if (is_object($matieres) && method_exists($matieres, 'fetch')) {
    while ($m = $matieres->fetch()) : ?>
<tr>
<td><?= htmlspecialchars($m['idMat']) ?></td>
<td><?= htmlspecialchars($m['libelleMat']) ?></td>
<td>
  <a class="btn btn-sm btn-primary" href="matiere_edit.php?id=<?= $m['id'] ?>">Éditer</a>
  <a class="btn btn-sm btn-danger" href="matiere_delete.php?id=<?= $m['id'] ?>" onclick="return confirm('Supprimer cette matière ?')">Supprimer</a>
</td>
</tr>
<?php endwhile;
} else {
    while ($m = mysqli_fetch_assoc($matieres)) : ?>
<tr>
<td><?= htmlspecialchars($m['idMat']) ?></td>
<td><?= htmlspecialchars($m['libelleMat']) ?></td>
<td>
  <a class="btn btn-sm btn-primary" href="matiere_edit.php?id=<?= $m['id'] ?>">Éditer</a>
  <a class="btn btn-sm btn-danger" href="matiere_delete.php?id=<?= $m['id'] ?>" onclick="return confirm('Supprimer cette matière ?')">Supprimer</a>
</td>
</tr>
<?php endwhile;
}
?>
</tbody>
</table>
