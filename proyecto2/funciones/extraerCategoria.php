<?php

/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

/**
 * Función con dos parámetros
 * @param $datoPost Almacena la categoría enviada en el formulario.
 * @param &$errores Array pasado por referencia que almacena los mensajes de error.
 * @return Devuelve la categoría introducida por el usuario o false en caso de error.
 */
function extraerCategoriaPOST ($datoPost, &$errores) {
    // Variable que almacenará la caregoría extraida y sanitizada mediante filter_input
    $cat = filter_input (INPUT_POST, $datoPost, FILTER_SANITIZE_SPECIAL_CHARS);
    // Si esta variable es una cadena y se encuentra dentro de la lista CATEGORIAS se retorna su valor.
    if (is_string($cat) && in_array($cat, CATEGORIAS)) {
        return $cat;
    } elseif (is_string($cat) && !in_array($cat, CATEGORIAS)) { // Si no se encuentra dentro de CATEGORIAS se procesa un error.
        $errores[] = "Ha indicado una cateogoría no existente.";
    } elseif ($cat === false) { // Si no se indica la categoría se procesa un error.
        $errores[] = "No se ha indicado la categoría.";
    }
    return false;
}