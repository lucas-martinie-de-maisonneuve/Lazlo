<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="header">
    <a href="index.php"><button>Accueil</button></a>
    <?php 
        $pages = [
            "lazlo.php" => "Lazlo",
            "vanny.php" => "Vanny",
            "lucas.php" => "Lucas"
        ];
        foreach ($pages as $file => $title) {
            if (basename($_SERVER['PHP_SELF']) !== $file) {
                echo "<a href='$file'><button>$title</button></a>";
            }
        }
    ?>
    <a href="login.php"><button>Déconnexion</button></a>
</div>
