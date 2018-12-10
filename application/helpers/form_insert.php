<?php
require dirname(__FILE__) . '/..' . '/config/mailer.php';
$response = array(
    "code" => 0,
    "message" => "Error inesperado"
);

if($_POST['token']!=null){
    $params = $_POST;
	$mail->From = $_POST['email'];
    $mail->FromName = $_POST['nombre'];
    $mail->Subject = 'Informacion de nuevo Distribuidor';
    $mail->addAddress('comercial@aquaph9.com');     // Add a recipient
	ob_start();
    include('../view/solicitud-distribuidor.php');
    $mail->Body = ob_get_contents();
    ob_end_clean();



   /* $body = '<table>
  <tr>
    <th>Nombre</th>
    <th>Email</th>
    <th>Provincia</th>
    <th>Tienda</th>
    <th>Telefono</th>
  </tr>
  <tr>
     <td>'.$_POST['nombre'].'</td>
	 <td>'.$_POST['email'].'</td>
	 <td>'.$_POST['provincia_ciudad'].'</td>
	 <td>'.$_POST['tienda'].'</td>
	 <td>'.$_POST['telefono'].'</td>
  </tr>
  <tr>
    <td colspan="5">Mensaje</td>
  </tr>
  <tr>
    <td colspan="5">'.$_POST['mensaje'].'</td>
  </tr>
</table>';*/

    $mail->isHTML(true);
    if(!$mail->Send()) {
        $response['message'] = "Ocurrió un error al momento de enviar el correo.";
        $response['code'] = 0;
    } else {
        $response['message'] = "Su solicitud fue enviada con éxito!.";
        $response['code'] = 1;
    }
    // Clear all addresses and attachments for next loop
    $mail->ClearAddresses();
    $mail->ClearAttachments();
    echo json_encode($response);
}







