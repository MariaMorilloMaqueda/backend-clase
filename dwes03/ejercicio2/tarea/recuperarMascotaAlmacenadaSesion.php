<?php
session_start(); 

// DECLARACIÓN DE VARIABLES
$errors = [];
$notifs = [];

/*
FORMATO DEL ARRAY
Deberá retornarse:
- Array vacío si no hay datos en la sesión.
- Array con datos de la mascota si ya está almacenada en la sesión. Fíjate en el script "formnuevamascota.php" y verás que el formato de array esperado es:
        $mascota['nombre']=...
        $mascota['tipo']=...
        $mascota['publica']=...
*/
if (isset($_SESSION['mascota']) && is_array($_SESSION['mascota'])) {
        $mascota = $_SESSION['mascota'];
        if (isset($mascota['nombre']) && is_string($mascota['nombre'])
        && isset($mascota['tipo']) && is_string($mascota['tipo'])
        && isset($mascota['publica']) && is_string($mascota['publica'])) {
                $notifs[] = "Datos rescatados de la sesión.";
                return [
                        'nombre' => $mascota['nombre'],
                        'tipo' => $mascota['tipo'],
                        'publica' => $mascota['publica']
                ];
        } else {
                $errors[] = "Los datos de la mascota en la sesión están incompletos o son inválidos.";
        }
} else {
        $notifs[] = "No hay datos de mascota almacenados en la sesión.";
}
return [];

/*
IMPORTANTE:
 - No debe usarse echo ni print ni nada similar en este script.
 - Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
 - Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
 */

