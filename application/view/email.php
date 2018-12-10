<!DOCTYPE html>
<html>
<head>
    <title>Confirmación</title>
</head>
<body>
<table style="width:580px;font-size:15px;border:#0c3067 solid 1px;padding:20px 30px;background: #ffffff;">
    <tbody>
    <tr>
        <td style="color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle">
            <img style="border:0;min-height:auto;line-height:100%;outline:none;text-decoration:none;max-width:600px;min-height:auto;max-width:600px!important" src="http://aquaph9.com/public/images/logo.png" class="CToWUd">
        </td>
    </tr>
    <tr style="background-color: #d64547;">
        <td style="font-size:20px;font-weight: bold;color: #FFFFFF;padding: 5px 10px;" colspan="2">Confirmación</td>
    </tr>
    <tr>
        <td height="40" colspan="2">Gracias por su compra. Nos pondremos en contacto con usted lo mas pronto posible.</td>
    </tr>
    <tr style="background-color: #d64547;">
        <td colspan="2" style="font-size: 18px;font-weight: bold;color: #FFFFFF; padding: 5px 10px;">Datos de Comprador y Envio:</td>
    </tr>
    <tr>
    <tr>
        <td colspan="2">
            <table>
                <tbody>
                <tr>
                    <td>
                        <table>
                            <tbody>
                            <tr style="background-color: #E4E4E4;">
                                <td height="20" style="font-size: 20px;font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Código de Pedido :</span>
                                </td>
                                <td style="font-size: 20px;font-weight: bold;color: #284CA9;">
                                    <span><?php echo $rowQueryFacturaResult['vNumeroPedido'];?></span>
                                </td>
                            </tr>
                            <tr style="background-color: #E4E4E4;">
                                <td height="20" style="font-size: 20px;font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Código de Factura :</span>
                                </td>
                                <td style="font-size: 20px;font-weight: bold;color: #284CA9;">
                                    <span><?php echo $rowQueryFacturaResult['iIdFactura'];?></span>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Nombres :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vNombre'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Apellidos :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vApellido'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Telefono :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vTelefono'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Empresa :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vEmpresa'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Correo Electrónico :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vEmail'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Dirección :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vDireccionEnvio'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Observaciones :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vDireccionFactura'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Ciudad :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vCiudad'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Provincia :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vProvincia'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Código Postal :</span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo $rowQueryClienteResult['vCodigoPostal'];?></span>
                                </td>
                            </tr>
                            <tr style="background-color: #d64547;">
                                <td colspan="2" height="20" style="font-weight: bold;padding: 5px 10px;color: #FFFFFF;">
                                    Detalle de Producto:
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table style="width:500px;border:#ddd solid 1px;font-size:15px;padding:10px 40px;background:white">
                                        <tr style="font-weight: bold;color: #4D4D4D;">
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                        </tr>
                                        <?php foreach($rowQueryDetalleFacturaResult as $detalle){?>
                                            <tr style="height:30px" align="center" th:each="passenger,countIteration : ${passengers}">
                                                <td><span style="color: #102f5e"><?php echo $detalle['vNombreProducto'];?></span></td>
                                                <td><span style="color: #102f5e"><?php echo $detalle['dprecioUnitario'];?></span></td>
                                                <td><span style="color: #102f5e"><?php echo $detalle['iNumCaja'];?></span></td>
                                            </tr>


                                        <?php }
                                        ?>
                                    </table>
                                </td>
                            </tr>
                            <tr style="background-color: #d64547;">
                                <td colspan="2" height="20" style="font-weight: bold;padding: 5px 10px;color: #FFFFFF;">
                                    Detalle de pago:
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Costo de envio : </span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo '€/.'.$rowQueryFacturaResult['dCostoEnvio'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Subtotal : </span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo '€/.'.$rowQueryFacturaResult['dSubtotal'];?></span>
                                </td>
                            </tr>
                            <tr>
                                <td height="20" style="font-weight: bold;padding: 5px 10px;color: #4D4D4D;">
                                    <span>Total pagado : </span></td>
                                <td>
                                    <span style="color: #102f5e"><?php echo '€/.'.$rowQueryFacturaResult['dTotalPagar'];?></span>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="80">
                        <b>El equipo de AquaFit PH9.</b>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>