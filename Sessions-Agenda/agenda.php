<!DOCTYPE html>
<html lang="es">
<!-- @author Mateu Massó Grau -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Agenda de contactos</title>
</head>

<body>
    <?php
    session_start(['cookie_lifetime' => 3600]);
    ?>
    <div class="formulario">
        <h1>Agenda de contactos</h1>
        <form action="agenda.php" method="POST">
            <p>Introduzce el contacto</p>
            <input type="text" name="nombre" placeholder="Nombre del contacto" required>
            <br>
            <input type="number" name="telefono" placeholder="Numero del contacto">
            <br>
            <input type="submit" value="Enviar">
        </form>

    <?php

    /**
     * Se genera una tabla con @param telefono y @param nombre que van asociados a
     * el @param agenda que veremos al submitear su valor en el formulario y se imprimira
     * en una tabla abajo
     */

    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        if (empty($telefono)) {
            unset($agenda[$nombre]);
        } else {
            $agenda[$nombre] = $telefono;
        }
    }

    foreach ($agenda as $nombre => $telefono) {
        $_SESSION[$nombre] = $telefono;
    }

    $agenda = $_SESSION;

    if (empty($agenda)) {
        echo '<p>La agenda no contiene ningún contacto</p>';
    } else {
        echo '<table><thead><tr><th>Nombre</th><th>Teléfono</th></tr></thead><tbody>';
        foreach ($agenda as $nombre => $telefono) {
            echo "<tr><td>$nombre</td><td>$telefono</td></tr>";
        }
        echo '</tbody></table>';
    }
    ?>
    </div>
</body>

</html>