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

	<h2>PLATAFORMA DE PAGO</h2>
    <section class="plataforma_subtitulo clearfix">
		<div class="clearfix">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding_cero metodo_pago">


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding_cero metodo_principal">
                    <b>1. Método de Pago</b>
                </div>
                
                <!--VISA-->
           	  	<div class="col-xs-6 col-sm-12 col-md-12 col-lg-12 visa_box">

                    <div class="col-xs-1 col-sm-2 col-md-2 col-lg-2 radio">
                       <label><input type="radio" name="tipoPago" id="tipoPago" value="0" checked=""></label>
                    </div>

                     <img class="col-xs-9 col-sm-9 col-md-9 col-lg-8" src="public/images/visa_logo.png">  
 
	  		    </div>

           
                <!--MASTERCARD-->
                <div class="col-xs-6 col-sm-12 col-md-12 col-lg-12 mastercard_box">

                    <div class="col-xs-1 col-sm-2 col-md-2 col-lg-2 radio">
                       <label><input type="radio" name="tipoPago" id="tipoPago" value="1"></label>
                    </div>
	  			    <img class="col-xs-9 col-sm-9 col-md-9 col-lg-8"  src="public/images/mastercard_logo.png">
	  		    </div>
                
                
                <!--TRANSFERENCIA BANCARIA-->
                <div class="col-xs-6 col-sm-12 col-md-12 col-lg-12 mastercard_box">
                   
                    <div class="col-xs-1 col-sm-2 col-md-2 col-lg-2 radio">
                       <label><input type="radio" name="tipoPago" id="tipoPago" value="1"></label>
                    </div>
                    
                    <img class="col-xs-9 col-sm-9 col-md-9 col-lg-8" src="public/images/bancaria_logo.png">
                    <p class=" col-xs-10 col-sm-9 col-md-9 col-lg-9 texto_transferencia">
                        <strong>Transferencia bancaria:</strong><br>Ingrese el dinero mediante <br> transferencia bancaria
                    </p> 
                    

	  		    </div>

            </div>

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 confirmacion-pago">

				<div class="clearfix">

                     <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 metodo_confirmacion">

				        <b>2. Confirmación de Pago</b>

                    </div>

                

				    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 confirmacion_subtotal">

				        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 subtototal_interior">

				           <p>Subtotal:<br>

                               Costo de envío:<br>

                            Un solo pago de:</p>

				        </div>

				        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 subtototal_precio">

<!--
				           <p>€/.<?=$_SESSION['total'];?><br>
                              €/.<?=number_format($_SESSION['envio'],2);?><br>
                              €/.<?=number_format($_SESSION['totalPagar'],2);?></p>
-->

				        </div> 

				        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn_finaliza_compra">
                            <input name="token" type="hidden" id="token" value="<?=$token;?>">
                            <button class="col-xs-12 col-sm-8 col-md-8 col-lg-8 buy">Finalizar Compra</button>
                        </div>

				    </div>

				    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 confirmacion_cupon">

				       

				       <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 cupo_descuento">

				           <p> <b>Cupón de descuento</b> <br> Ingresa el código de tu cupón aquí</p>

				        </div>

				        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 cupon_espacio">

                       

                        <form action="action_page.php">

                            <textarea class="col-xs-12 col-sm-12 col-md-12 col-lg-12" name="message" rows="1" cols="1">  </textarea>

                            <button class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Usar Cupón</button>

                        </form>

				          

				        </div>                    

				    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 texto_legal">
                        <p>
                            Al hacer click en “Finalizar compra” acepto los <b>
                            <a href="#" data-toggle="modal" data-target="#useTerms">Términos de Uso y Condiciones de Entrega</a></b>
                            , el Acuerdo de Privacidad, y la <b>
                            <a href="#" data-toggle="modal" data-target="#garrantyPolitics">Política de Garatía y Devoluciones.</a></b>
                        </p>
                    </div>

                    <!--tabla  -->
                    	<section class="productos_plataforma productos_box clearfix">

                            <div class="clearfix">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 box_title">

                                    <p>Tus Productos</p>

                                </div>
<!--
                                <?php
$carroFinal = $_SESSION['carroAquavida'];
for ($i = 0; $i < count($carroFinal); $i++) { ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg12 box_producto_int  <?=($i%2==0) ? 'producto_int02':''?>">
        <div>
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 product_int_img">
                <img class="col-xs-5 col-sm-12 col-md-12 col-lg-12" src="<?=$carroFinal[$i]['image'];?>">
            </div>
            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 product_int_descripcion">
                <p> <?=$carroFinal[$i]['name'];?></p>
                <p><b>€/.<?=$carroFinal[$i]['price'];?></b></p>
                <p class="tiempo_entrega"><?=$carroFinal[$i]['estimatedTime'];?></p>
                <p><b><a href="#" onclick="borrar_carro_pago(<?=$i;?>)">Eliminar</a></b></p>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 product_int_numero">
                <p>N de Cajas <?=$carroFinal[$i]['quantity'];?></p>
            </div>
        </div>
    </div>
<?php
} ?>
-->
                            </div>
                        </section>

                        



				        

            </div>
            <div id="form-hidden">
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="modal-content">
				<div class="modal-body">
					<div id="loading">
						<div class="loading-inner">
							<h3>
								<span class="glyphicon glyphicon-hourglass"></span>
							</h3>
							<h4>Se est&aacute; procesando tu
								solicitud...</h4>
							<div class="spinner">
								<div class="bounce1"></div>
								<div class="bounce2"></div>
								<div class="bounce3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		</div>
           <?php /* require("application/view/terminos-condiciones.php"); */ ?>
    </section>
</div>
<?php require("footer.php");?>