<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/etudiant_repository.php";
require_once "../_header.php";
check_admin();

$q = trim($_GET['q'] ?? '');
if ($q !== '') {
    $etudiants = findEtudiantsByName($q);
} else {
    $etudiants = getAllEtudiants();
}
?>

<h2>Étudiants</h2>
<form method="get" class="mb-3">
  <div class="input-group">
    <input type="search" name="q" value="<?= htmlspecialchars($q) ?>" class="form-control" placeholder="Rechercher par nom">
    <button class="btn btn-primary" type="submit">Rechercher</button>
    <a class="btn btn-success ms-2" href="etudiant_add.php">Ajouter</a>
  </div>
</form>

<table class="table table-bordered">
<thead><tr><th>Matricule</th><th>Nom</th><th>Mail</th><th>Classe</th><th>Actions</th></tr></thead>
<tbody>
<?php while($e = mysqli_fetch_assoc($etudiants)): ?>
<tr>
<td><?= htmlspecialchars($e['matriEt']) ?></td>
<td><?= htmlspecialchars($e['nom']) ?></td>
<td><?= htmlspecialchars($e['mail']) ?></td>
<td><?= htmlspecialchars($e['libelleClasse'] ?? '') ?></td>
<td>
  <a class="btn btn-sm btn-primary" href="etudiant_edit.php?id=<?= $e['id'] ?>">Éditer</a>
  <a class="btn btn-sm btn-danger" href="etudiant_delete.php?id=<?= $e['id'] ?>" onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php require_once "../_footer.php"; ?>
