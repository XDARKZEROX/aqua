<?php $page='distribuidor';
require("application/helpers/security.php");
require("header.php");
$token = generateFormToken('form_distribuidor');
?>

    <div class="container">

		<div class="clearfix brand">

	  		<h1 class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

	  			Infórmate de lo que  necesitas para distribuir un

	  			<strong>producto exclusivo</strong>

	  		</h1>

	  		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

	  			<img class="col-xs-7 col-sm-12 col-md-12 col-lg-12" src="public/images/imagen-ser-distribuidor.png">

	  		</div>

		</div>

	</div>

</header>

<div class="divider"></div>

<div class="container main">

	<h2>¿QUIERES SER DISTRIBUIDOR?</h2>

	<p>

		En <b>AQUA PH9+</b> estamos en la búsqueda de nuevas superficies donde ofrecer nuestro producto exclusivo y que la mayor cantidad de personas se puedan beneficiar y conocer sus ventajas.

		<br><br>

		Estamos interesados en vender <b>AQUA PH9+</b> en diferentes superficies: tiendas de nutrición, gimnasios, supermercados y gasolineras, etc. Queriendo de esta forma llegar a nuestro objetivo que es el de abarcar puntos de venta en toda ESPAÑA. 

		<br><br>

		Si estás interesado en vender nuestro producto o ser un distribuidor, contáctanos y será un placer para nosotros atender a todas tus preguntas, buscando  la forma de llegar a un acuerdo. Todas las solicitudes son tratadas por nuestro departamento comercial con total seriedad y trabajando juntos para llegar al éxito.

		<br><br>

		Esperamos contar contigo para formar parte del equipo <b>AQUA PH9+</b>.

	</p>

	<form class="clearfix" name="form-distribuidor" id="form-distribuidor" method="post" action="">

		<fieldset class="col-xs-12 col-sm-4 col-md-5 col-lg-5 columna_fix">

			<fieldset>

				<label for="nombre" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Nombre:</label>

				<input type="text" name="nombre" class="input-name col-xs-12 col-sm-12 col-md-12 col-lg-12" id="nombre" placeholder="Nombre" required="required">

			</fieldset>

			<fieldset>

				<label for="email" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">E-mail:</label>

				<input type="email" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" name="email" id="email" placeholder="E-mail" required="required">

			</fieldset>

			<fieldset>

				<label for="provincia_ciudad" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Provincia o Ciudad:</label>

				<input type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" name="provincia_ciudad" id="provincia_ciudad" placeholder="Provincia o Ciudad" required="required">

			</fieldset>
			<fieldset>
				<label for="tienda" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Tienda o Distribuidor:</label>
				<input type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" name="tienda" id="tienda" placeholder="Tienda o Distribuidor:" required="required">
			</fieldset>

			<fieldset>
				<label for="telefono" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 .phone">Teléfono:</label>
				<input type="text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" name="telefono" id="telefono" placeholder="Teléfono" required="required">
			</fieldset>
		</fieldset>

		<fieldset class="col-xs-12 col-sm-8 col-md-7 col-lg-7 columna_fix">
			<fieldset>
				<label for="mensaje" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">Mensaje:</label>
				<textarea name="mensaje" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="mensaje" placeholder="Mensaje" required="required"></textarea>
				<button type="submit">Enviar</button>
			</fieldset>
			 <div class="isa_info alert alert-info" style="display: none">
                <i class="fa fa-info-circle">Se esta procesando su solicitud.</i>
            </div>
            <div class="isa_success alert alert-success" style="display: none">
                <i id="form-mark-success" class="fa fa-check"></i>
            </div>
            <div class="isa_error alert alert-danger" style="display:none">
                <i id="form-mark-error" class="fa fa-times-circle"></i>
            </div>
		</fieldset>

		<input type="hidden" name="token" value="<?=$token;?>">
	</form>
</div>

<?php require("footer.php");?>