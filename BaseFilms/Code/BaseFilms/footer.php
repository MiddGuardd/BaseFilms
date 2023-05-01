<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="footer.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BaseFilms</title>
</head>
<body>
    
<footer class="copyrights" style="text-align: center;">
    <p class="footer_txt">
        © 
        <?php
            $date = new DateTime('now');
            echo $date->format('Y');
        ?>
        CANU Vincent | Tous droits réservés.
    </p>
</footer>

</body>
</html>

