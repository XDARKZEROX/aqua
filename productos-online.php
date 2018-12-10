<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$page='productos';
require("header.php");
//session_destroy();
include("application/config/Database.php");
mysqli_set_charset($con,"utf8");
$query_listado = "SELECT * FROM producto where estado='1' ";

if(isset($_SESSION['carroAquavida']) ){
    $compras=$_SESSION['carroAquavida'];

    if(isset($_POST['id3']))  {
    	$id=$_POST['id3'];
        unset($compras[$id]);
        $compras = array_values($compras);
    }

    $total = 0;
    foreach($compras as $producto){
        $total+= $producto['price'] * $producto['quantity'];
    }

    $_SESSION['carroAquavida']=$compras;
    $_SESSION['total']=number_format($total,2);
}
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

	<h2>PRODUCTOS</h2>

<div id="modal-contenedor">
<?php require("modal.php");?>
</div>

<!-- HASTA AQUI LLEGA EL MODAL -->
    <?php
    if ($resultado = mysqli_query($con, $query_listado)) {
        while ($row = mysqli_fetch_assoc($resultado)) { ?>

	<section class="productos_box clearfix">

		<div class="clearfix">

			<div class="col-xs-12 col-sm-5 col-md-3 col-lg-3">

				<img class="col-xs-5 col-sm-12 col-md-12 col-lg-12" src="<?=$row['image'];?>">

			</div>

			<div class="col-xs-12 col-sm-7 col-md-9 col-lg-9">

				<b><?=$row['title'];?></b>

				<p><?=$row['description'];?><br>

			</div>

		</div>

		<div class="clearfix">

			<div class="col-xs-12 col-sm-5 col-md-3 col-lg-3">

			</div>

			<div class="col-xs-12 col-sm-7 col-md-9 col-lg-9">

				<div class="precio">

					<strong><span>€/.</span><?=$row['price'];?></strong>

				</div>

				<div class="clearfix">

					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 numero_cajas">

						<p class="col-xs-9 col-sm-8 col-md-8 col-lg-7">Seleccionar el N° de cajas</p>

						<input min="1" max="50" name="quantity-<?=$row['code'];?>" id="quantity-<?=$row['code'];?>" type="number" class="col-xs-3 col-sm-4 col-md-4 col-lg-2" value="1">

					</div>

					<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 agregar">

						<button data-button="<?=$row['code'];?>" class="col-xs-12 col-sm-8 col-md-5 col-lg-5 btn-add-product">Agregar</button>

					</div>

				</div>

			</div>
            <div class="product-<?=$row['code'];?>">
            <input name="code" type="hidden" id="code" value="<?=$row['code'];?>">
            <input name="image" type="hidden" id="image" value="<?=$row['image'];?>">
            <input name="name" type="hidden" id="name" value="<?=$row['title'];?>">
            <input name="price" type="hidden" id="price" value="<?=$row['price'];?>">
            <input name="description" type="hidden" id="description" value="<?=$row['description'];?>">
            <input name="estimatedTime" type="hidden" id="estimatedTime" value="<?=$row['estimatedTime'];?>">
            </div>
        </div>


	</section>
    <?php  }
        }
    ?>
</div>
<?php require("footer.php");?>