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
    <form action="edit_pass.php" method='POST' autocomplete="off" class="form_inscr">
            <label for="new_pass">Nouveau mot de passe : </label>
            <input type="password" name="new_pass" id="new_pass">
            <br>

            <label for="conf_pass">Confirmez le nouveau mot de passe : </label>
            <input type="password" name="conf_pass" id="conf_pass">
            <br>

            <label for="old_pass">Mot de passe actuel : </label>
            <input type="password" name="old_pass" id="old_pass">
            <br>

            <input type="submit" name="envoyer" value="Modifier le mot de passe" class="button_co">
    </form>

    <?php
        if(isset($_POST['envoyer'])){
            $bdd = new CategorieManager();

            $new_pass = trim($_POST['new_pass']);
            $conf_pass = trim($_POST['conf_pass']);
            $old_pass = trim($_POST['old_pass']);
            $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
            $erreurs = false;

            if(empty($new_pass)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez renseigner un nouveau mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            if(empty($conf_pass)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez confirmer votre mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            if(empty(($old_pass))){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez renseigner votre ancien mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            else if($bdd->is_pass_correct($_SESSION['username'], $old_pass) == false){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Mauvais mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            if($new_pass != $conf_pass){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Les mots de passe ne correspondent pas"); } 
                    </script>';
                $erreurs = true;
            }

            if($erreurs != true){

                $var = $bdd->edit_pass($hashed_password, $_SESSION['id']);
                if($var >0){
                    echo '<script type="text/javascript">
                                window.onload = function () { alert("Modification effectuée"); } 
                            </script>';
                }
                
            }
        }
    ?>

    <footer class="edit_pass_footer"><?php include 'footer.php' ?></footer>

</body>
</html>