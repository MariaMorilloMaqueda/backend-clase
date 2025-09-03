<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

// DEPENDENCIAS
require_once __DIR__ . '/etc/conf.php';
require_once __DIR__ . '/funciones/conectar.php';
require_once __DIR__ . '/funciones/modificarUnidades.php';

// CONEXIÓN CON LA BASE DE DATOS
$con = conectar();

// ACCIONES
if (isset($_POST['action']) && $_POST['action'] == 'modificar') {
    // SANEAMIENTO DE DATOS
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['option' => ['min_range' => '1']]);
    $unidades = filter_input(INPUT_POST, 'unidades', FILTER_VALIDATE_INT);
    
    // Si el id seleccionado es válido se llama a la función y se pasa como parámetro la conexión a la base de datos, el id y las unidades introducidas.
    if (is_int($id)) {
        $resultado = modificarProducto($con, $id, $unidades);

        // COMPROBACIÓN MEDIANTE ESTRUCTURA CONDICIONAL DE DATOS DE ENTRADA:
        /*si el resultado devuelve true se modifica el registro, si devuelve false no se modifica
        y si devuelve -1 no se modifica y se especifica porqué.*/
        if ($resultado === true)
            $mensajes = 'Se han modificado las unidades del producto con id: ' . $id;
        elseif ($resultado === false)
            $mensajes = 'No se han podido modificar las unidades del producto con id: ' . $id;
        elseif ($resultado === -1) {
            $mensajes = 'Debe haber al menos una unidad en stock, no se han modificado las unidades del producto con id: ' . $id;
        }
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

<body>  <!-- Se muestra por pantalla los correspondientes mensajes mediante HTML --> 
    <?php if (isset($mensajes)): ?>
        <p><?= htmlspecialchars($mensajes) ?></p>
    <?php endif; ?>
</body>

</html>