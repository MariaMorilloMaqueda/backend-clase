<?php
session_start();

// DECLARACIÓN DE VARIABLES
$errors = [];
$notifs = [];
$arrayUsuario;
$tiempoInactivo;

/*
Deberá retornarse:
- Array vacío si no hay datos del usuario autenticado en la sesión.
- Array con nombre de usuario (key "login"), último acceso ("ultimo_acceso") y tiempo transcurido desde el último acceso ("tiempo_trascurrido") 
en caso de que haya información almacenada en la sesión del usuario y no haya superado el tiempo de inactividad (10 minutos)
*/
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id']) && isset($_SESSION['usuario']['login']) && isset($_SESSION['usuario']['ultimo_acceso'])) {
    $tiempoInactivo = time() - $_SESSION['usuario']['ultimo_acceso'];

    // Si la inactividad es menor de 10 minutos: se renueva el tiempo de acceso.
    if ($tiempoInactivo > 600) {
        unset($_SESSION['usuario']);
        $errors[] = "La sesión ha expirado por inactividad. Debe iniciar sesión de nuevo.";
        return [];
        // Si la inactividad es mayor de 10 minutos: se elimina la información de usuario (respetando el resto de información que pudiera existir).
    } else {
        $_SESSION['usuario']['ultimo_acceso'] = time();
        $arrayUsuario = [
            'id' => $_SESSION['usuario']['id'],
            'login' => $_SESSION['usuario']['login'],
            'ultimo_acceso' => $_SESSION['usuario']['ultimo_acceso'],
            'tiempo_trascurrido' => $tiempoInactivo
        ];
        $notifs[] = "El tiempo de acceso ha sido renovado.";
        return $arrayUsuario;
    }
} else {
    return [];
}

/*
IMPORTANTE:
Este script es responsable de controlar el tiempo de inactividad (10 minutos). La información de la sesión "ultimo_acceso"
debe incorporarse como medida para controlar el tiempo de inactividad. 

Nota:
- No debe usarse "echo" ni "print" en este script.
- Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php)
- Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php)
*/