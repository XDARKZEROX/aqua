<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['carroAquavida']) || !count($_SESSION['carroAquavida'])>0){
    header("location: productos-online");
    exit();
}
if(!isset($_SESSION['token'])){
    header("location: productos-online");
    exit();
}
$page='productos';
include("application/config/mailer.php");
include("application/config/Database.php");
$logger = new Katzgrau\KLogger\Logger(__DIR__.'/logs');
mysqli_set_charset($con,"utf8");
mysqli_select_db($con, $database_tienda) or die ("No se encuentra la base de datos especificada");

    $queryFactura = "SELECT * FROM tbFactura where vNumeroPedido='" . $_SESSION['token'] . "'";
    $queryFacturaResult = mysqli_query($con, $queryFactura);
    //Array con el resultado de tbFactura
    $rowQueryFacturaResult = mysqli_fetch_array($queryFacturaResult, MYSQLI_ASSOC);
	
	if(!count($rowQueryFacturaResult)>0) {
        header("location: productos-online");
        exit();
    }

	$queryCliente = "SELECT * FROM tbCliente where iIdCliente='" . $rowQueryFacturaResult['iIdCliente'] . "'";
    $queryClienteResult = mysqli_query($con, $queryCliente);
    //Array con el resultado de tbCliente
    $rowQueryClienteResult = mysqli_fetch_array($queryClienteResult, MYSQLI_ASSOC);

    $queryDetalleFactura = "select * from tbDetalleFactura where iIdFactura='" . $rowQueryFacturaResult['iIdFactura'] . "'";
    $queryDetalleFacturaResult = mysqli_query($con, $queryDetalleFactura);
    while ($row = mysqli_fetch_assoc($queryDetalleFacturaResult)) {
        $rowQueryDetalleFacturaResult[] = $row;
    }

    $queryProductos = "select * from producto";
    $queryProductosResult = mysqli_query($con, $queryProductos);
    while ($row = mysqli_fetch_assoc($queryProductosResult)) {
        $rowQueryProductoResult[$row['code']] = $row;
    }

    mysqli_close($con);
    $mail->From = 'tienda@aquaph9.com';
    $mail->FromName = 'AquaFit PH9';
    $mail->addAddress($rowQueryClienteResult['vEmail']);     // Add a recipient
    //$mail->addBCC('tienda@aquaph9.com');
    ob_start();
    include('application/view/email/plantilla_email_comprador.php');
    $mail->Body = ob_get_contents();
    ob_end_clean();
    $mail->Subject = 'Confirmación de Compra';
    $mail->isHTML(true);
    $send = $mail->send();
    if($send)
        $logger->info('Envio de correo del pedido: '.$rowQueryFacturaResult['vNumeroPedido'].' al comprador enviado correctamente.');
    else
        $logger->info('Envio de correo del pedido: '.$rowQueryFacturaResult['vNumeroPedido'].' al comprador no se pudo enviar');

    //Another send
    $mail->clearAddresses();
	$mail->addAddress('tienda@aquaph9.com');
    ob_start();
    include('application/view/email/plantilla_email_cliente.php');
    $mail->Body = ob_get_contents();
    ob_end_clean();
    $send = $mail->send();

    unset($_SESSION['token']);
    if($send)
        $logger->info('Envio de correo del pedido: '.$rowQueryFacturaResult['vNumeroPedido'].' al cliente enviado correctamente.');
    else
        $logger->info('Envio de correo del pedido: '.$rowQueryFacturaResult['vNumeroPedido'].' al cliente no se pudo enviar');

require("header.php");		
?>
    <div class="container">
        <div class="clearfix brand">
            <h1 class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

                Adquiere nuestros productos 

                <strong>vía online</strong>

            </h1>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                <img class="col-xs-7 col-sm-12 col-md-12 col-lg-12" src="public/images/adquirir_producto.png">

            </div>

        </div>

    </div>

</header>

<div class="divider"></div>

<div class="container main">

    <h2>CONFIRMACIÓN DEL PEDIDO</h2>
       <p>
        <b>Gracias, tu pedido a sido recibido.</b><br><br>

        <b>Numero de pedido:</b> #<?=$rowQueryFacturaResult['vNumeroPedido'];?> <br>
        <b>Fecha:</b> <?=$rowQueryFacturaResult['dFechaCompra'];?> <br>
        <b>Total:</b> <?=$rowQueryFacturaResult['dTotalPagar'];?> €  <br>
        <b>Método de pago:</b> Transferencia Bancaria <br> <br>

        Para realizar el pago por transferencia bancaria necesitaremos que realices un ingreso indicando en el concepto el numero de pedido.
        <br>IMPRESCINDIBLE para agilizar el envio del pedido. <br><br> 
        Una vez que haya realizado su pago envíenos el comprobante de pago a: <a href="mailto:tienda@aquaph9.com">tienda@aquaph9.com</a>

        <br>
        <b>Nuestros detalles Bancarios:</b> <br>

        Alkaline Water S.L. - La Caixa
        ES37 2100 4864 4122 0004 9449 <br><br>
    </p>
   
<section class="plataforma_subtitulo clearfix">
    <div class="clearfix">

        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 confirmacion_pedido">
            <div class="clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pedido_confirmacion">
                    <b>Detalles del pedido</b>
                </div>



                <!--tabla  -->
                <section class="productos_pedido productos_box clearfix">

                    <div class="clearfix">

                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg10 box_title">

                    <p>Tus Productos</p>

                    </div>

                    <!--here-->
                    <?php for($i=0;$i<count($rowQueryDetalleFacturaResult);$i++){ ?>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg10 box_producto_int <?=($i%2==0) ? 'producto_int02':''?>">
                            <div>
                                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 product_int_img">
                                    <img class="col-xs-5 col-sm-12 col-md-12 col-lg-12" src="<?=$rowQueryProductoResult[$rowQueryDetalleFacturaResult[$i]['iIdProducto']]['image'];?>">
                                </div>
                                <div class="col-xs-8 col-sm-6 col-md-7 col-lg-7 product_int_descripcion">
                                    <p> <?=$rowQueryDetalleFacturaResult[$i]['vNombreProducto']?></p>
                                    <p><b>€/.<?=$rowQueryDetalleFacturaResult[$i]['dprecioUnitario']?></b></p>
                                    <p class="tiempo_entrega"><?=$rowQueryProductoResult[$rowQueryDetalleFacturaResult[$i]['iIdProducto']]['estimatedTime'];?></p>
                                    <p>
                                </div>
                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 product_int_numero">
                                    <p>N de Cajas <?=$rowQueryDetalleFacturaResult[$i]['iNumCaja'];?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!--here-->
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
</div>
<?php require("footer.php");?>