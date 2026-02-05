<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/etudiant_repository.php";
require_once "../../src/repositories/classe_repository.php";
check_admin();

$errors = [];
$matri = '';
$nom = '';
$mail = '';
$classe_id = '';

if ($_POST) {
    $matri = trim($_POST['matri'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $mail = trim($_POST['mail'] ?? '');
    $classe_id = !empty($_POST['classe']) ? (int)$_POST['classe'] : null;

    if ($matri === '' || $nom === '') {
        $errors[] = 'Matricule et nom sont requis.';
    }

    if (empty($errors)) {
        if (addEtudiant($matri, $nom, $mail, $classe_id)) {
            $_SESSION['flash'] = 'Étudiant ajouté avec succès.';
            header('Location: etudiant.php');
            exit;
        } else {
            $errors[] = 'Erreur lors de l’ajout en base.';
        }
    }
}

$classes = getAllClasses();
?>

<h2>Ajouter un étudiant</h2>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
<ul>
<?php foreach ($errors as $err): ?>
<li><?= htmlspecialchars($err) ?></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<form method="post">
  <div class="mb-3">
    <label class="form-label">Matricule</label>
    <input class="form-control" name="matri" value="<?= htmlspecialchars($matri) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Nom</label>
    <input class="form-control" name="nom" value="<?= htmlspecialchars($nom) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Mail</label>
    <input class="form-control" name="mail" value="<?= htmlspecialchars($mail) ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Classe</label>
    <select class="form-select" name="classe">
      <option value="">-- Aucune --</option>
      <?php while ($c = mysqli_fetch_assoc($classes)): ?>
        <option value="<?= $c['id'] ?>" <?= ($classe_id == $c['id']) ? 'selected' : '' ?>><?= htmlspecialchars($c['libelleClasse']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <button class="btn btn-primary" type="submit">Ajouter</button>
  <a class="btn btn-secondary" href="etudiant.php">Annuler</a>
</form>