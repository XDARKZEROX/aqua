<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "transactionController.php";
require("../config/Database.php");
$params= require_once('../Data/config.php');

if(empty($_SESSION['owner']['email']) || $_SESSION['owner']['email']== null){
    header("location: ../../informacion-cliente");
    exit();
}

if(isset($_POST['token'])) {
    grabarTransaccion($_POST['token'],$_POST['tipoPago'],$con, $params);
} else if(isset($_POST['cupon'])){
    validateCupon($con);
} else {
    header("location: ../../productos-online");
    exit();
}

function grabarTransaccion($token,$tipoPago,$con, $params){
    $compras = $_SESSION['carroAquavida'];
    //procedemos a insertar a la base de datos
    //Insertamos a Base de Datos
    //Insert a tabla cliente
    foreach ($_SESSION['owner'] as $key=>$value){
        $_SESSION['owner'][$key]=mysqli_real_escape_string($con,$value);
        $_SESSION['owner'][$key]= cleanString($value);
    }

    $cupon = '';
    if(isset($_SESSION['cupon'])){
        $cupon = $_SESSION['cupon']['codigo'];
    }

    $queryCliente = "INSERT INTO tbCliente ( vEmail,vNombre,vApellido,vEmpresa,vTelefono,vProvincia,vCiudad,vCodigoPostal,vDireccionEnvio,vDireccionFactura)
						 VALUES ('".$_SESSION['owner']['email']."','".$_SESSION['owner']['nombre']."',
						 '".$_SESSION['owner']['apellido']."','".$_SESSION['owner']['empresa']."','".$_SESSION['owner']['telefono']."',
						 '".$_SESSION['owner']['provincia']."','".$_SESSION['owner']['ciudad']."','".$_SESSION['owner']['postalcode']."',
						 '".$_SESSION['owner']['direccion']."','".$_SESSION['owner']['factura']."')";
    if(mysqli_query($con, $queryCliente)){
        $idtbCliente= mysqli_insert_id($con);
    }

    //estado pedido 0: pendiendte
    //  1: pagado
    //Insert a tabla factura
    $queryFactura="INSERT INTO tbFactura (vNumeroPedido,iIdCliente,dCostoEnvio,dSubtotal,dTotalPagar,dFechaCompra,vIdenComercio,vTipoTarjeta,vEstadoPedido, codigo_cupon)
						 VALUES ('".$token."','".$idtbCliente."','".$_SESSION['envio']."','".$_SESSION['total']."','".$_SESSION['totalPagar']."','".date('Y-m-d')."','333704609','".$tipoPago."','0','".$cupon."')";

    if(mysqli_query($con, $queryFactura)){
        $idtbFactura= mysqli_insert_id($con);
    }

    for($i=0;$i<=count($compras)-1;$i++){
        $queryDetalleFactura = "INSERT INTO tbDetalleFactura ( iIdFactura,iIdProducto,iNumCaja,vNombreProducto,dprecioUnitario)
						 VALUES ('".$idtbFactura."','".$compras[$i]['code']."','".$compras[$i]['quantity']."','".$compras[$i]['name']."','".$compras[$i]['price']."')";
        mysqli_query($con, $queryDetalleFactura);
    }

    // Cerramos la conexion con la base de datos
    mysqli_close($con);
    if(isset($_SESSION['cupon'])) {
        unset($_SESSION['cupon']);
    }
    if($tipoPago!='2'){
        procesarPago($params, $token);
    }
}

function procesarPago($params, $token){

    $TPV = new transactionController($params);
    $TPV->setFormHiddens(array(
        'TransactionType' => '0',
        'MerchantData' => 'Alkaline water S.L.',
        'Order' => $token,
        'Amount' => $_SESSION['totalPagar'],
        'UrlOK' => 'http://aquaph9.com/',
        'UrlKO' => 'http://aquaph9.com/',
        'MerchantURL' => 'http://aquaph9.com/process.php',
        'PayMethods' => 'C',
        'ProductDescription' => 'Compra de productos de Aquafit ph9'
    ));

    echo "<form id='redsys-form' name='redsys-form' action='".$TPV->getPath('/realizarPago')."' method='post' style='display:none'>
        ".$TPV->getFormHiddens()."<input type='submit'> </form>";
}

function cleanString($text) {
    $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
		"/'/" => ' '
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $text);
}

function validateCupon($con){

    $query_cupones = "SELECT * FROM tbcupon where status='1' ";
    $list_cupones = mysqli_query($con, $query_cupones);
    $isValid = 0;

    $cupon = $_POST['cupon'];
    while ($row = mysqli_fetch_assoc($list_cupones)){
        if(trim($cupon) === $row['codigo']){
            $_SESSION['cupon']['codigo'] = $row['codigo'];
            $_SESSION['cupon']['desc'] = $row['porc_desc'];
            $_SESSION['cupon']['isUsed'] = true;
            $isValid = 1;
        }
    }
    echo $isValid;
}
