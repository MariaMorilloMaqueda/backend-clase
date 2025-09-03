<?php
session_start();

// DECLARACIÓN DE VARIABLES
$datos = [];
$errors = [];
// No se usa el array notifs porque las variables a retornar ya incuyen un mensaje.

// Saneamiento de datos
$datos['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$datos['publica'] = filter_input(INPUT_POST, 'publica', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// Transformación del nombre a minúsculas con strolower
$datos['nombre'] = strtolower($datos['nombre']);
$datos['publica'] = strtolower($datos['publica']);

// COMPROBACIÓN MEDIANTE ESTRUCTURA CONDICIONAL DE DATOS DE ENTRADA:
// Nombre:
if (!$datos['nombre']) {
    $errors[] = "El nombre no puede estar vacío.";
} else if (strlen($datos['nombre']) > 50) {
    $errors[] = "El nombre no puede tener más de 50 caracteres.";
}

//Publica:
if ($datos['publica'] !== 'si' && $datos['publica'] !== 'no') {
    $errors[] = "Debe seleccionar 'si' o 'no'.";
}

// Tipo:
$tmp = filter_input(INPUT_POST, 'tipo');

if (in_array($tmp, TIPOS_DE_MASCOTAS)) {
    $datos['tipo'] = $tmp;
} else {
    $errors[] = "El tipo indicada no existe o no se ha especificado.";
}

/*
GESTIÓN DE LA SESIÓN:
Deberá retornarse:
- SAVED_IN_SESSION (100): Si los datos se pudieron guardar por primera vez en la sesión.
- UPDATED_IN_SESSION (200): Si los datos existentes en la sesión fueron actualizados.
- ERROR_IN_FORM (400): Si hay errores en el formulario y no se pudo almacenar o actualizar la mascota en la sesión.
*/
if (!empty($errors)) {
    return ERROR_IN_FORM;
} else if (!isset($_SESSION['mascota'])) {
    $_SESSION['mascota'] = $datos;
    return SAVED_IN_SESSION;
} else if ($_SESSION['mascota'] !== $datos) {
    $_SESSION['mascota'] = $datos;
    return UPDATED_IN_SESSION;
}

/*
Notas:
 - Las constantes ya están creadas en el script "nuevamascotasesion.php"
 - No debe usarse "echo" ni "print" en este script.
 - Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
 - Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
 
*/
