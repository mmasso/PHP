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
    /**
     * @global _POST['agenda'] es @param agenda
     */
    if (isset($_POST['agenda'])) {
        $agenda = $_POST['agenda'];
    } else {
        $agenda = [];
    }
    /**
     * @global _POST['nombre'] es @param nombre
     * @global _POST['telefono'] es @param telefono
     * If el nombre esta en la tabla, y telefono esta vacio,
     * el telefono se borrará.
     * Si no esta el nombre, se creara el nombre y el telefono
     * Si esta el nombre, se sustituira el telefono
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
    ?>
    <div class="formulario">
        <h1>Agenda de contactos</h1>
        <form action="" method="post">
            <p>Introduzce el contacto</p>
            <input type="text" name="nombre" placeholder="Nombre del contacto" required>
            <br>
            <input type="number" name="telefono" placeholder="Numero del contacto">
            <br>
            <?php
            foreach ($agenda as $nombre => $telefono) {
                echo '<input type="hidden" name="agenda[' . $nombre . ']" value="' . $telefono . '">';
            }
            ?>
            <input type="submit" value="Enviar">
        </form>

        <?php

        /**
         * Se genera una tabla con @param telefono y @param nombre que van asociados a
         * el @param agenda que veremos al submitear su valor en el formulario y se imprimira
         * en una tabla abajo
         */
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