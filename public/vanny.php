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
    <title>Vanny</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- NavBar -->
<?php include '../includes/header.php'; ?>

<div class="container">
    <h1>Bienvenue sur la page de Vanny ❤️</h1>
    <div class="page-content">
        <p>Vanny, la plus jolie de toutes 💖</p>
    </div>
</div>

</body>
</html>
