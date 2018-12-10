<?php /*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['carroAquavida']) || !count($_SESSION['carroAquavida'])>0){
    header("location: productos-online.php");
}
$page='productos';
require("header.php");
require "application/helpers/CryptoSecureRandom.php";
$precio_total = 0.00;
if(isset($_POST['email'])){
    $cliente = $_POST;
    $_SESSION['owner'] = $cliente;
}

if(isset($_SESSION['carroAquavida'])) {
    $compras = $_SESSION['carroAquavida'];

    if (isset($_POST['id3'])) {
        $id = $_POST['id3'];
        unset($compras[$id]);
        $compras = array_values($compras);
    }

    if(!$compras>0){
        $_SESSION['envio']= number_format(0,2);
        $_SESSION['totalPagar'] =  number_format(0,2);
    }

    //Actualizo el precio
    foreach ($compras as $producto) {
        $precio_total += $producto['price'] * $producto['quantity'];
    }
    $_SESSION['total'] = number_format($precio_total, 2);
    $_SESSION['carroAquavida'] = $compras;
}

$token = getToken();
*/
?>
<?php $page='productos';?>
<?php require("header.php");?>
   
   
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

        <b>Numero de pedido:</b> #837 <br>
        <b>Fecha:</b> 2 de diciembre de 2016 <br>
        <b>Total:</b> 24,00€  <br>
        <b>Método de pago:</b> Transferencia Bancaria <br> <br>

        Para realizar el pago por transferencia bancaria necesitaremos que realices un ingreso indicando en el concepto el numero de pedido, IMPRESCINDIBLE para agilizar el envio del pedido. <br><br>

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

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box_title">

                    <p>Tus Productos</p>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg12 box_producto_int  producto_int02">
                    <div>
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 product_int_img">
                    <img class="col-xs-5 col-sm-12 col-md-12 col-lg-12" src="public/images/products/producto_1-litro.jpg">
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 product_int_descripcion">
                    <p> Aqua PH9 1L</p>
                    <p><b>€/.24.00</b></p>
                    <p class="tiempo_entrega">Tiempo de entrega: 48/72 horas hábiles.<br><b>(Envíos solo a Península, no enviamos a Baleares, Canarias, Ceuta ni Melilla)</b></p>

                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 product_int_numero">
                    <p>N de Cajas 1</p>
                    </div>
                    </div>
                    </div>
                    </div>
                </section>


            </div>


        </div>

    </div>
</section>
                        
                        
                        
                        
 
</div>
<?php require("footer.php");?>