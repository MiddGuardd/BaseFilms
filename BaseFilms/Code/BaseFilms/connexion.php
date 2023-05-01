<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="formulaire.css" />
    <title>BaseFilms</title>
</head>
<body>
    
    <?php
    require_once 'co.php';
    require_once 'CategorieManager.php';

    session_start();

    if(isset($_SESSION) && array_key_exists('username', $_SESSION)){header('location:index.php');}
    ?>

    <div class="header">
        <a href='index.php'>Accueil</a>
        <img class="logo_co" src="images/logo.png" alt="BaseFilm">
    </div>

    <br> <br>
    <form action="connexion.php" method='POST' autocomplete="off" class="form_inscr">
            <label for="username">Nom d'utilisateur : </label>
            <input type="text" name="username" id="username">
            <br>

            <label for="password">Mot de passe : </label>
            <input type="password" name="password" id="password">
            <br>

            <input type="submit" name="envoyer" value="Connecter" class="button_co">
    </form>

    <?php
        if(isset($_POST['envoyer'])){
            $bdd = new CategorieManager();

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $erreurs = false;

            if(empty($username)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez renseigner un nom pseudonyme"); } 
                    </script>';
                $erreurs = true;
            }

            if(empty($password)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez mettre un mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            if($erreurs == false){

                if($bdd->is_pass_correct($username, $password) == true){
                    $user_exist = $bdd->is_user_taken($username);

                    if($user_exist !=false){
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $user_exist;
                        header('location: index.php');
                    }
                }

                else{
                    echo '<script type="text/javascript">
                                window.onload = function () { alert("Mauvais mot de passe"); } 
                    </script>';
                }
            }
        }
    ?>

    <footer class="connexion_footer"><?php include 'footer.php' ?></footer>

</body>
</html>