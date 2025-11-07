<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TomTroc' ?></title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav>
           <div class="left-side">
            <a href="index.php?action=home">Accueil</a>
            <a href="index.php?action=showBooks">Nos livres à l'échange</a>
           </div>
           <div class="right-side">
            <a href="index.php?action=loginForm">Se connecter</a>
            <a href="index.php?action=registerForm">S'inscrire</a>
           </div>
        </nav>
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        
    </footer>
    <script src="./js/script.js"></script>
</body>
</html>