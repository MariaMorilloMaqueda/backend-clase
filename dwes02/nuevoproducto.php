<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

 // DEPENDENCIAS
require_once 'etc/conf.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar producto</title>
</head>

<body>
    <!-- Mostrar errores -->
    <?php include('secciones/errores.php');?> <!-- Esta parte del código se ha fragmentado en otro archivo (errores.php) para poder ser reutilizada -->
    <form action="guardarproducto.php" method="POST"> <!-- Creación del formulario -->
        <label>Nombre: <input type="text" name="nombre" id="" value="<?=$datos['nombre']??''?>"></label><br> <!-- Si el dato existe lo utilizo y si no se utiliza una cadena vacía -->
        <label>Código EAN: <input type="text" name="codigo_ean" id="" value="<?=$datos['codigo_ean']??''?>"></label><br>
        <label for=""> Categoría:
            <select name="categoria" id="">
                <?php foreach(CATEGORIAS as $cat): ?> <!-- Se recorriendo la constante CATEGORÍAS mediante foreach para añadir las opciones -->
                    <option value="<?=htmlentities($cat)?>"
                        <?=isset($datos['categoria']) && $datos['categoria'] == $cat ? 'selected' : ''?>
                    ><?=htmlentities($cat)?></option> <!-- Se asignan los valores de la variable $cat a cada opción -->
                <?php endforeach; ?>
                    <option value="<?=htmlentities("<'>")?>">TEST</option> <!-- Se añade opción no válida -->
            </select>
        </label><br>
        <label for=""> Propiedades:
            <?php foreach (PROPIEDADES as $p): ?> <!-- Se recorriendo la constante PROPIEDADES mediante foreach para añadir las opciones -->
                <input type="checkbox" name="propiedades[]" value="<?= htmlentities($p) ?>"
                <?=isset($datos['propiedades']) && $datos['propiedades'] == $p ? 'checked' : ''?>>
                <?=htmlentities($p)?> <!-- Se asignan los valores de la variable $P a cada opción -->
            <?php endforeach; ?>
            <input type="checkbox" name="propiedades" value="<?=htmlentities("<'>")?>">TEST <!-- Se añade opción no válida -->
        </label><br>
        <label>Unidades: <input type="text" name="unidades" id="" value="<?=$datos['unidades']??''?>"></label><br>
        <label>Precio: <input type="text" name="precio" id="" value="<?=$datos['precio']??''?>"></label>
        <input type="submit" value="Enviar!">
    </form>
</body>
</html>