<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="formulaire.css" />
    <title>TBaseFilmsitle</title>
</head>
<body>
    
    <?php
            include 'menu.php';
            if(isset($_SESSION) == FALSE || array_key_exists('username', $_SESSION) == FALSE){header('location:index.php');}
    ?>

    <br> <br>
    <form action="edit_usrn.php" method='POST' autocomplete="off" class="form_inscr">
            <label for="username">Nouveau nom d'utilisateur : </label>
            <input type="text" name="username" id="username">
            <br>

            <label for="password">Mot de passe : </label>
            <input type="password" name="password" id="password">
            <br>

            <input type="submit" name="envoyer" value="Modifier le pseudonyme" class="button_co">
    </form>

    <?php
        if(isset($_POST['envoyer'])){
            $bdd = new CategorieManager();

            $new_username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $erreurs = false;

            if(empty($new_username)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez renseigner un pseudonyme"); } 
                    </script>';
                $erreurs = true;
            }

            if(empty($password)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez mettre votre mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            else if($bdd->is_pass_correct($_SESSION['username'], $password) == false){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Mauvais mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            if($erreurs != true){

                $user_exist = $bdd->is_user_taken($new_username);

                if($user_exist == false){
                    $var = $bdd->edit_username($new_username, $_SESSION['id']);
                    if($var != 0){
                        $_SESSION['username'] = $new_username;
                        
                        echo '<script type="text/javascript">
                                window.onload = function () { alert("Modification effectuée"); } 
                            </script>';
                    }
                else echo 'Veuillez changer votre pseudonyme';
                }
            }
        }
    ?>

    <footer class="edit_usrn_footer"><?php include 'footer.php' ?></footer>

</body>
</html>