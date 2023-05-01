<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="users.css" />
    <title>BaseFilms</title>
</head>
<body>

    <?php
        include 'menu.php' ;

        if($_SESSION['id'] != 5){header('location:index.php');}

    ?>  

        <div class="content">
                <h3>Pseudos</h3>
                <h3>Adresses e-mail</h3>
                <h3>Dates d'inscriptions</h3>
                <h3>Supprimer les films</h3>
                <h3>Supprimer le profil</h3>
        </div>

        <?php
            $bdd = new CategorieManager();

            foreach ($bdd->users() as $user) {
                echo "<div class='content'>
                <p>".$user['username']."</p>
                <p>".$user['mail']."</p>
                <p>".$user['inscr_date']."</p>
                <form action='' method='POST'>
                     <input type='submit' name='remove_films' value='Supprimer les films de: ".$user['username']."'>
                </form>
                <form action='' method='POST'>
                    <input type='submit' name='delete_user' value='Supprimer le profil de: ".$user['username']."'>
                </form>
                </div>";
            }

            if(isset($_POST['remove_films'])){
                $delete_films = $bdd->delete_all_films($user['id']);
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Films supprimés"); } 
                    </script>';
                header("Refresh:0");
            }
    
            if(isset($_POST['delete_user'])){
                $delete_films = $bdd->delete_all_films($user['id']);
                $delete_user = $bdd->delete_usr($user['id']);
                echo '<script type="text/javascript">
                                window.onload = function () { alert("Compte supprimé"); } 
                    </script>';
                header("Refresh:0");
            }
        ?>

        

<footer class="users_footer"><?php include 'footer.php' ?></footer>

</body>
</html>