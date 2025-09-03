<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

/**
 * Función con dos parámetros
 * @param $c Instancia de la clase PDO con una conexión a la base de datos.
 * @param $categoria Parámetro opcional, recoge la clave categoría de un producto.
 * @return Devuelve un array con tres opciones:
 * 1. una tabla bidimensional con todos los productos de una determinada categoría
 * 2. todos los productos si no se indica la categoría
 * 3. un array vacío si la categoría no es una de las categorías esperadas.
 * Devuelve false en caso de error.
 */
function listarProducto(PDO $c, $categoria = null): array|false //$categoria = null hace que $categoria sea opcional
{
    try {
        if ($categoria !== null) {
            if (!in_array($categoria, CATEGORIAS)) {
                return []; // Si categoría no es válida retorna un array vacío.
            }
            $SQL = "SELECT * FROM productos WHERE categoria = :categoria"; // Si categoría es válida se seleccionan los productos de dicha categoría.
            $stmt = $c->prepare($SQL); // PDOStatement
            $stmt->bindValue('categoria', $categoria);   
        } else {
            $SQL = "SELECT * FROM productos"; // Si no hay categoría se seleccionan todos los productos.
            $stmt = $c->prepare($SQL); // PDOStatement
        }

        // EJECUCIÓN DE LA CONSULTA
        if ($stmt->execute()) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $datos; // Retorna los datos como un array asociativo.
        }

    } catch (PDOException $ex) {
        return false;
    }
    return false;
}