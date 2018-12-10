<?php
#Here is a dataBase Config

$hostname_tienda = "127.0.0.1";
$database_tienda = "aquavida";
$username_tienda = "root";
$password_tienda = "mysql";

#Production
#$hostname_tienda = "localhost";
#$database_tienda = "aquavitaeph9_cart";
#$username_tienda = "aquavitaeph9_ot";
#$password_tienda = "aQuavitAe12";

$con = mysqli_connect($hostname_tienda,$username_tienda,$password_tienda,$database_tienda) or die("Error de conexiòn con la Base de Datos" . mysqli_error($con));
mysqli_select_db($con,$database_tienda) or die ("No se encuentra la base de datos especificada");


/**
NOTAS DE PASE A PRODUCCION:
 * ACTUALIZAR CREDENCIALES DE BASE DE DATOS
 * CONFIG.PHP
 * HTACCESS
 * 'MerchantURL' => 'http://localhost/test/process.php', de Pago.php
 */