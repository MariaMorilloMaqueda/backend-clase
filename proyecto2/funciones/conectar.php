<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

/**
 * Función sin parámetros
 * @return Devuelve una conexión a la base de datos mediante la varable $c o un mensaje en caso de error (false).
 */
function conectar(): PDO | false
{
    // Uso de try-catch para capturar errores. Se conecta a la base de datos mediante PDO y los datos definidos en el archivo conf.php
    try {
        $c = new PDO(
            BD_DSN,
            BD_USER,
            BD_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) // Atributo que generará la excepción si se produce un error de conexión.
        );
    } catch (PDOException $e) {
        die('Error interno. Por favor consulte la aplicación más tarde.');
    }
    return $c;
}
