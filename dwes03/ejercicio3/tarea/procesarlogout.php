<?php
session_start();
// Inicializamos los arrays de errores y notificaciones
$errors = [];
$notifs = [];

// Verificamos si existe información de usuario en la sesión
/*
Autenticamos al usuario si no esta ya previamente autenticado:

Deberá retornarse:
- LOGOUT_OK (100): Se ha cerrado la sesión de usuario (borrando solo los datos del usuario y respetando otros)
- LOGOUT_ERR (200): No se ha podido autenticar al usuario (usuario no está en la sesión). 
*/
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id'])) {
    unset($_SESSION['usuario']); // Esto elimina solo los datos del usuario autenticado
    $notifs[] = "Sesión cerrada correctamente.";
    return LOGOUT_OK;
} else {
    $errors[] = "No hay usuario autenticado. No se ha podido cerrar la sesión.";
    return LOGOUT_ERR;
}
/*
Nota:
- Las constantes ya están creadas en el script "logout.php"
- No debe usarse "echo" ni "print" en este script.
- Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
- Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
MUY IMPORTANTE:
- Será un error grave borrar toda la información de la sesión de forma indiscriminada.
*/

