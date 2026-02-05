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
<title><?= htmlspecialchars($pageTitle ?? "Gestion de stock") ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand" href="index.php">Gestions etudiants</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="nav">
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="index.php">Produits</a></li>
<li class="nav-item"><a class="nav-link" href="product_new.php">Nouveau produit</a></li>
<li class="nav-item"><a class="nav-link" href="history.php">Historique</a></li>
</ul>
</div>
</div>
</nav>
<div class="container my-4">
<?php if (!empty($flash)): ?>
<div class="alert alert-info"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>