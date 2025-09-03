<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

/**
 * Función con dos parámetros
 * @param $c Instancia de la clase PDO con una conexión a la base de datos.
 * @param $datos Array que almacena los datos seleccionados.
 * @return Devuelve el "id" autogenerado del producto insertado en la base de datos en caso de que el producto se haya insertado de forma adecuada
 * o false en caso contrario.
 */
function insertarProducto(PDO $c, array $datos): int|false
{
    // Sentencia SQL
    $SQL = "INSERT INTO productos (nombre, codigo_ean, categoria, propiedades, unidades, precio) VALUES (:nombre, :codigo_ean, :categoria, :propiedades, :unidades, :precio)";
    try {
        $stmt = $c->prepare($SQL); // PDOStatement
        $stmt->bindValue('nombre', $datos['nombre']); // Se asigna a cada llave del array dato el valor introducido.
        $stmt->bindValue('codigo_ean', $datos['codigo_ean']);
        $stmt->bindValue('categoria', $datos['categoria']);
        $stmt->bindValue('propiedades', $datos['propiedades']);
        $stmt->bindValue('unidades', $datos['unidades']);
        $stmt->bindValue('precio', $datos['precio']);

        // EJECUCIÓN DE LA CONSULTA
        if ($stmt->execute()) {
            $registrosInsertados = $stmt->rowCount(); // Se comprueba el número de registros insertados.
            if ($registrosInsertados > 0) {
                $id_nuevo_registro = $c->lastInsertId();
                return $id_nuevo_registro; // Retorna el id del nuevo registro.
            }
        }
    } catch (PDOException $ex) {
        return false;
    }
    return false;
}