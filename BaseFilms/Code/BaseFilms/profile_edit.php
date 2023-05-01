<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="profile_edit.css" />

    <title>BaseFilms</title>
</head>

<body>
    <?php
    include 'menu.php';

    if(isset($_SESSION) && array_key_exists('username', $_SESSION)){
        echo "<br> <br>";
        echo "<a href = 'edit_usrn.php'>Changer de pseudonyme ?</a>";
        echo "<br> <br>";
        echo "<a href = 'edit_pass.php'>Changer de mot de passe ?</a>";
        echo "<br> <br>";
        
        echo '<form action="" method="POST">
                    <input type="submit" name="remove_usr" value="Supprimer le compte">
                </form>';

        if(isset($_POST['remove_usr'])){
            $bdd = new CategorieManager();
           require_once("delete_usr.js");
        }
    }
    
    else header('location: index.php');
    ?>

    <footer class="profile_edit_footer"><?php include 'footer.php' ?></footer>


</body>
</html>