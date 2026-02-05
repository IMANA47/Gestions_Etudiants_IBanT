<?php
session_start();
require_once __DIR__ . "/../src/services/auth_service.php";

if ($_POST) {
    if (login($_POST['username'], $_POST['password'])) {
        if ($_SESSION['role'] === 'admin') {
            header("Location: /gestions_etudiants_ibant/public/admin/dashboard.php");
            exit;
        } else {
            header("Location: /gestions_etudiants_ibant/public/etudiant/notes.php");
            exit;
        }
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow" style="max-width: 400px; width: 100%;">
        <div class="card-body p-4">

            <h4 class="text-center mb-4">Connexion</h4>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Login</label>
                    <input type="text" name="username" class="form-control" placeholder="Login" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Se connecter
                </button>
            </form>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger mt-3 text-center">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>
