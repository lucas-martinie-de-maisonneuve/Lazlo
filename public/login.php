<?php
session_start();
require '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameLogin = $_POST['username_login'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username_login = ?");
    $stmt->execute([$usernameLogin]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && hash('sha256', $password) === $user['password']) {
        $_SESSION['user'] = $user['username']; 

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
            <input type="text" name="username_login" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</div>

</body>
</html>
