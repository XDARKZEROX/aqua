<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page='productos';
$precio_total = 0.00;
$precio_envio = 3.00;
if(isset($_SESSION['carroAquavida'])) {
    $compras=$_SESSION['carroAquavida'];

    if (isset($_POST['codeUpdate'])) {
        for ($i = 0; $i < count($compras); $i++) {
            if ($compras[$i]['code'] == $_POST['codeUpdate']) {
                $compras[$i]['quantity'] = $_POST['newQuantity'];
            }
        }
        $_SESSION['carroAquavida'] = $compras;
    }

    if(isset($_POST['id3'])) {
        $id = $_POST['id3'];
        unset($compras[$id]);
        $compras = array_values($compras);
    }

    //Actualizo el precio
    foreach ($compras as $producto) {
        $precio_total += $producto['price'] * $producto['quantity'];
    }
    $_SESSION['total'] = number_format($precio_total, 2);
    $_SESSION['carroAquavida'] = $compras;
} else {
    header("location: productos-online.php");
}
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

    <h2>CARRO DE COMPRAS</h2>



    <section class="carro_box productos_box clearfix">

        <div class="clearfix">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 continuar_comprando agregar">
            <a href="productos-online.php"><button class="col-xs-5 col-sm-3 col-md-2 col-lg-2">Continuar comprando</button></a>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 criterio_tabla_carrito">

            <div class="table-responsive">

            <table class="table criterios_producto">
                <thead>
                        <tr>
                        <th class="titulo_producto" colspan="2">Producto</th>
                        <th>Tiempo Estimado</th>
                        <th>Precio</th>
                        <th>N° de Cajas</th>
                        <th class="subtotal_superior">SubTotal</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
            </table>

            <?php
$compras = $_SESSION['carroAquavida'];
for($i=0;$i<count($compras);$i++){ ?>

    <table class="table producto_detalle  <?=($i%2==0) ? 'agregar_producto':''?>">
        <tr>
            <td class="producto-interior_carrito">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 img_carrito">
                    <img class="col-xs-12 col-sm-12 col-md-12 col-lg-12" src="<?=$compras[$i]['image'];?>">
                </div>

                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-lg-8 texto_carrito">
                    <?=$compras[$i]['name'];?>
                    <p class="texto_producto"><?=$compras[$i]['description'];?></p>
                </div>
            </td>
            <td class="tiempo_entrega"><?=$compras[$i]['estimatedTime'];?></td>
            <td class="subtotal">€/. <?=$compras[$i]['price'];?></td>
            <td class="numero_cajas">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-12 numero_cajas">
                    <input type="number" onchange="updatePrice(<?=$compras[$i]['code'];?>)"name="newQuantity_<?=trim($compras[$i]['code']);?>" id="newQuantity_<?=trim($compras[$i]['code']);?>" min="1" max="50" class="col-xs-10 col-sm-10 col-md-10 col-lg-6"  value="<?php echo $compras[$i]['quantity'];?>">
                </div>
            </td>
            <td class="subtotal">€/.<?=number_format($compras[$i]['quantity'] * $compras[$i]['price'],2);?></td>
            <td> <button type="button" class="btn  btn-sm dropdown-toggle" onclick="borrar_carro(<?=$i;?>)">
                    <span class="glyphicon glyphicon-remove-sign fa-lg" aria-hidden="true"></span>
                </button>
            </td>
        </tr>

    </table>

<?php } ?>
            <!-- DIVISION -->

            </div>

            </div>

        </div>

    </section>

    <section>

        <div class="clearfix">

<!--            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="agregar_cupon"><span>Agregar Cupón:</span></div>

            </div>-->

            

            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 resumen_carrito">

            <br>

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 no_padding">

                <div class="agregar_cupon">

                <p>Subtotal: <br>

                Costo de envío: <br>

                Un solo pago de: <br>

                </div>

                </div>



                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

                <div class="agregar_cupon">

                <p>€/.<?=(isset($_SESSION['carroAquavida'])) ? $_SESSION['total'] : '0.00'?>
                <br>
                <?php
$cantProductos = 0;
$costo_envio = 0.00;
$aplica_costo_cero=false;
foreach($_SESSION['carroAquavida'] as $productCore){
     if($productCore['code']!=101 && $productCore['code']!=104){ //Si es 102 o 103
        $aplica_costo_cero=true;
    } else {
        $cantProductos+=$productCore['quantity'];
    }
}

if($aplica_costo_cero=true){
    if($cantProductos>0){
        if($cantProductos<=1){
            $costo_envio = $precio_envio;
        }
    }
}

$_SESSION['envio']=$costo_envio;
echo '€/.'.$_SESSION['envio'];

?>
                <br>
                <?php
$totalPagar = 0.00;
$_SESSION['totalPagar']=number_format($_SESSION['total']+$_SESSION['envio'],2);
echo '€/.'.$_SESSION['totalPagar'];
?>
                </p>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 continuar_comprando productos_box pagar">
                    <a href="informacion-cliente"><button class="col-xs-5 col-sm-6 col-md-7 col-lg-12" <?=(count($_SESSION['carroAquavida'])<=0) ? 'disabled' : ''?>>
                    PAGAR</button></a>
                </div>
            </div>

        </div> 

    </section>
</div>
<?php require("footer.php");?>