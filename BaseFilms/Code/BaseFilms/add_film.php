<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="formulaire.css" />

    <title>BaseFilms</title>
</head>
<body>
    <?php
        include 'menu.php';
        if(isset($_SESSION) == FALSE || array_key_exists('username', $_SESSION) == FALSE){header('location:index.php');}
    ?>

    <br> <br>
    <form action="add_film.php" method='POST' autocomplete="off" enctype="multipart/form-data" class="form_inscr">
            <label for="titre">Titre du film : </label>
            <input type="text" name="titre" id="titre">
            <br>

            <label for="miniature">Affiche du film : </label>
            <input type="file" name="miniature" id="miniature" accept="image/png, image/jpeg">
            <br>

            <label for="synopsis">Synopsis : </label>
            <input name="synopsis" id="synopsis" class="synopsis"></input>
            <br>

            <label for="note">Note sur 5 (optionel) : </label>
            <input type="number" name="note" id="note" min="0" max="5" class="input_note">
            <br>

            <br> <br>

            <input type="submit" name="envoyer" value="Ajouter un film" class="button_co">
    </form>

    <?php

        if(isset($_POST['envoyer'])){
            $titre = trim($_POST['titre']);

            $image = null;

            if(getimagesize($_FILES["miniature"]["tmp_name"])){
                $target_dir = "uploads/";
                $target_file = $target_dir . uniqid() . basename($_FILES["miniature"]["name"]);
                $imageFileType = strtolower(pathinfo(basename($_FILES["miniature"]["name"]),PATHINFO_EXTENSION));

                $uploadOk = 1;

                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                } else {
                    if (move_uploaded_file($_FILES["miniature"]["tmp_name"], $target_file)) {
                      $image = $target_file;
                    } else {
                      echo "erreur";
                    }
                }
            }

            $synopsis = trim($_POST['synopsis']);
            $note = trim($_POST['note']);
            $erreurs = false;

            if(empty($titre)){
                echo "Veuillez renseigner le titre du film";
                echo'<br>';
                $erreurs = true;
            }

            if(empty($synopsis)){
                echo 'Veuillez expliquer le synopsis du film';
                echo'<br>';
                $erreurs = true;
            }

            if(empty($note)){
                $note = 6;
            }

            if($erreurs == false){
                $bdd = new CategorieManager();
                
                $insert = $bdd->add_film($titre, $image, $synopsis, $note);
                header('location:index.php');
            }
        }

    ?>

    <footer class="add_film_footer"><?php include("footer.php"); ?></footer>

</body>
</html>