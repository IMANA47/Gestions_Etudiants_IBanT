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

$m = matiere_get_mysqli($id);
if (!$m) {
    $_SESSION['flash'] = 'Matière introuvable.';
    header('Location: matiere.php');
    exit;
}

$errors = [];
$idMat = $m['idMat'];
$libelle = $m['libelleMat'];

if ($_POST) {
    $idMat = trim($_POST['idMat'] ?? '');
    $libelle = trim($_POST['libelle'] ?? '');
    if ($idMat === '' || $libelle === '') {
        $errors[] = 'Code et libellé sont requis.';
    }
    if (empty($errors)) {
        if (matiere_update_mysqli($id, $idMat, $libelle)) {
            $_SESSION['flash'] = 'Matière mise à jour.';
            header('Location: matiere.php');
            exit;
        } else {
            $errors[] = 'Erreur lors de la mise à jour.';
        }
    }
}
?>

<h2>Modifier matière</h2>

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
  <button class="btn btn-primary" type="submit">Enregistrer</button>
  <a class="btn btn-secondary" href="matiere.php">Annuler</a>
</form>