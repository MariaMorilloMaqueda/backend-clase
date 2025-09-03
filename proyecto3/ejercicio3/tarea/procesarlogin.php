<?php
session_start();

// DECLARACIÓN DE VARIABLES
$errors = [];
$notifs = [];

// Comprobamos si el usuario ya está autenticado
if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id']) && isset($_SESSION['usuario']['login'])) {
    $notifs[] = "Usuario ya autenticado.";
    return LOGIN_PREV;
}

// Saneamiento de datos
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$contrasenia = filter_input(INPUT_POST, 'contraseña');


/*
Autenticamos al usuario si no esta ya previamente autenticado:
Deberá retornarse:
- LOGIN_OK (100): El usuario se ha autenticado correctamente y se guarda id y login en la sesión.
- LOGIN_PREV (150): El usuario ya está autenticado (ya ha información en la sesión del usuario)
- LOGIN_ERR (200): No se ha podido autenticar al usuario (usuario y/o contraseña incorrectos).
- LOGIN_FAIL_DB (400): Ha fallado la conexión a la base de datos o se ha producido cualquier otra excepción
*/
if (empty($login) || empty($contrasenia)) {
    $errors[] = "Debe proporcionar tanto el nombre de usuario como la contraseña.";
    return LOGIN_ERR;
} else {
    try {
        $con = conectar();
        $usuarioAutenticado = iniciarSesion($con, $login, $contrasenia);

        if ($usuarioAutenticado > 0) {
            $_SESSION['usuario'] = [
                'id' => $usuarioAutenticado,
                'login' => $login,
                'ultimo_acceso' => time()
            ];
            $notifs[] = "Usuario autenticado correctamente.";
            return LOGIN_OK;
        } else {
            $errors[] = "Usuario o contraseña incorrectos.";
            return LOGIN_ERR;
        }
    } catch (PDOException $e) {
        $errors[] = "Error en la base de datos: " . $e->getMessage();
        return LOGIN_FAIL_DB;
    }
}

/*
Nota:
- Las constantes ya están creadas en el script "login.php"
- No debe usarse "echo" ni "print" en este script.
- Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php).
- Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php).

MUY IMPORTANTE:
- Debes usar la función que has implementado en funcionlogin.php de forma adecuada.
- Será un error EXTREMADAMENTE grave guardar la contraseña de usuario en la sesión.
- Será un error MUY grave guardar el login de usuario en la sesión antes de haberlo autenticado.
- Será un error grave autenticar al usuario cuando su información ya está en la sesión.
*/
