<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/matiere_repository.php";
check_admin();

$errors = [];
$idMat = '';
$libelle = '';

if ($_POST) {
    $idMat = trim($_POST['idMat'] ?? '');
    $libelle = trim($_POST['libelle'] ?? '');
    if ($idMat === '' || $libelle === '') {
        $errors[] = 'Code et libellé sont requis.';
    }
    if (empty($errors)) {
        if (matiere_create($idMat, $libelle)) {
            $_SESSION['flash'] = 'Matière ajoutée.';
            header('Location: matiere.php');
            exit;
        } else {
            $errors[] = 'Erreur lors de l’insertion.';
        }
    }
}
?>

<h2>Ajouter une matière</h2>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger"><ul><?php foreach($errors as $err): ?><li><?= htmlspecialchars($err) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>

<form method="post">
  <div class="mb-3">
    <label class="form-label">Code (idMat)</label>
    <input class="form-control" name="idMat" value="<?= htmlspecialchars($idMat) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Libellé</label>
    <input class="form-control" name="libelle" value="<?= htmlspecialchars($libelle) ?>" required>
  </div>
  <button class="btn btn-primary" type="submit">Ajouter</button>
  <a class="btn btn-secondary" href="matiere.php">Annuler</a>
</form>