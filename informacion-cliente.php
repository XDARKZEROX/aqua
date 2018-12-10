<?php $page='productos';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['carroAquavida']) || !count($_SESSION['carroAquavida'])>0){
    header("location: productos-online.php");
}

require("header.php");?>

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

<div class="container main_info_cliente main">

	<form class="clearfix" name="form-owner" id="form-owner" method="post" action="plataforma_de_pago">

    <h2 class="col-xs-10 col-sm-12 col-md-12 col-lg-12 columna_fix">INFORMACIÓN DE ENVIO</h2> 

   		 <fieldset class="col-xs-10 col-sm-6 col-md-5 col-lg-6 columna_fix">
		          
			<fieldset>
				<label for="email" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">E-mail de contacto:</label>           
				<input type="email" required="required" name="email" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="email" placeholder="E-mail de contacto">           

			</fieldset>
		     
		</fieldset>
		
		<fieldset class="col-xs-10 col-sm-6 col-md-5 col-lg-6 columna_fix">
					
			<fieldset>
				<small id1="emailHelp" class="form-text text-muted col-xs-12 col-sm-12 col-md-12 col-lg-12 ">No compartiremos esta información con nadie más.</small> 
			</fieldset>

		</fieldset>

        <h2 class="col-xs-10 col-sm-12 col-md-12 col-lg-12 columna_fix">INFORMACIÓN DEL CLIENTE</h2>	

		<fieldset class="col-xs-10 col-sm-6 col-md-5 col-lg-6 columna_fix">

			<fieldset>
				<label for="nombre" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Nombre:</label>
				<input type="text" name="nombre" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-name names" id="nombre" placeholder="Nombre" required="required">
			</fieldset>
			<fieldset>
				<label for="apellido" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Apellidos:</label>
				<input type="text" required="required" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 input-name names" name="apellido" id="apellido" placeholder="Apellidos">
			</fieldset>
			<fieldset>
				<label for="empresa" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Empresa:</label>
				<input type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 empresa" name="empresa" id="empresa" placeholder="Empresa">
			</fieldset>
			<fieldset>
				<label for="telefono" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Teléfono</label>
				<input type="text" required="required" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 phone" name="telefono" id="telefono" placeholder="Teléfono">
			</fieldset>
		</fieldset>
		<fieldset class="col-xs-10 col-sm-6 col-md-5 col-lg-6 columna_fix">
			<fieldset>
				<label for="direccion" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Dirección:</label>
				<input type="text" required="required" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 direccion" name="direccion" id="direccion" placeholder="Dirección">
			</fieldset>
			<fieldset>
				<label for="provincia" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Provincia:</label>
				<input type="text" required="required" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 residencia" name="provincia" id="provincia" placeholder="Provincia">
			</fieldset>

			<fieldset class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columna_fix padding_cero">
                <fieldset class="col-xs-12 col-sm-6 col-md-6 col-lg-6 columna_fix">
                    <label for="ciudad" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">Ciudad:</label>
                    <input type="text" required="required" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 residencia" name="ciudad" id="ciudad" placeholder="Ciudad">
                </fieldset>
                <fieldset class="col-xs-12 col-sm-6 col-md-6 col-lg-6 columna_fix">
                    <label for="postalcode" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Código Postal:</label>
                    <input type="text" required="required" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 direccion" name="postalcode" id="postalcode" placeholder="Código Postal">
                </fieldset>
			</fieldset>
			
			   <!-- <input type="hidden" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 direccion" name="factura" id="factura" placeholder="Dirección de envio">-->
            

			<fieldset class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columna_fix padding_cero">
            	<label for="factura" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Información Adicional (Opcional):</label>
                <input type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 direccion" name="factura" id="factura" placeholder="Información Adicional">
            </fieldset>

		</fieldset>
		<fieldset class="col-xs-12 col-sm-8 col-md-7 col-lg-7 columna_fix">
			<fieldset><button type="submit">Enviar</button></fieldset>
		</fieldset>
	</form>

</div>



<?php require("footer.php");?>