<?php
/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

$errores = []; // Array que almacena los errores.
$datos = [];  // Array que almacena los datos seleccionados por el usuario.

$array_datos=[
    ['Venus',108,12104,'planeta'],
    ['Tierra',150,12742,'planeta'],
    ['Luna',150,3474,'satélite'],
    ['Marte',228,6779,'planeta'],
    ['Fobos',228,6779,'satélite'],
    ['Júpiter',778,139820,'planeta'],
    ['Europa',778,3121,'satélite'],
    ['Saturno',1434,116460,'planeta'],
    ['Titán',1434,5151,'satélite'],
    ['Plutón',5906,2377,'planeta enano'],
    ['Ceres',414,940,'asteroide'],
    ['Vesta',353,525,'asteroide'],
    ];

// Procesamos el dato "DISTANCIA_SOL" recibido por POST
if (!isset($_POST['distancia_sol']) || is_array($_POST['distancia_sol']) || trim($_POST['distancia_sol']) === '') {  // Verifica si se ha proporcionado la distancia al sol, que no sea un array ni esté vacío.
    $errores[] = "No se ha introducido la distancia al sol.";
    $datos['distancia_sol'] = 0; //Si el dato no es correcto se considerará 0 como número mínimo.
} else if (!preg_match('/^[0-9]\d*$/', $_POST['distancia_sol'])) { //Verifica que sea un número positivo.
    $errores[] = "La distancia al sol introducida no es correcta.";
    $datos['distancia_sol'] = 0; //Si el dato no es correcto se considerará 0 como número mínimo.
} else {
    $datos['distancia_sol'] = (int) $_POST['distancia_sol'];
}

// Procesamos el dato "TIPO[]" recibido por POST
$tipo_correcto = ['planeta', 'satélite', 'planeta enano', 'asteroide'];
if (!isset($_POST['tipo']) || !is_array($_POST['tipo'])|| count($_POST['tipo']) === 0) { // Verifica que al menos un tipo de cuerpo celeste haya sido seleccionado, que no sea un array y que los valores de los tipos sean válidos.
    $errores[] = "No se ha seleccionado ningún tipo, se muestran todos los tipos.";
    $datos['tipo'] = $tipo_correcto; //Si el dato no es correcto se considerarán todos los tipos.
} else {
    $datos['tipo'] = array_intersect($_POST['tipo'], $tipo_correcto);
    if (empty($datos['tipo'])) {
        // No se seleccionó un tipo válido
        $errores[] = "El tipo de cuerpo celestes recibidos no es válido, se muestran todos los tipos.";
        $datos['tipo'] = $tipo_correcto; // Se consideran todos los tipos
    }
}

// Filtramos el array "ARRAY_DATOS" según los datos seleccionados
$array_filtrado = []; //Se filtra el array de datos basado en la distancia mínima al Sol proporcionada y en los tipos seleccionados.
foreach($array_datos as $cuerpo_celeste) {
    $nombre = $cuerpo_celeste[0];
    $distancia_sol = $cuerpo_celeste[1];
    $diametro = $cuerpo_celeste[2];
    $tipo = $cuerpo_celeste[3];
    
    if($distancia_sol >= $datos['distancia_sol'] && in_array($tipo, $datos['tipo'])) {
        $array_filtrado[] = $cuerpo_celeste;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 3, datos</title>
    </head>
    <body>
        <?php
        if ($errores): // Estructura condicional: si hay errores se mostrarán por pantalla.
            ?>
            <h1>Errores encontrados:</h1>
            <UL>
                <?php
                array_walk($errores, function ($e) {
                    echo "<LI>$e</LI>";
                });
                ?>
            </UL>
        <?php endif; ?>
        <h1>Lista de cuerpos celestes:</h1>
        <ul>
            <li>Mostrando cuerpos celeste con una distancia al sol mínima de <?= $datos['distancia_sol'] ?> millones de kilómetros.</li>
            <li>Mostrando los siguientes cuerpos celeste: <?= implode(', ', $datos['tipo']); ?>.</li>
        </ul>
        <?php if ($array_filtrado):  // Si existe el array filtrado se mostrará el contenido en forma de tabla
            ?>
            <table border=1>
                <tr>
                    <th>Nombre</th>
                    <th>Distancia al Sol (millones km)</th>
                    <th>Diámetro (km)</th>
                    <th>Tipo</th>
                </tr>
                <?php foreach ($array_filtrado as $resultado_final): ?>
                    <tr>
                        <td><?= $resultado_final[0] ?></td>
                        <td><?= $resultado_final[1] ?></td>
                        <td><?= $resultado_final[2] ?></td>
                        <td><?= $resultado_final[3] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>  
    </body>
</html>
