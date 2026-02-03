<?php
session_start();
require_once "../../src/services/etudiant_service.php";
require_once "../../src/helpers/auth_check.php";

if ($_SESSION['user']['role'] !== 'ADMIN') {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['ajouter'])) {
    ajouter_etudiant_service($_POST);
}

$etudiants = etudiant_find_all();
?>

<h2>Gestion des étudiants</h2>

<form method="post">
    <input name="matriEt" placeholder="Matricule">
    <input name="nom" placeholder="Nom">
    <input name="mail" placeholder="Email">
    <input name="classe" placeholder="ID Classe">
    <button name="ajouter">Ajouter</button>
</form>

<table border="1">
<?php while ($e = $etudiants->fetch()) { ?>
<tr>
    <td><?= $e['nom'] ?></td>
    <td><?= $e['libelleClasse'] ?></td>
    <td>
        <a href="?delete=<?= $e['id'] ?>">Supprimer</a>
    </td>
</tr>
<?php } ?>
</table>
