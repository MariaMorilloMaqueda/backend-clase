<?php
/**
 * @author María Morillo Maqueda
 * @version 1.0
 */

/**
 * Función con dos parámetros
 * @param $nombreArchivo Donde se escribe el nombre del archivo.csv a leer.
 * @param $datos Array que almacena los datos de los archivos.csv 
 * @return Devuelve el array creado.
 */
function cargar_archivo($nombreArchivo, &$datos = []) { //En este caso se ha usado cabecera en los archivos.csv pero se podría haber hecho añadiendo la cabecera al array $datos
    $archivo = fopen($nombreArchivo, "r");
    
    //ESTRUCTURA CONDICIONAL
    //Sólo si el archivo no es falso se procederá a la lectura.
    if($archivo !== false) {
        $cabecera = [];
        while (($fila = fgetcsv($archivo)) !== false) {
             if (empty($cabecera)) {
                 $cabecera=$fila; continue;
             }
             $datos[]=array_combine($cabecera,$fila);
        }
        fclose($archivo);
    }
    return $datos; //Array bidimensional que almacena los datos de los archivos.
    //Primera dimesión indexa (primera fila, segunda fila, php asigna automaticamente un índice numérico), segunda dimensión asociativa (sus claves no son números).
}