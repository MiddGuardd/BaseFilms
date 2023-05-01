<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="style.css" />

    <title>BaseFilms</title>
</head>

<body>
    <?php
        include 'menu.php';

        $bdd = new CategorieManager();
        $var = $bdd->delete_usr($_SESSION['id']);
        $var2 = $bdd->delete_all_films($_SESSION['id']);
            header('location:index.php');
            session_destroy();
        
    ?>


    <?php include 'footer.php' ?>
</body>
</html>