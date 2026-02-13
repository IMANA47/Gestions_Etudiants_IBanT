<?php
// scripts/seed_admin.php
// Exécutez depuis la racine du projet: php scripts/seed_admin.php
// Vérifier les extensions MySQL disponibles pour PHP-CLI avant d'inclure la config
if (!function_exists('mysqli_connect') && !extension_loaded('pdo_mysql')) {
    echo "Aucune extension MySQL disponible pour PHP-CLI (mysqli et pdo_mysql absentes).\n";
    echo "Option 1: activez mysqli/pdo_mysql pour la CLI (éditez php.ini utilisé par 'php --ini').\n";
    echo "Option 2: exécutez ces commandes SQL via phpMyAdmin ou mysql CLI :\n";
    echo "  - Générer un hash de mot de passe : php -r \"echo password_hash('MON_MDP', PASSWORD_DEFAULT).PHP_EOL;\"\n";
    echo "  - INSERT INTO utilisateur (username,password,role) VALUES ('admin','<HASH>', 'admin');\n";
    exit(1);
}

require_once __DIR__ . "/../config/database.php";

$username = 'admin';
$password = 'admin'; // modifiez après exécution

if (empty($username) || empty($password)) {
    echo "Définissez \$username et \$password dans ce fichier.\n";
    exit(1);
}

if (!isset($conn) || !$conn) {
    echo "Connexion MySQLi introuvable. Vérifiez config/database.php et activez mysqli.\n";
    exit(1);
}

$stmt = mysqli_prepare($conn, "SELECT id FROM utilisateur WHERE username=?");
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
if ($row = mysqli_fetch_assoc($res)) {
    echo "Utilisateur '$username' existe déjà (id={$row['id']}).\n";
    exit(0);
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = mysqli_prepare($conn, "INSERT INTO utilisateur (username, password, role) VALUES (?, ?, 'admin')");
mysqli_stmt_bind_param($stmt, 'ss', $username, $hash);
if (mysqli_stmt_execute($stmt)) {
    echo "Compte admin créé: $username (mot de passe: $password)\n";
    echo "Changez le mot de passe immédiatement via l'interface.\n";
    exit(0);
} else {
    echo "Erreur: " . mysqli_error($conn) . "\n";
    exit(1);
}
