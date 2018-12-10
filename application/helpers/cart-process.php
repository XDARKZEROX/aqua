<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset ($_SESSION['carroAquavida'])){
    $compras=$_SESSION['carroAquavida'];
    $product =  $_POST['product'];
    $duplicado=-1;

    for($i=0;$i<count($compras);$i++){
        if($product['code']==$compras[$i]['code']){
            $compras[$i] = $product;
            $duplicado=$i;
        }
    }

    if($duplicado==-1){
        $compras[]=$product;
    }

} else {
    $product =  $_POST['product'];
    $compras[] = $product;
}

$total = 0;
foreach($compras as $producto){
    $total+= $producto['price'] * $producto['quantity'];
}

$_SESSION['carroAquavida']=$compras;
$_SESSION['total']=number_format($total,2);
require("../../modal.php");
?>

