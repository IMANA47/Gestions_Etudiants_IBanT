<?php
require_once "../../src/helpers/auth_check.php";
require_once "../_header.php";
check_admin();
?>

<h2>Administration</h2>
<p>Bienvenue dans l'administration. Utilisez le menu pour gérer les étudiants, matières et notes.</p>
<ul>
<li><a href="etudiant.php">Étudiants</a></li>
<li><a href="matiere.php">Matières</a></li>
<li><a href="notes.php">Notes</a></li>
</ul>

<?php require_once "../_footer.php"; ?>
