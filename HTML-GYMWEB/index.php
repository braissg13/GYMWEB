<?php
include_once __DIR__."/controller/defaultController.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GYMWEB</title>

    <!-- Bootstrap -->
    <link href="css/navbar.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

  </head>
  <body>
  <header>
  <nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <img alt="Brand" src="img/navBar/logo-gym.png">
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a id="Item1" href="#">Principal</a></li>
	        <li><a id="Item2" href="#Servicios">Servicios</a></li>
	        <li><a id="Item3" href="#dondeEstamos">&iquest D&oacutende estamos?</a></li>
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Buscar...">
	        </div>
	        <button type="submit" id="botonBuscar" class="btn btn-default">Buscar</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">

	      <form class="navbar-form navbar-left" action="controller/defaultController.php?controlador=usuario&accion=login" method="POST" class="text-left">
	      <!-- COMIENZO MODAL -->
	      	<div class="form-group">
	      		<button id="botonLogin" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Login</button>
	      		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  					<div class="modal-dialog modal-sm" role="document">
    					<div class="modal-content" id="modalLogin">
    					<!-- COMIENZO FOMRULARIO LOGIN -->
      						<div class="text-center" style="padding:50px 0">
								<div class="logo"><img alt="Login" id="imagenLogin" src="img/navBar/login.png"></div>
								<div class="login-form-1">
										<div class="login-form-main-message"></div>
										<div class="main-login-form">
											<div class="login-group">
												<div class="form-group" style="margin-bottom: 5%;">
													<label for="lg_username">Usuario</label>
													<input type="text" class="form-control" style="border-color: black;" name="username" placeholder="user">
												</div>

												<div class="form-group" style="margin-bottom: 5%;">
													<label for="lg_password">Contraseña</label>
													<input type="password" class="form-control" style="border-color: black;" name="password" placeholder="pass">
												</div>
											</div>
											<button type="submit" class="btn btn-default" style="background-color: #7CFC00; border-color: black;">Acceder</button>
										</div>
									
								</div>
							</div>
							<!-- FIN LOGIN -->
    					</div>
  					</div>
	      		</div>
	      	</div> 
	      	<!-- FIN MODAL -->
	      </form>
	      
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>

  </header>

  	<div class="container">

		 <!-- COMIENZO DEL CAROUSEL -->
		 <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
			    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			       <p style="text-align: center;"><img src="img/visitantes/pabellon-ourense.jpg" style="max-width: 100%;" alt="Pabellon"></p>
			      <div class="carousel-caption">
			      </div>
			    </div>
			    <div class="item">
			       <p style="text-align: center;"><img src="img/visitantes/sala-ourense.jpg" style="max-width: 100%;" alt="SalaMusculacion"></p>
			      <div class="carousel-caption">
			      </div>
			    </div>
			    <div class="item">
			      <p style="text-align: center;"><img src="img/visitantes/spinning.jpg" style="max-width: 100%;" alt="SalaMusculacion"></p>
			      <div class="carousel-caption">
			      </div>
			    </div>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
		</div>
		<!-- FIN DEL CAROUSEL -->

	<div class="row"><!--INICIO ROW -->
		<div id="Servicios" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1><b> Servicios </b></h1>
				<p>Ofrecemos distintos tipos de servicios, que diferenciamos como Actividades en Grupo y Actividades Individuales.</p>
		</div>		
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">	
				<h3><p><b>Actividades en Grupo: </b></p></h3>
				<p>-Spinning.</p>
				<p>-Iudo.</p>
				<p>-Pilates.</p>
				<p>-Aerobic.</p>
				<p>-Zumba.</p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<h3><p><b>Actividades Individuales: </b></p></h3>
				<p>Sala de Cardio-Fitnesss,</p>
			</div>

			<!-- DIV HORARIO-->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3><p><b>Horario: </b></p></h3>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<p><b>Septiembre a Junio: </b></p>
				<p>Lunes a Viernes de 08:30 a 23:30</p>
				<p>Sábados de 10:00 a 14:00 y de 16:00 a 21:00</p>
				<p>Domingos de 10:00 a 14:00 e de 16:00 a 20:00</p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 				<p><b>Julio, Semana Santa y Navidad: </b></p>
 				<p>Lunes a Viernes de 09:00 a 21:00</p>
 				<p>Sábados de 10:00 a 14:00 y de 16:00 a 21:00</p>
				<p>Domingos de 10:00 a 14:00 e de 16:00 a 21:00</p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<p><b>Agosto: </b></p>
 				<p>Lunes a Viernes de 09:00 a 20:30</p>
 				<p>Sábados Cerrado</p>
				<p>Domingos Cerrado</p>
			</div>

	</div> <!-- FIN ROW-->
		<div id="dondeEstamos" class="dondeEstamos">
			<h1><b> &iquest D&oacutende estamos? </b></h1>
			 <p style="text-align: center;"><b>Estamos en: </b></p>
			 <p style="text-align: center;"><b>c/ Canella da Costa da Vela</b></p>
			 <p style="text-align: center;"><b>OURENSE</b></p>
			 <p style="text-align: center;"><a href="https://www.google.es/maps/place/R%C3%BAa+Canella+da+Costa+da+Vela,+32004+Ourense/@42.3429742,-7.8512489,15z/data=!4m13!1m7!3m6!1s0xd2ffebeb1308689:0x6bd355b5adb75fb9!2sCampus+de+Ourense!3b1!8m2!3d42.3440784!4d-7.8513082!3m4!1s0xd2ffebfc1c5e20f:0x246972c27b1d8d61!8m2!3d42.3422503!4d-7.8515335" target="_blank"><img src="img/visitantes/dondeEstamos.png" style="max-width: 100%;" alt="DondeEstamos"></a></p>

		</div>

	</div>




    <footer id="footer">
    <p style="text-align: center;"><img alt="Uvigo" class="responsive-image" style="max-width: 100%;" src="img/navBar/logoUvigo.png"></p>
    <p style="text-align: center;"><a style="text-decoration: none;" href="#"><button type="button" class="btn btn-default" style="border-color: black;">Subir</button></a></p>
    </footer>

  </body>
</html>
