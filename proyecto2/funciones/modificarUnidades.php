<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

/**
 * Función con tres parámetros
 * @param $c Instancia de la clase PDO con una conexión a la base de datos.
 * @param $id Almacena el id del producto seleccionado.
 * @param $unidades Almacena las unidades a modificar.
 * @return Devuelve true si funciona correctamente, false en caso de error o -1 en caso de violación de la restricción.
 */
function modificarProducto(PDO $c, int $id, int $unidades)
{
    // Sentencia SQL
    $SQL = "UPDATE productos SET unidades = unidades + :unidades WHERE id = :id";
    try {
        $stmt = $c->prepare($SQL); // PDOStatement
        $stmt->bindValue('unidades', $unidades, PDO::PARAM_INT); // Se asigna el nuevo valor introducido a la variable
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        // EJECUCIÓN DE LA CONSULTA
        if ($stmt->execute()) {
            $registrosModificados = $stmt->rowCount(); // Se comprueba el número de registros modificados.
            if ($registrosModificados === 1) // Si se modifica 1 registro retorna true.
            return true;
        }
    } catch (PDOException $ex) {
        // Si ocurre una excepción, verificar si es por violación de la restricción.
        if ($ex->getCode() === '23000' || strpos($ex->getMessage(), 'CHECK') !== false) {
            // Retorna -1 si se incumple la restricción unidades INT NOT NULL CHECK (unidades > 0);.
            return -1;
        }
    }
    return false;
}