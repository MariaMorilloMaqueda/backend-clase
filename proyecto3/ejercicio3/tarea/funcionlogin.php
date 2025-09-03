<?php
/**
 * @author María Morillo Maqueda
 * @version 1.0
 * Implementar aquí la función que realiza la autenticación de usuario (solo debe haber una función). 
 * La función debe:
 * - Recibir por parámetro la conexión a la base de datos (no debe crearse una nueva conexión en su interior)
 * - Recibir por parámetro el nombre de usuario
 * - Recibir por parámetro la contraseña
 * - Retornar el id de usuario (entero  mayor de cero) en caso de autenticación correcta. 
 * - En caso de autenticación no correcta, retornar un valor que permita saber que ha ocurrido.
 * IMPORTANTISIMO: Bajo ningún concepto debe usarse en el interior de la función $_POST, ni $_SESSION.
 */

/**
 * Función con tres parámetros
 * @param $c Instancia de la clase PDO con una conexión a la base de datos.
 * @param $login Nombre de usuario que ingresa
 * @param $contrasenia Contraseña del usuario que ingresa.
 * @return Devuelve el "id" de usuario en caso de autenticación correcta o un mensaje de error en caso de autenticación no correcta.
 */
function iniciarSesion(PDO $c, string $login, string $contrasenia) : int
{
    $SQL = "SELECT id, hash_contraseña FROM usuarios WHERE login = :login";
    try {
        $stmt = $c->prepare($SQL);
        $stmt->bindValue('login', $login, PDO::PARAM_STR);

        if ($stmt -> execute()) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($usuario === false) {
                return false;
            }

            $contraseña_ingresada_hash =  hash('sha256', strrev($login) . $contrasenia . SALTEADO); //INSERT INTO usuarios (login, hash_contraseña) VALUES ('test1', SHA2(CONCAT(REVERSE('test1'), 'TEST', '_28381TXF'), 256));
            
            if ($contraseña_ingresada_hash === $usuario['hash_contraseña']) {
                return (int) $usuario['id'];
            } else {
                return false;
            }
        }
    } catch (PDOException $ex) {
        return false;
    }
}
