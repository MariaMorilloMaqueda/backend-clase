<?php

// DECLARACIÓN DE VARIABLES
//Definicación de variables para cookies
$tipos_mascota;
$hash_recibido;

//Definición de variables
$errors = [];
$notifs = [];

//Variables auxiliares
$tipos_invalidos;
$tipos_seleccionados;
$mascotas_seleccionadas;

/*- Si se recibe el dato POST de restablecer preferencias, borra las cookies (tiempo negativo) 
y retorna todos los tipos de mascotas.*/
if (isset($_POST['restablecer'])) {
  setcookie('tipos_mascotas_MMM', '', time() - 10000);
  setcookie('hash_tipos_mascotas_MMM', '', time() - 10000);
  $notifs[] = "Se han reestablecido las preferencia: mostrando todos los tipos de mascota.";

  return TIPOS_DE_MASCOTAS;
}

/*- Si se reciben datos POST, recoge dichos datos, analiza si son correctos y si son correctos: envía 
las cookies y retorna los tipos de mascotas seleccionados. La duración máxima de la cookie: 10 minutos.*/
if (isset($_POST['tipos']) && is_array($_POST['tipos'])) {
  $tipos_seleccionados = array_intersect($_POST['tipos'], TIPOS_DE_MASCOTAS);

  // Validar que todos los tipos seleccionados están en la lista de TIPOS_DE_MASCOTAS
  $tipos_invalidos = array_diff($tipos_seleccionados, TIPOS_DE_MASCOTAS);

  if (!empty($tipos_invalidos)) {
    $errors[] = "Tipo de mascota no válido.";
    return TIPOS_DE_MASCOTAS;
  } else if (empty ($tipos_seleccionados)) {
    $errors[] = "Debe seleccionar al menos un tipo de mascota.";
    return TIPOS_DE_MASCOTAS;
  } else {
    setcookie('tipos_mascotas_MMM', serialize($tipos_seleccionados), time() + 600);
    setcookie('hash_tipo_mascotas_MMM', hash('sha256', serialize($tipos_seleccionados).SALTEADO), time() + 600);
    $notifs[] = "Se han guardado las preferencia: mostrando los tipos de mascota seleccionados.";
    return $tipos_seleccionados;
  }
}

/*- Si no se reciben datos POST, se analizan las cookies, y si son correctas se retornan los tipos de 
mascotas almacenados en la cookie.*/
if (isset($_COOKIE['tipo_mascotas_MMM']) && isset($_COOKIE['hash_tipo_mascotas_MMM'])) {
  $tipos_mascota = $_COOKIE['tipo_mascotas_MMM'];
  $hash_recibido = $_COOKIE['hash_tipo_mascotas_MMM'];

  if (hash('sha256', serialize($tipos_seleccionados).SALTEADO) === $hash_recibido) {
    $mascotas_seleccionadas = unserialize($tipos_mascota);
    return $mascotas_seleccionadas;

    if (is_array($mascotas_seleccionadas) && !array_diff($mascotas_seleccionadas, TIPOS_DE_MASCOTAS)) {
      return TIPOS_DE_MASCOTAS;
    }
  }
  $errors[] = "Las cookies han sido manipuladas.";
}

/*- Si no se recibe ni datos POST ni COOKIES, se retornan todos los tipos de mascotas (valor por defecto)*/
return TIPOS_DE_MASCOTAS;

/*
IMPORTANTE:
- Recuerda que todos los tipos de mascotas están almacenados en la constante TIPOS_DE_MASCOTAS
- No debe usarse echo ni print ni nada similar en este script.
- Añade a $errors[] cualquier texto que quieras mostrar como error (se mostrará a través de msgs.php, 
incluido en listarmascotas.php)
- Añade a $notifs[] cualquier mensaje a mostrar al usuario (se mostrará a través de msgs.php, incluido
en listarmascotas.php)
*/
