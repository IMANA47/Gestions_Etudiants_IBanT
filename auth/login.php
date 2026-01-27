<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE username=?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['role'] = $user['role'];
        $_SESSION['idEtudiant'] = $user['idEtudiant'];
        if ($user['role'] == 'admin') {
            header("Location: admin/etudiant.php");
        } else {
            header("Location: etudiant/notes.php");
        }
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body class="container">
    <h2>Connexion</h2>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
        <input type="text" name="username" class="form-control" placeholder="Utilisateur" required><br>
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required><br>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</body>
</html>
