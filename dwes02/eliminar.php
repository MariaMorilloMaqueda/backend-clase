<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

// DEPENDENCIAS
require_once __DIR__ . '/etc/conf.php';
require_once __DIR__ . '/funciones/conectar.php';
require_once __DIR__ . '/funciones/eliminarproducto.php';

// CONEXIÓN CON LA BASE DE DATOS
$con = conectar();

// ACCIONES
if (isset($_POST['action']) && $_POST['action'] == 'eliminar') {
    // SANEAMIENTO DE DATOS
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['option' => ['min_range' => '0']]);

    // Si el id seleccionado es válido se llama a la función y se pasa como parámetro la conexión a la base de datos y el id.
    if (is_int($id)) {
        $resultado = eliminarProducto($con, $id);

        // COMPROBACIÓN MEDIANTE ESTRUCTURA CONDICIONAL DE DATOS DE ENTRADA:
        /*si el resultado devuelve true se elimina el registro, si devuelve false no se elimina.*/
        if ($resultado === true)
        $mensajes = 'Se ha eliminado el producto con id: ' . $id;
        elseif ($resultado === false)
        $mensajes = 'No se ha podido eliminar el producto con id: ' . $id;
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto eliminado</title>
</head>

<body> <!-- Se muestra por pantalla los correspondientes mensajes mediante HTML --> 
    <?php if (isset($mensajes)): ?>
        <p><?= $mensajes ?></p>
    <?php endif; ?>
</body>

</html>