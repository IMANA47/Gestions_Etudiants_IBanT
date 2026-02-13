<?php
// public/test/smoke.php
// Simple smoke tests to verify the app environment. Open in browser:
// http://localhost/gestions_etudiants_ibant/public/test/smoke.php

header('Content-Type: text/html; charset=utf-8');

echo "<h2>Smoke Test — Gestions Etudiants</h2>";

// PHP extensions
$mysqliLoaded = extension_loaded('mysqli');
$pdoMysqlLoaded = extension_loaded('pdo_mysql');

echo "<h3>Extensions</h3>";
echo "<ul>";
echo "<li>mysqli: " . ($mysqliLoaded ? '<b style="color:green">OK</b>' : '<b style="color:red">MISSING</b>') . "</li>";
echo "<li>pdo_mysql: " . ($pdoMysqlLoaded ? '<b style="color:green">OK</b>' : '<b style="color:orange">optional</b>') . "</li>";
echo "</ul>";

// check config/database.php existence
$dbFile = __DIR__ . '/../../config/database.php';
if (!file_exists($dbFile)) {
    echo "<div style='color:red;'>Fichier de config manquant: <code>config/database.php</code></div>";
    exit;
}

// If mysqli is available, include config and try DB queries
if ($mysqliLoaded) {
    require_once $dbFile;

    echo "<h3>Connexion MySQLi</h3>";
    if (isset($conn) && $conn) {
        echo "<div style='color:green;'>Connexion MySQLi OK</div>";

        $res = @mysqli_query($conn, 'SHOW TABLES');
        if ($res) {
            echo "<h4>Tables trouvées</h4><ul>";
            $tables = [];
            while ($row = mysqli_fetch_row($res)) {
                $tables[] = $row[0];
                echo "<li>" . htmlspecialchars($row[0]) . "</li>";
            }
            echo "</ul>";

            // check for essential tables
            $needed = ['utilisateur','etudiant','matiere','composer','classe'];
            echo "<h4>Vérification des tables essentielles</h4><ul>";
            foreach ($needed as $t) {
                echo "<li>" . $t . ": " . (in_array($t, $tables) ? '<b style="color:green">OK</b>' : '<b style="color:red">MISSING</b>') . "</li>";
            }
            echo "</ul>";

            // check admin user
            if (in_array('utilisateur', $tables)) {
                $q = "SELECT id, username, role, etudiant_id FROM utilisateur WHERE role='admin' LIMIT 1";
                $r = @mysqli_query($conn, $q);
                if ($r && mysqli_num_rows($r) > 0) {
                    $u = mysqli_fetch_assoc($r);
                    echo "<div style='color:green;'>Admin trouvé: <b>" . htmlspecialchars($u['username']) . "</b> (id=" . $u['id'] . ")</div>";
                } else {
                    echo "<div style='color:orange;'>Aucun admin trouvé dans <code>utilisateur</code>. Créez-en un ou exécutez le script de seed.</div>";
                }
            }

        } else {
            echo "<div style='color:red;'>Impossible de lister les tables: " . htmlspecialchars(mysqli_error($conn)) . "</div>";
        }

    } else {
        echo "<div style='color:red;'>La variable \$conn n'est pas définie par config/database.php ou la connexion a échoué.</div>";
    }
} else {
    echo "<div style='color:red;'>Extension mysqli non disponible dans PHP. Activez-la dans php.ini et redémarrez Apache.</div>";
}

// Check key pages existence
echo "<h3>Pages principales</h3><ul>";
$pages = [
    'Login' => __DIR__ . '/../auth/login.php',
    'Admin Dashboard' => __DIR__ . '/../admin/dashboard.php',
    'Étudiants (admin)' => __DIR__ . '/../admin/etudiant.php',
    'Matières (admin)' => __DIR__ . '/../admin/matiere.php',
    'Notes (admin)' => __DIR__ . '/../admin/notes.php',
    'Notes (étudiant)' => __DIR__ . '/../etudiant/notes.php',
];
foreach ($pages as $label => $path) {
    echo "<li>" . $label . ": " . (file_exists($path) ? '<b style="color:green">présente</b>' : '<b style="color:red">manquante</b>') . "</li>";
}
echo "</ul>";

echo "<hr><p>Fin du test. Si tout est vert, ouvrez le login et testez la connexion (admin) puis parcourez les pages CRUD.</p>";

?>