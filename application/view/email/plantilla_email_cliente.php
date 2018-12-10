<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Confirmación de pedido - AquaPh9</title>
    <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        img {height: auto;}
        .content {width: 100%; max-width: 600px;}
        .header {padding: 40px 30px 20px 30px;}
        .innerpadding {padding: 30px 10px 30px 10px;}
        .borderbottom {border-bottom: 1px solid #f2eeed;}
        .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}
        .h1, .h2, .bodycopy {color: #153643; font-family: sans-serif;}
        .h1 {font-size: 28px; line-height: 38px; font-weight: bold;}
        .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}
        .bodycopy {font-size: 16px; line-height: 22px;}
        .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;}
        .button a {color: #ffffff; text-decoration: none;}
        .footer {padding: 20px 30px 15px 30px;}
        .footercopy {font-family: sans-serif; font-size: 14px; color: #ffffff;}
        .footercopy span.siguenos{margin: 10px 0 0 0;!important}

        .footercopy a {color: #ffffff; text-decoration: underline;}

        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            body[yahoo] .hide {display: none!important;}
            body[yahoo] .buttonwrapper {background-color: transparent!important;}
            body[yahoo] .button {padding: 0px!important;}
            body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}
            body[yahoo] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
        }
        /*@media only screen and (min-device-width: 601px) {
          .content {width: 600px !important;}
          .col425 {width: 425px!important;}
          .col380 {width: 380px!important;}
          }*/

    </style>
</head>
<body bgcolor="#E7EBDD" style="margin: 0; min-width: 100%!important; padding: 0;" yahoo="yahoo">
<table bgcolor="#E7EBDD" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td>
            <!--[if (gte mso 9)|(IE)]>
            <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
            <![endif]-->
            <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" class="content" style="max-width: 600px; width: 100%;">
                <tr>
                    <td bgcolor="#DEE6BD" class="header" style="padding: 40px 30px 20px 30px;">
                        <!--[if (gte mso 9)|(IE)]>
                        <table width="600" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="col425" style="max-width: 210px; width: 100%;">
                            <tr>
                                <td height="70">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td height="0" style="padding: 0 20px 20px 0;"><img alt="" border="0" class="fix" height="69" src="http://aquaph9.com/emailing/images/logo_mailing.png" style="height: auto;" width="216" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="70">
                            <tr>
                                <td height="0" style="padding: 0 20px 20px 0;">

                                <img alt="" border="0" class="fix" height="70" 
                                src="http://aquaph9.com/emailing/images/mensaje_icono.jpg" style="height: auto;">

                                </td>
                            </tr>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        <table width="425" align="left" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                        <![endif]-->
                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="col425" style="max-width: 410px; width: 100%;">
                            <tr>
                                <td height="70">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td class="h1" style="color: #153643; font-family: sans-serif; font-size: 28px; font-weight: bold; line-height: 38px; padding: 5px 0 0 0;"> CONFIRMACIÓN DE PEDIDO </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!--[if (gte mso 9)|(IE)]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>
                <tr>
                    <td class="innerpadding borderbottom" style="border-bottom: 1px solid #f2eeed; padding: 30px 10px 30px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td class="h2" style="color: #153643; font-family: sans-serif; font-size: 24px; font-weight: bold; line-height: 28px; padding: 0 0 15px 0;"> Gracias por tu pedido! </td>
                            </tr>
                            <?php if($rowQueryFacturaResult['vTipoTarjeta']=='2'){ ?>
                            <tr>
                                <td class="bodycopy" style="color: #153643; font-family: sans-serif; font-size: 16px; line-height: 22px;"> Tu pedido está a la espera hasta que confirmemos que el pago se ha recibido. <br><br> Los detalles de tu pedido se muestran debajo como referencia:<br/>
                                <br /> Para agilizar el pago por transferencia bancaria necesitaremos que realices un ingreso indicando en el concepto el número de pedido, IMPRESCINDIBLE para agilizar el envio del pedido.
                                <br><br> Una vez que haya realizado su pago envíenos el comprobante de pago a: <a href="mailto:tienda@aquaph9.com">tienda@aquaph9.com</a></td>
                            </tr>
                             <?php } else { ?>
                                <tr>
                                    <td class="bodycopy" style="color: #153643; font-family: sans-serif; font-size: 16px; line-height: 22px;"> Nos pondremos en contacto con usted lo más pronto posible.</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="innerpadding borderbottom" style="border-bottom: 1px solid #f2eeed; padding: 30px 10px 30px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <!--
                                                          <tr>
                                                            <td class="h2">
                                                              Gracias por tu pedido!
                                                            </td>
                                                          </tr>
                                              -->
                            <tr>
                                <td class="bodycopy" style="color: #153643; font-family: sans-serif; font-size: 16px; line-height: 22px;"><strong>Pedido registrado:</strong> <?=$rowQueryFacturaResult['dFechaCompra'];?> <br />
                                    <br /><strong>Medio de pago: </strong>
                                    <?php
                                    switch ($rowQueryFacturaResult['vTipoTarjeta']) {
                                        case '0':
                                            echo "<div class='payment-method'>
                                                  <img src='http://aquaph9.com/public/images/mediopago-visa.png'></div>";
                                            break;
                                        case '1':
                                            echo "<div class='payment-method'>
                                                  <img src='http://aquaph9.com/public/images/mediopago-mastercard.png'></div>";
                                            break;
                                        case '2':
                                            echo "<div class='payment-method'><b>Transferencia Bancaria</b>
                                                  <img src='http://aquaph9.com/public/images/transferencia-bancaria.png'></div>";
                                            break;
                                    }
                                    ?>
                                    <?php if($rowQueryFacturaResult['vTipoTarjeta']=='2'){ ?>
                                    <br /><strong>Nuestros detalles bancarios:</strong><br /> Alkaline Water S.L. - La Caixa <br /> ES37 2100 4864 4122 0004 9449 <br />
                                    <? } ?>
                                    <br /><strong>N° de pedido: </strong>#<?=$rowQueryFacturaResult['vNumeroPedido'];?>
                                    <br/><strong>N° de factura: </strong><?=$rowQueryFacturaResult['iIdFactura'];?><br/>
                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <td height="16" style="font-size: 10px; line-height: 10px;">
                </td>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" class="x_container" width="580">
                            <tbody>
                            <tr>
                                <td style="font-size: 10px; line-height: 10px;" width="10">
                                </td>
                                <td class="x_mobile" style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; font-weight: bold; line-height: 20px;" width="560"> Detalles del pedido</td>
                                <td style="font-size: 10px; line-height: 10px;" width="10">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <!-- DETALLE PEDIDO -->

                <?php  for($i=0;$i<count($rowQueryDetalleFacturaResult);$i++){ ?>
                    <tr>
                        <td class="innerpadding borderbottom" style="border-bottom: 1px solid #f2eeed; padding: 30px 10px 30px 10px;">
                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="200">
                                <tr>
                                    <td height="115" style="padding: 0 20px 20px 0;"><img class="avatar" alt="" border="0" class="fix" height="115" src="http://aquaph9.com/<?=$rowQueryProductoResult[$rowQueryDetalleFacturaResult[$i]['iIdProducto']]['image'];?>" style="height: auto;" width="115" /></td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                            <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>
                            <![endif]-->
                            <table align="left" border="0" cellpadding="0" cellspacing="0" class="col380" style="max-width: 340px; width: 100%;">
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td class="bodycopy" style="color: #153643; font-family: sans-serif; font-size: 16px; line-height: 22px;">  <?=$rowQueryDetalleFacturaResult[$i]['vNombreProducto']?><br />
                                                    <br />
                                                    <?=$rowQueryProductoResult[$rowQueryDetalleFacturaResult[$i]['iIdProducto']]['estimatedTime'];?>
                                                    <br />
                                                    <br /><strong>Precio:</strong> €/.<?=$rowQueryDetalleFacturaResult[$i]['dprecioUnitario']?><br /><strong>Cantidad:</strong><?=$rowQueryDetalleFacturaResult[$i]['iNumCaja'];?> </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                    </tr>
                <?php }  ?>


                <!-- tabla detalle-->
                <tr>
                    <td align="center">
                        <table bgcolor="#F7F7F7" border="0" cellpadding="0" cellspacing="0" class="x_wrapper" width="600">
                            <tbody>
                            <tr>
                                <td align="center">
                                    <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" class="x_container" width="600">
                                        <tbody>
                                        <tr>
                                            <td height="16" style="font-size: 10px; line-height: 10px;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" class="x_container" width="580">
                                                    <tbody>
                                                    <tr>
                                                        <td style="font-size: 10px; line-height: 10px;" width="10">
                                                        </td>
                                                        <td class="x_mobile" style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 16px; font-weight: bold; line-height: 20px;" width="560"> Detalles del envío</td>
                                                        <td style="font-size: 10px; line-height: 10px;" width="10">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="0" cellpadding="0" cellspacing="0" class="x_container" width="580">
                                                    <tbody>
                                                    <tr>
                                                        <td class="" style="font-size: 10px; line-height: 10px;" width="10">
                                                        </td>
                                                        <td class="x_mobile" valign="top" width="260">
                                                            <table border="0" cellpadding="0" cellspacing="0" class="x_mobile" width="260">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="x_mobile" width="260">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td height="21" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Nombre </td>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vNombre'];?></td>
                                                                            </tr>
                                                                            <tr>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Apellidos </td>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vApellido'];?></td>
                                                                            </tr>
                                                                            <tr>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Empresa</td>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vEmpresa'];?> </td>
                                                                            </tr>
                                                                            <tr>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <!--email contacto-->
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="x_mobile" width="260">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td height="21" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> E-mail de contacto</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vEmail'];?><br />
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="x_mobile" width="260">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td height="21" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Dirección de entrega</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vDireccionEnvio'];?> <br />
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="18" style="font-size: 10px; line-height: 10px;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="x_mobile" width="260">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Número de teléfono</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;">
                                                                                    <br />  <?=$rowQueryClienteResult['vTelefono'];?> </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="18" style="font-size: 10px; line-height: 10px;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Provincia</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vProvincia'];?> </td>
                                                                </tr>
                                                                <!--DISTRITO-->
                                                                <tr>
                                                                    <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Ciudad</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vCiudad'];?> </td>
                                                                </tr>
                                                                <!--codigo postal-->
                                                                <tr>
                                                                    <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Código Postal</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vCodigoPostal'];?>  </td>
                                                                </tr>
                                                                <!--codigo informacion adicional-->
                                                                <?php if(trim($rowQueryClienteResult['vDireccionFactura'])!='' || $rowQueryFacturaResult['codigo_cupon']!=null) { ?>
                                                                <tr>
                                                                    <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Informaciôn Adicional</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;"> <?=$rowQueryClienteResult['vDireccionFactura'];?></td>
                                                                </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td class="x_mobileOff" style="font-size: 10px; line-height: 10px;" width="40">
                                                        </td>
                                                        <td class="x_mobile" valign="top" width="260">
                                                            <table border="0" cellpadding="0" cellspacing="0" class="x_mobile" width="260">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="x_mobile" width="260">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td height="21" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Medio de pago</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 20px;">
                                                                                    <?php
                                                                                    switch ($rowQueryFacturaResult['vTipoTarjeta']) {
                                                                                        case '0':
                                                                                            echo 'VISA';
                                                                                            break;
                                                                                        case '1':
                                                                                            echo 'MASTERCARD';
                                                                                            break;
                                                                                        case '2':
                                                                                            echo 'Transferencia Bancaria';
                                                                                            break;
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td bgcolor="#CCCCCC" class="x_mobile_t" height="1" style="font-size: 10px; line-height: 10px;" width="260">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #333333; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 20px;"> Resumen del pedido</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Section Cupon-->
                                                                            <?php if(trim($rowQueryFacturaResult['codigo_cupon'])!='' || $rowQueryFacturaResult['codigo_cupon']!=null) { ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table border="0" cellpadding="0" cellspacing="0" class="x_mobile_t" width="260">
                                                                                            <tbody>
                                                                                            <tr>
                                                                                                <td align="left" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 21px;"> Cupón</td>
                                                                                                <td align="right" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 21px;"><span style="color:#0c3067"><?=$rowQueryFacturaResult['codigo_cupon'];?></span></td>
                                                                                            </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="10" style="font-size: 10px; line-height: 10px;">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td bgcolor="#EEEEEE" class="x_mobile_t" height="1" style="font-size: 10px; line-height: 10px;" width="260">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="10" style="font-size: 10px; line-height: 10px;">
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>




                                                                            <tr>
                                                                                <td>
                                                                                    <table border="0" cellpadding="0" cellspacing="0" class="x_mobile_t" width="260">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="left" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 21px;"> Subtotal</td>
                                                                                            <td align="right" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 21px;"> €/.<?=$rowQueryFacturaResult['dSubtotal'];?></td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                            <tr>
                                                                                <td height="10" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td bgcolor="#EEEEEE" class="x_mobile_t" height="1" style="font-size: 10px; line-height: 10px;" width="260">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table border="0" cellpadding="0" cellspacing="0" class="x_mobile_t" width="260">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="left" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 21px;"> Envío</td>
                                                                                            <td align="right" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; line-height: 21px;"> €/.<?=$rowQueryFacturaResult['dCostoEnvio'];?></td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td bgcolor="#EEEEEE" class="x_mobile_t" height="1" style="font-size: 10px; line-height: 10px;" width="260">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="10" style="font-size: 10px; line-height: 10px;">
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table border="0" cellpadding="0" cellspacing="0" class="x_mobile_t" width="260">
                                                                                        <tbody>
                                                                                        <tr>
                                                                                            <td align="left" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 21px;"> TOTAL</td>
                                                                                            <td align="right" style="color: #666666; font-family: Helvetica Neue,Arial,sans-serif; font-size: 14px; font-weight: bold; line-height: 21px;"> €/.<?=$rowQueryFacturaResult['dTotalPagar'];?></td>
                                                                                        </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td class="" style="font-size: 10px; line-height: 10px;" width="10">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="16" style="font-size: 10px; line-height: 10px;">
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#44525f" class="footer" style="padding: 20px 30px 15px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" class="footercopy" style="font-family: sans-serif;font-size: 14px;color: #ffffff;">
                                    &reg; Aqua Ph9 2017<br>

                                    ALKALINE WATER S.L. <br>
                                    B66443797 <br>
                                    Dirección:  C/ PENEDES, 49 <br>
                                    08192 – SANT QUIRZE DEL VALLES,
                                    BARCELONA
                                    <br>E-mail: info@aquaph9.com
                                </td>
                            </tr>
                            <tr>
                                <td align="center" class="footercopy" style="padding: 10px 0 0 0;font-family: sans-serif;font-size: 14px;color: #ffffff;">

                                    <span class=" siguenos" style="margin: 10px 0 0 0;!important: ;">Síguenos en redes sociales</span>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding: 10px 0 0 0;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                <a href="https://www.facebook.com/aquaph9">
                                                    <img src="http://aquaph9.com/emailing/images/facebook_icon.png" width="37" height="37" alt="Facebook" border="0" style="height: auto;">
                                                </a>
                                            </td>
                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                <a href="https://twitter.com/AquaPh9">
                                                    <img src="http://aquaph9.com/emailing/images/twitter_icon.png" width="37" height="37" alt="Twitter" border="0" style="height: auto;">
                                                </a>
                                            </td>
                                            <td width="37" style="text-align: center; padding: 0 10px 0 10px;">
                                                <a href="https://www.instagram.com/aquaph9/">
                                                    <img src="http://aquaph9.com/emailing/images/instagram_icon.png" width="37" height="37" alt="Instagram" border="0" style="height: auto;">
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
</table>
<!--analytics-->
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</body>
</html>
