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
    <form action="inscription.php" method='POST' autocomplete="off" class="form_inscr">
            <label for="username">Nom d'utilisateur : </label>
            <input type="text" name="username" id="username">
            <br>

            <label for="email">Email : </label>
            <input type="email" name="mail" id="email" placeholder="abc@exemple.com">
            <br>

            <label for="password">Mot de passe : </label>
            <input type="password" name="password" id="password">
            <br>

            <label for="password2">Confirmer le mot de passe : </label>
            <input type="password" name="password2" id="password2">
            <br> <br>

            <input type="submit" name="envoyer" value="Ajouter" class="button_co">
    </form>

    <?php

        if(isset($_POST['envoyer'])){
            $username = trim($_POST['username']);
            $email = trim($_POST['mail']);
            $password = trim($_POST['password']);
            $password2 = trim($_POST['password2']);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $erreurs = false;

            if(empty($username)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez renseigner un pseudonyme"); } 
                    </script>';
                $erreurs = true;
            }

            if(empty($email)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez mettre un mail"); } 
                    </script>';
                $erreurs = true;
            }

            if(empty($password)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez mettre un mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            if(empty($password2)){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Veuillez confirmer votre mot de passe"); } 
                    </script>';
                $erreurs = true;
            }

            if($password != $password2){
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Les mots de passe doivent être identiques"); } 
                    </script>';
                $erreurs = true;
            }

            if($erreurs == false){
                $bdd = new CategorieManager();
                
                if($bdd->is_user_taken($username) == true){
                    echo '<script type="text/javascript">
                                window.onload = function () { alert("Ce pseudonyme existe déja"); } 
                    </script>';
                } 
                else if($bdd->is_mail_taken($email) == true){
                    echo '<script type="text/javascript">
                                window.onload = function () { alert("Ce mail est déjà utilisé"); } 
                    </script>';
                } 
                else{
                    $insert = $bdd->add(
                        $username, $email, $hashed_password
                    );
    
                    if($insert>0){
                        $_SESSION['username'] = $username;
                        $var = $bdd->get_id($username);
                        $_SESSION['id'] = $var;
                        header('location: index.php');
                    }
                }
            }
        }

    ?>

    <footer class="inscription_footer"><?php include 'footer.php' ?></footer>

</body>
</html>