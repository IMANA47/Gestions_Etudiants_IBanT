<?php
declare(strict_types=1);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($pageTitle ?? "Gestion des étudiants") ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/gestions_etudiants_ibant/assets/css/custom.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
<a class="navbar-brand" href="/gestions_etudiants_ibant/index.php">Gestion Étudiants</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="nav">
<ul class="navbar-nav ms-auto">
<?php if (!empty($_SESSION['user'])): ?>
  <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <li class="nav-item"><a class="nav-link" href="/gestions_etudiants_ibant/public/admin/dashboard.php">Admin</a></li>
    <li class="nav-item"><a class="nav-link" href="/gestions_etudiants_ibant/public/admin/etudiant.php">Étudiants</a></li>
    <li class="nav-item"><a class="nav-link" href="/gestions_etudiants_ibant/public/admin/matiere.php">Matières</a></li>
    <li class="nav-item"><a class="nav-link" href="/gestions_etudiants_ibant/public/admin/notes.php">Notes</a></li>
  <?php else: ?>
    <li class="nav-item"><a class="nav-link" href="/gestions_etudiants_ibant/public/etudiant/notes.php">Mes notes</a></li>
  <?php endif; ?>
  <li class="nav-item"><a class="nav-link" href="/gestions_etudiants_ibant/auth/logout.php">Déconnexion (<?= htmlspecialchars($_SESSION['user']) ?>)</a></li>
<?php else: ?>
  <li class="nav-item"><a class="nav-link" href="/gestions_etudiants_ibant/auth/login.php">Connexion</a></li>
<?php endif; ?>
</ul>
</div>
</div>
</nav>
<div class="container my-4">
<?php if (!empty($flash)): ?>
<div class="alert alert-info"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>