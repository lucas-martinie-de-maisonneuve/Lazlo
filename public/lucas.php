<?php
session_start();
// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user'])) {header('Location: login.php');exit;}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- NavBar -->
<?php include '../includes/header.php'; ?>

<div class="container">
    <h1>Bienvenue Lucas</h1>
    <div class="page-content">
        <p>Le golden retriever 🐶</p>
    </div>
</div>

</body>
</html>
