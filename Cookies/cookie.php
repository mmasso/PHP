<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitas</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <div class="formulario">
        <h1>Cuantas veces ha visitado mi página?</h1>
        <?php
        if (isset($_COOKIE['visitas'])) {

            setcookie('visitas', $_COOKIE['visitas'] + 1, time() + 3600 * 24);
            $nVisitas = 'Numero de visitas: ' . $_COOKIE['visitas'];
        } else {

            setcookie('visitas', 1, time() + 3600 * 24);
            $nVisitas = 'Bienvenido por primera vez a nuesta web';
        }
        ?>
        <div>
        <form action="cookie.php" method="post">
            <input type="submit" value="+1">
        </form>
        </div>
        <div>
        <?php echo $nVisitas ?>
        </div>
    </div>

</body>

</html>