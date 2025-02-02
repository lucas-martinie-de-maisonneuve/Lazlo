<?php
session_start();
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && hash('sha256', $password) === $user['password']) {
        switch($user['username'])
        {
            case 'l':
                $_SESSION['user'] = 'Lucas le golden retriever';
                break;
            case 'v':
                $_SESSION['user'] = 'Vanny la plus jolie de toutes';
                break;
        }
        header('Location: index.php');
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="loginpanel">
    <div class="login-container">
        <h2>Connexion</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</div>

</body>
</html>
