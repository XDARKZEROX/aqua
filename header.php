<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="BOTS" content="ALL">
    <title></title>
    <link rel="shortcut icon" href="resource/images/favicon.html">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/css/main.css" type="text/css">
    <link rel="stylesheet" href="public/css/callback.css" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php        ob_start();        $PJ_TOPIC = 1; $PJ_THEME = 'theme7';    ?>
</head>
<body class="<?php echo $page;?>">
<header>
    <div class="container">
        <div id="menu_principal" class="clearfix" style="">
            <div class="container">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">					    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">					      <span class="sr-only">Desplegar navegación</span>					      <span class="icon-bar"></span>					      <span class="icon-bar"></span>					      <span class="icon-bar"></span>					    </button>					</div>
                    <a class="brand clearfix pc" style="margin: 0 39px 0 0; float: none;" href="index"> <br>		                <img src="public/images/logo.png" />		            </a> <br>		            <a class="brand clearfix movil" style="margin: 0 39px 0 0; float: none;" href="index"> <br>		                <img src="public/images/logo2.png" />		                <br>		            </a>
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav">
                            <li> <a href="presentacion" class="<?php echo ($page=='index') ? 'active':''?>">Presentación</a></li>
                            <li> <a href="beneficios" class="<?php echo ($page=='beneficios') ? 'active':''?>">Beneficios</a></li>
                            <li> <a href="estudios-cientificos" class="<?php echo ($page=='estudios') ? 'active':''?>">Estudios<br/>Científicos</a></li>
                            <li> <a href="productos-online" class="<?php echo ($page=='productos') ? 'active':''?>">Productos<br/>Online</a></li>
                            <li> <a href="donde-adquirirla" class="<?php echo ($page=='adquirirla') ? 'active':''?>">Donde<br/>adquirirla</a></li>
                            <li> <a href="quieres-ser-distribuidor" class="<?php echo ($page=='distribuidor') ? 'active':''?>">Quieres ser<br/>distribuidor</a></li>
                            <li> <a href="testimonios" class="<?php echo ($page=='testimonios') ? 'active':''?>">Testimonios</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>