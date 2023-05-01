<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="index.css" />
    <title>BaseFilms</title>
</head>
<body class="index_body">

    <?php
        require_once 'co.php';
        require_once 'CategorieManager.php';

        session_start();
    ?>

    <?php

        $bdd = new CategorieManager();

        if(isset($_SESSION) && array_key_exists('username', $_SESSION)){

            include 'menu.php' ;

            echo "<p class='welcome'>Bienvenue ". $_SESSION['username'] . " !</p>";

            echo "<h2>Les derniers films postés <a href='all_films.php' class='to_post_film'>(Voir tous les films)</a></h2>";
            
            foreach ($bdd->films(5) as $film) {
                echo "<a href='film.php?id=".$film['id']."' class='posted_films'><img src='".$film['image']."'></a>";
            }

            echo "<h2>Vos derniers films favoris <a href='favs.php' class='to_post_film'>(Voir tous vos favoris)</a></h2>";
            
            foreach ($bdd->last_films(5, $_SESSION['id']) as $film) {
                if($film['fav'] == 1)
                    echo "<a href='film.php?id=".$film['id']."' class='posted_films'><img src='".$film['image']."'></a>";
            }

            echo '<h2 class="index_h2-2">Vos derniers films ajoutés <a href="post_film.php" class="to_post_film">(Voir tous vos posts)</a></h2>';

            foreach ($bdd->last_films(5, $_SESSION['id']) as $film) {
                echo "<a href='film.php?id=".$film['id']."' class='posted_films'><img src='".$film['image']."'></a> ";
            }

            if($_SESSION['id'] == 5){
                echo '<p><a href="users.php" class="to_post_film">Gérer les utilisateurs</a></p>';
            }

        }

        else{ //REMPLACER le texte du h1 par le logo
            echo "<div class='index_unco'>
                    <h1>BaseFilms</h1>
                    <p>Bienvenue ! <br> Pour continuer veuillez vous identifier.</p>
                    <ul>
                    <li><a href='inscription.php' title='Inscription'>Inscription</a></li>
                    <li><a href='connexion.php' title='Connexion'>Connexion</a></li>
                    <ul>
                </div>";
        }
    ?>

        <?php include 'footer.php' ?>

</body>
</html>