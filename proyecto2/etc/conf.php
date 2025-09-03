<?php
/**
 * @author María Morillo Maqueda
 * @version 1.0
 */
// DEFINICIÓN DE PARÁMETROS PARA CONECTARNOS A LA BASE DE DATOS
define ('BD_HOSTNAME', '127.0.0.1');
define ('BD_PORT', 3306);
define ('BD_USER', 'root');
define ('BD_PASSWORD', '');
define ('BD_SCHEMA', 'dwes02');

// CONEXIÓN DSN
define ('BD_DSN', 'mysql:host='.BD_HOSTNAME.';port='.BD_PORT.';dbname='.BD_SCHEMA);

// LISTAS PREDEFINIDAS DE LAS CLAVES CATEGORIAS Y PROPIEDADES
define ('CATEGORIAS', ['lacteos', 'conservas', 'bebidas', 'snacks', 'dulces', 'otros']);
define ('PROPIEDADES', ['sin gluten', 'sin lactosa', 'vegano', 'orgánico', 'sin conservantes', 'sin colorantes']);