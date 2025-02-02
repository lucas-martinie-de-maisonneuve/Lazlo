<?php
require 'db.php';

$backupFile = 'bdd.sql';
exec("mysqldump -u root -p projet_php > $backupFile");

header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="bdd.sql"');
readfile($backupFile);
exit;
?>
