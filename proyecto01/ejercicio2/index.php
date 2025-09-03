<?php require_once 'b.php';?>

<!DOCTYPE html>
<!-- María Morillo Maqueda -->
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2</title>
    </head>
    <body>
        <table border=1>
            <thead>
                <tr>
                    <th>Cuerpo Celeste</th>
                    <th>Distancia al sol (millones de km)</th>
                    <th>Diámetro (km)</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $datosFiltrados = filtrar_por_tipo('satélite'); 
                foreach($datosFiltrados as $fila): //Mediante un foreach se recorre la función y se almacenan los datos filtrados en la variable.
                ?>
                <tr>
                    <td><?= $fila['cuerpo celeste']; ?></td> <!-- Se asignan los valores de la variable $fila a cada celda -->
                    <td><?= $fila['distancia al sol']; ?></td>
                    <td><?= $fila['diámetro']; ?></td>
                    <td><?= $fila['tipo']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
