<?php
/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

require 'a.php';

/**
 * Función con un parámetro
 * @param $tipo Columna por la que se va a hacer el filtro.
 * @return Devuelve el array que almacena los datos filtrados.
 */
function filtrar_por_tipo($tipo) {
    $conjunto = []; //Array que almacena los datos de los archivos.
    //Primera dimesión indexa (primera fila, segunda fila, php asigna automaticamente un índice numérico), segunda dimensión asociativa (sus claves no son números).
    $subconjunto=[]; //Array que almacena los datos filtrados.
    
    cargar_archivo(__DIR__. '/datos1.csv', $conjunto); //carga el archivo 1
    cargar_archivo(__DIR__.'/datos2.csv', $conjunto); //carga el archivo 2
    
    //BUCLE FOREACHE
    //Recorre todos los elementos del array $conjunto
    foreach($conjunto as $regristro) 
    {
        if ($regristro['tipo'] === $tipo) {
            $subconjunto[] = $regristro;
        }
    }
    return $subconjunto;
}