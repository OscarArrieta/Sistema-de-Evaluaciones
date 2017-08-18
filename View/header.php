
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Tims Performance</title>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/demo.css">
	      <link rel="stylesheet" href="assets/css/footer-distributed.css">
				<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">        
	</head>
    <body>
<nav class="navbar navbar-default" role="navigation">
<div class="container">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="?c=evaluacion"><b>Tims performance</b></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <?php if(!isset($_SESSION["usu_codigo"])):?>

    <?php else:?>
      <li><a href="?c=login&a=index">SALIR</a></li>
    <?php endif;?>
    </ul>

  </div><!-- /.navbar-collapse -->
</div>
</nav>
    <div class="container">
