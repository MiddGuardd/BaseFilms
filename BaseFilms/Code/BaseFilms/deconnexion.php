<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icone.png" />
    <title>BaseFilms</title>
</head>
<body>
    <?php
            include 'menu.php';
            session_destroy();
            header('location: index.php');
    ?>
</body>
</html>