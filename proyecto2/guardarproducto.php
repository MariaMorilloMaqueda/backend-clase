<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

 // DEPENDENCIAS
require_once __DIR__ . '/etc/conf.php';
require_once __DIR__ . '/funciones/conectar.php';
require_once __DIR__ . '/funciones/registrarProducto.php';

//Recoger datos POST
$datos = [];
$errores = [];

// Saneamiento de datos
$datos['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$datos['codigo_ean'] = filter_input(INPUT_POST, 'codigo_ean', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$datos['unidades'] = filter_input(INPUT_POST, 'unidades', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$datos['precio'] = filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Transformación del nombre del producto a minúsculas con strolower
$datos['nombre'] = strtolower($datos['nombre']);

// COMPROBACIÓN MEDIANTE ESTRUCTURA CONDICIONAL DE DATOS DE ENTRADA:
// Nombre: si está vacío o tiene más de 30 caracteres se mostrará un error.
if (!$datos['nombre']) {
    $errores[] = "El nombre no puede estar vacío.";
} else if (strlen($datos['nombre']) > 30) {
    $errores[] = "El nombre no puede tener más de 30 caracteres.";
}

// Código EAN: si está vacío o no es un número o tiene más de 13 caracteres o menos de 8 se mostrará un error.
if (!$datos['codigo_ean']) {
    $errores[] = "El código EAN no puede estar vacío.";
} else if (!is_numeric($datos['precio']) || (strlen($datos['codigo_ean']) > 13) || (strlen($datos['codigo_ean']) < 8)) {
    $errores[] = "El código EAN debe ser un número de entre 8 y 13 caracteres.";
}

// Unidades: si se intrudice un valor no numérico, un número con decimales o 0 se mostrará un error.
if (!is_numeric($datos['unidades']) || intval($datos['unidades']) != $datos['unidades'] || $datos['unidades'] <= 0)  {
    $errores[] = "Debes introducir un número entero positivo de unidades.";
}

// Precio: si se introduce un valor no numérico o un número negativo se mostrará un mensaje de error.
if (!is_numeric($datos['precio']) || $datos['precio'] < 0) {
    $errores[] = "Debes introducir un número positivo para el precio.";
}

// Categorias:
/* Se crea una variable temporal que almacena el valor del campo 'categoría' del formulario enviado por el método POST.
Con filter_input se devuelve el valor del campo o null.*/
$tmp = filter_input(INPUT_POST, 'categoria');

/* Si el valor de la variable se encuentra en la constante categoría se asignará dicho valor al array $datos.
sino, se mostrará un error.*/
if (in_array ($tmp, CATEGORIAS)) {
    $datos['categoria'] = $tmp;
} else {
    $errores[] = "La categoría indicada no existe o no se ha especificado.";
}
// Propiedades:
/* Se crea una variable temporal que almacena el valor del campo 'propiedades' del formulario enviado por el método POST
o un array vacío si no hay valores marcados.*/
$temporal = $_POST['propiedades'] ?? [];

/*Si el valor de la variable es un array (lo que se espera) se asignarán los valores de dicho array al array $datos.
Para ello se emplea la función implode tomando dos arrays ($temporal y PROPIEDADES) y devolviendo otro array con
los valores presentes en ambos. Si no se selecciona nada se asigna null al array $datos ya que es posible no seleccionar nada.*/
if (is_array($temporal)) {
    $datos['propiedades'] = implode(',', array_intersect($temporal, PROPIEDADES));
} else {
    $datos['propiedades'] = null;
}

// ACCIONES
if ($errores) { // Si hay algún error estos se muestran y se vuelve a mostrar el formulario deteniendo la ejecución.
    require 'nuevoproducto.php';
    exit;
} else { // Sino, se establece conexión con la base de datos y se ejecuta la función.
    $con = conectar();
    $resultado = insertarProducto($con, $datos);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto guardado</title>
</head>
<body> <!-- Se muestra por pantalla un mensaje de éxito en caso de que se haya añadido un producto o error en caso contrario --> 
    <?php if ($resultado!==false): ?>
        Se ha creado un producto con id: <?=$resultado?>
    <?php else: ?>
        No se ha podido insertar el producto.
    <?php endif; ?>
</body>
</html>