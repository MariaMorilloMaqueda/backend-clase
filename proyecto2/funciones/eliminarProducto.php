<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

/**
 * Función con dos parámetros
 * @param $c Instancia de la clase PDO con una conexión a la base de datos.
 * @param $id Almacena el id del producto seleccionado.
 * @return Devuelve true si funciona correctamente o false en caso de error.
 */
function eliminarProducto(PDO $c, int $id)
{
    // Sentencia SQL
    $SQL = "DELETE FROM productos WHERE id = :id";
    try {
        $stmt = $c->prepare($SQL); // PDOStatement
        $stmt->bindValue('id', $id, PDO::PARAM_INT);

        // EJECUCIÓN DE LA CONSULTA
        if ($stmt->execute()) {
            $registrosEliminados = $stmt->rowCount(); // Se comprueba el número de registros eliminados.
            if ($registrosEliminados === 1) return true; // Si se elimina 1 registro retorna true.
        }
    } catch (PDOException $ex) {
        return false;
    }
    return false;
}
