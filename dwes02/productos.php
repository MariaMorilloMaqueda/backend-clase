<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

// DEPENDENCIAS
require_once __DIR__ . '/etc/conf.php';
require_once __DIR__ . '/funciones/conectar.php';
require_once __DIR__ . '/funciones/listarProductos.php';
require_once __DIR__ . '/funciones/extraerCategoria.php';

// COMPROBACIONES
$errores = [];
$mensajes = [];

// CONEXIÓN CON LA BASE DE DATOS
$con = conectar();

// Recogemos los parámetros y los comprobamos.
/* Para ello, se ha creado una función adicional que  extrae y valia la categoría enviada desde el método POST del formulario.
LLamamos a la función y su valor se almacena en una variable.*/
$categoria = extraerCategoriaPOST('categoria', $errores);

// Si el valor de la variable está vacío se convierte en null.
if ($categoria == "") $categoria = null;

// LLamada a la función listarProducto: se le pasa como parámetro la conexión y categoría (filtrada previamente).
$productos = listarProducto($con, $categoria); // Se mostrarán los productos usando la función, cuyos datos se almacena en la variable $productos.
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea2 DWES</title>
</head>

<body>
    <form action="" method="post"> <!-- Se añade un filtro a través de un formulario de tipo SELECT. Los datos se envian a productos.php mediante $_POST -->
        <h2>Selección de categoría:</h2>
        <SELECT name="categoria">
        <option value=""></option> <!-- Se añade una opción vacía para mostrar todas las categorías -->
            <?php foreach (CATEGORIAS as $cat): ?> <!-- El resto de opciones se añaden recorriendo la constante CATEGORÍAS mediante foreach -->
                <option value="<?= htmlentities($cat) ?>"><?= htmlspecialchars($cat) ?></option> <!-- Se asignan los valores de la variable $cat a cada opción -->
            <?php endforeach; ?> <!-- Con htmlentities y htmlspecialchars se convierten carácteres especiales a entidades HTML --> 
        </SELECT>
        <br><br>
        <input type="submit" value="Enviar!">
    </form>
    <table border=1> <!-- Creación de la tabla -->
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Código EAN</th>
                <th>Categoría</th>
                <th>Propiedades</th>
                <th>Unidades</th>
                <th>Precio</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?> <!-- Mediante un foreach se recorre la función y se almacenan los datos filtrados en la variable. -->
                <tr>
                    <td><?= $producto['nombre']; ?></td> <!-- Se asignan los valores de la variable $producto a cada celda -->
                    <td><?= $producto['codigo_ean']; ?></td>
                    <td><?= $producto['categoria']; ?></td>
                    <td><?= $producto['propiedades']; ?></td>
                    <td><?= $producto['unidades']; ?></td>
                    <td><?= $producto['precio']; ?></td>
                    <td> <!-- Se añade al listado generadio un botón de modificación mediante formulario -->
                        <form action="modificarproducto.php" method="post"> 
                            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
                            <input type="hidden" name="action" value="modificar">Incremento o decremento:
                            <input type="text" name="unidades" placeholder=""><br>
                            <input type="submit" value="Modificar">
                        </form>
                        <!-- Se añade al listado generadio un botón de eliminación mediante formulario -->
                        <form action="eliminar.php" method="post">
                            <input type="hidden" name="id" value="<?= $producto['id'] ?>"><br>
                            <input type="hidden" name="action" value="eliminar">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>