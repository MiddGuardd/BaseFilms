<?php
require_once 'co.php';
require_once 'CategorieManager.php';

if(isset($_SESSION) == FALSE || array_key_exists('username', $_SESSION) == FALSE) session_start();
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="menu.css"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;300&display=swap" rel="stylesheet">
</head>
<body>
    <div class="menu_body">
    <img class="logo" src="images/logo.png" alt="BaseFilm">

    <?php
    if(isset($_SESSION) && array_key_exists('username', $_SESSION)){
        echo '<li><a href="index.php" title="Accueil">Accueil</a></li>',
        '<li><a href="add_film.php">Ajouter un film</a></li>',
        '<li><a href= "profile_edit.php" title="Edit_Profile">Éditer le profil </a></li>',
        '<li><a href="deconnexion.php" title="Déconnexion">Déconnexion</a></li>';
    }

    else{        
        echo '<li><a href="inscription.php" title="Inscription">Inscription</a></li>',
        '<li><a href="connexion.php" title="Connexion">Connexion</a></li>';
    }
    //Déconnexion
    ?>
    </div>

</body>
</html>