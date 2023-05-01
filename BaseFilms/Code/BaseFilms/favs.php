<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="post_film.css" />

    <title>BaseFilms</title>
</head>
<body>
    <?php
        include 'menu.php';
    ?>

    <?php

    if(isset($_SESSION) && array_key_exists('username', $_SESSION)){

        echo '<h2>Tous vos films favoris</h2>';

        $bdd = new CategorieManager();
        foreach ($bdd->last_films(999999, $_SESSION['id']) as $film) {
            if($film['fav'] == 1)
                echo "<a href='film.php?id=".$film['id']."' class='posted_films'><img src='".$film['image']."'></a>";
        }

    }

    else header('location: index.php');
    ?>

    <footer class="favs_footer"><?php include 'footer.php' ?></footer>

</body>
</html>