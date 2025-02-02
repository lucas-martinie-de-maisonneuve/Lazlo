<?php
require 'db.php';

function getLastUpdated() {
    global $pdo;
    $stmt = $pdo->query("SELECT updated_at FROM last_updated_at WHERE id = 1");
    return $stmt->fetchColumn();
}

$lastUpdatedDb = getLastUpdated();
$lastUpdatedFile = filemtime('bdd.sql');

if (strtotime($lastUpdatedDb) < $lastUpdatedFile) {
    exec("mysql -u root -p lazloLMVL < bdd.sql");
    $pdo->query("UPDATE last_updated_at SET updated_at = NOW() WHERE id = 1");
}
?>
