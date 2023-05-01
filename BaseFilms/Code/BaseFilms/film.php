<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <link rel="stylesheet" href="film.css" />

    <title>BaseFilms</title>
</head>
<body>
    <?php
        include 'menu.php';
        if(isset($_SESSION) == FALSE || array_key_exists('username', $_SESSION) == FALSE){header('location:index.php');}
        echo "<br>";

        $bdd = new CategorieManager();
        
        $var = $bdd->get_infos($_GET['id']);

        ?>

        <div class="page">
            <div class="titre">
                <img src ="<?= $var['image'] ?>"> <br>
                <h1><?= $var['titre'] ?></h1> <br>
                <?php 
                if($var['note'] <=5 && $_SESSION['id'] == $var['user_id']){
                    echo "<h3>Vous l'avez noté : ".$var['note']." /5</h3>";
                }

                else if($var['note'] <=5 && $_SESSION['id'] != $var['user_id']){
                    echo "<h3>Il a été noté : ". $var['note'] ." /5</h3>";
                }
                else {
                    echo "<h3>Vous ne l'avez pas noté</h3>"; echo "<br>";
                    echo "<form action='' method='POST' autocomplete='off'>
                            <input type='number' name='note' id='note'>
                            <p>/5</p>
                            <input type='submit' name='envoyer' value='Noter' min='0' max='5'>
                        </form>";

                        if(isset($_POST['envoyer'])){
                            if($var['user_id'] == $_SESSION['id']){
                                $note = trim($_POST['note']);
                                if(empty($note) != TRUE){$var2 = $bdd->change_note($var['id'], $note);
                                    header("Refresh:0");}
                            }
                            
                        }
                }
                ?>
            </div>

            <div class="synopsis">
                <p><?= $var['synopsis'] ?></p>
            </div>


            <?php

            if($var['fav'] == 1 && $_SESSION['id'] == $var['user_id']){
                echo '<form action="" method="POST" class="fav_form">
                    <input type="submit" name="remove_fav" value="Supprimer des favoris" class="fav_rem">
                </form>';
            }
            
            else if($var['fav'] == 0 && $_SESSION['id'] == $var['user_id']){
                echo '<form action="" method="POST" class="fav_form">
                    <input type="submit" name="favoris" value="Ajouter aux favoris" class="fav_add">
                </form>';
            }

            if($_SESSION['id'] == $var['user_id']){
            echo '<form action="" method="POST" class="fav_form">
                    <input type="submit" name="remove_film" value="Supprimer le film" class="fav_rem">
                </form>';
            }
            ?>
        </div>

    <?php

        if(isset($_POST['favoris'])){
            if($insert<=0) echo 'erreur';
                $bdd = new CategorieManager();
                $var = $bdd->get_infos($_GET['id']);
                $insert = $bdd->add_fav(1, $var['id']);
                header("Refresh:0");
        }
 

        if(isset($_POST['remove_fav'])){
            $bdd = new CategorieManager();
            $var = $bdd->get_infos($_GET['id']);
            $remove = $bdd->remove_fav(0, $var['id']);
            header("Refresh:0");
            if($insert<=0) echo 'erreur';
        }

        if(isset($_POST['remove_film'])){
            $bdd = new CategorieManager();
            $var = $bdd->get_infos($_GET['id']);
            $remove = $bdd->delete_film($var['id']);
            header("location:index.php");
            if($insert<=0) echo 'erreur';
        }

    ?>

    <footer class="film_footer"><?php include 'footer.php' ?></footer>
</body>
</html>