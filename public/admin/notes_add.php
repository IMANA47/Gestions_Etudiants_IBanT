<?php
require_once "../../src/services/security_service.php";
require_once "../../src/repositories/composer_repository.php";
require_once "../../src/repositories/etudiant_repository.php";
require_once "../../src/repositories/matiere_repository.php";
check_admin();

$errors = [];
$etudiant = '';
$matiere = '';
$nature = '';
$note = '';
$annee = date('Y');

$etudiants = getAllEtudiants();
$matieres = matiere_all_mysqli();

if ($_POST) {
    $etudiant = isset($_POST['etudiant']) ? (int)$_POST['etudiant'] : 0;
    $matiere = isset($_POST['matiere']) ? (int)$_POST['matiere'] : 0;
    $nature = trim($_POST['nature'] ?? '');
    $note = trim($_POST['note'] ?? '');
    $annee = trim($_POST['annee'] ?? $annee);

    if (!$etudiant || !$matiere || $note === '') {
        $errors[] = 'Étudiant, matière et note sont requis.';
    }

    if (empty($errors)) {
        if (composer_add_mysqli($etudiant, $matiere, $nature, (float)$note, (int)$annee)) {
            $_SESSION['flash'] = 'Note ajoutée.';
            header('Location: notes.php');
            exit;
        } else {
            $errors[] = 'Erreur lors de l’enregistrement.';
        }
    }
}
?>

<h2>Ajouter une note</h2>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger"><ul><?php foreach($errors as $err): ?><li><?= htmlspecialchars($err) ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>

<form method="post">
  <div class="mb-3">
    <label class="form-label">Étudiant</label>
    <select name="etudiant" class="form-select" required>
      <option value="">-- choisir --</option>
      <?php while ($e = mysqli_fetch_assoc($etudiants)): ?>
        <option value="<?= $e['id'] ?>" <?= ($etudiant == $e['id']) ? 'selected' : '' ?>><?= htmlspecialchars($e['nom']) ?> (<?= htmlspecialchars($e['matriEt']) ?>)</option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Matière</label>
    <select name="matiere" class="form-select" required>
      <option value="">-- choisir --</option>
      <?php while ($m = mysqli_fetch_assoc($matieres)): ?>
        <option value="<?= $m['id'] ?>" <?= ($matiere == $m['id']) ? 'selected' : '' ?>><?= htmlspecialchars($m['libelleMat']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Nature</label>
    <input class="form-control" name="nature" value="<?= htmlspecialchars($nature) ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Note</label>
    <input class="form-control" name="note" value="<?= htmlspecialchars($note) ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Année</label>
    <input class="form-control" name="annee" value="<?= htmlspecialchars($annee) ?>">
  </div>

  <button class="btn btn-primary" type="submit">Ajouter</button>
  <a class="btn btn-secondary" href="notes.php">Annuler</a>
</form>