<?php
session_start();

// DECLARACIÓN DE VARIABLES
$errors = [];
$notifs = [];

/*
GESTIÓN DE LA SESIÓN:
Deberá retornarse:
 - DELETED_FROM_SESSION (100): Si los datos de la mascota fueron eliminados exitosamente de la sesión.
 - NOT_IN_SESSION (200): Si no hay datos de la mascota almacenados en la sesión.
*/
if (isset($_SESSION['mascota'])) {
    unset($_SESSION['mascota']);
    $notifs[] = "Los datos de la mascota se han eliminado exitosamente.";
    return DELETED_FROM_SESSION;
} else {
    $errors[] = "No hay datos de la mascota almacenados en la sesión.";
    return NOT_IN_SESSION;
}
/*
Nota:
 - Las constantes ya están creadas en el script "borrarmascota.php"
 - No debe usarse "echo" ni "print" en este script.
 - Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
 - Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
*/

