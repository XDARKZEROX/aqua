<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require("application/controller/apiRedsys.php");
include("application/config/mailer.php");
include("application/config/Database.php");
mysqli_set_charset($con,"utf8");
$logger = new Katzgrau\KLogger\Logger(__DIR__.'/logs');

try
{
    // Se crea Objeto
    $redsysAPI = new RedsysAPI;

    if (!empty( $_POST ) ) {//URL DE RESP. ONLINE

        $version = $_POST["Ds_SignatureVersion"];
        $datos = $_POST["Ds_MerchantParameters"];
        $signatureRecibida = $_POST["Ds_Signature"];
        $decodec = $redsysAPI->decodeMerchantParameters($datos);
        $kc = 'JJDCdeEA9P3J5Ai0x3SLTZA8fMuFy6gO'; //Clave recuperada de CANALES

        $firma = $redsysAPI->createMerchantSignatureNotif($kc,$datos);

        if ($firma === $signatureRecibida){

            $data_array = json_decode($decodec, true);
            $logger->info($data_array['Ds_Order']);
            $Ds_Response = $data_array['Ds_Response']; //codigo de respuesta
            $Ds_Order = $data_array['Ds_Order']; //numero de orden

            if (((int)$Ds_Response < 0) || ((int)$Ds_Response > 99)) {
                $logger->info('El pedido con codigo:  '.$Ds_Order.' se le ha denegado el pago');
            } else {
                mysqli_select_db($con, $database_tienda) or die ("No se encuentra la base de datos especificada");
                $queryUpdateStatus = "update tbFactura set vEstadoPedido=1 where vNumeroPedido='" . $Ds_Order . "';";
                if (mysqli_query($con, $queryUpdateStatus)) {

                    $queryFactura = "SELECT * FROM tbFactura where vNumeroPedido='" . $Ds_Order . "'";
                    $queryFacturaResult = mysqli_query($con, $queryFactura);
                    //Array con el resultado de tbFactura
                    $rowQueryFacturaResult = mysqli_fetch_array($queryFacturaResult, MYSQLI_ASSOC);

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
                    if($send)
                        $logger->info('Envio de correo del pedido: '.$rowQueryFacturaResult['vNumeroPedido'].' al cliente enviado correctamente.');
                    else
                        $logger->info('Envio de correo del pedido: '.$rowQueryFacturaResult['vNumeroPedido'].' al cliente no se pudo enviar');

                } else {
                    $logger->info(mysqli_error($con));
                }

            }
        } else {
            $logger->info('Firmas no coindieron para la orden: '.$_POST['Ds_Order']);
        }

    }else {
        $logger->info('No se recibio nada por POST');
    }
}
catch(Exception $e)
{
    $logger->info($e->getMessage());
}