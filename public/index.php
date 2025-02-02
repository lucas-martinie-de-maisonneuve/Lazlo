<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="header">
    <a href="index.php"><button>Accueil</button></a>
    <a href="lazlo.php"><button>Lazlo</button></a>
    <a href="vanny.php"><button>Vanny</button></a>
    <a href="lucas.php"><button>Lucas</button></a>
    <a href="login.php"><button>Déconnexion</button></a>
    <a href="../db/export.php"><button>Extract Data</button></a>
</div>

<div class="container">
    <h1>Bienvenue, <?php echo $_SESSION['user']; ?>!</h1>

    <h2>📌 Dernières mises à jour GitHub :</h2>
    <div id="github-updates">
        <p>Chargement des dernières mises à jour...</p>
    </div>
</div>

<script>
    fetch('../includes/fetch_github.php')
    .then(response => response.json())
    .then(data => {
        let updatesDiv = document.getElementById('github-updates');
        updatesDiv.innerHTML = '';

        if (data.error) {
            updatesDiv.innerHTML = "<p>⚠️ Impossible de récupérer les mises à jour : " + data.error + "</p>";
            return;
        }

        data.forEach(commit => {
            let commitDate = new Date(commit.commit.author.date).toLocaleString();
            updatesDiv.innerHTML += `
                <div class="commit">
                    <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" 
                         alt="GitHub" class="github-logo">
                    <div class="commit-info">
                        <p><strong> ${commit.commit.author.name}</strong> <span class="commit-date">📅 ${commitDate}</span></p>
                        <p>${commit.commit.message}</p>
                        <a href="${commit.html_url}" target="_blank">🔗 Voir le commit</a>
                    </div>
                </div>
            `;
        });
    })
    .catch(error => {
        document.getElementById('github-updates').innerHTML = "<p>⚠️ Erreur de chargement des mises à jour.</p>";
    });

</script>

</body>
</html>
