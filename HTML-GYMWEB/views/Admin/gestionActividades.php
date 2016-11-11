<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GYMWEB</title>

    <!-- Bootstrap -->
    <link href="../../css/navbar.css" rel="stylesheet">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>

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
	      <img alt="Brand" src="../../img/navBar/logo-gym.png">
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a id="Item1" href="#">Principal</a></li>
	        <li><a id="Item2" href="gestionUsuarios.html">Gesti&oacuten de Usuarios</a></li>
	        <li><a id="Item3" href="gestionActividades.html">Gesti&oacuten de Actividades</a></li>
	        <li><a id="Item4" href="gestionEjercicios.html">Gesti&oacuten de Ejercicios</a></li>
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Buscar...">
	        </div>
	        <button type="submit" id="botonBuscar" class="btn btn-default">Buscar</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">


	       <!-- COMINENZO VER PERFIL -->
	       <li class="dropdown">
	          <a href="#" id="drop" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil <span class="caret"></span></a>
	          <ul id="ulDrop" class="dropdown-menu">
	            <li><a id="aVerPerf" href="#">Ver perfil</a></li>
	            <li><a id="aModificarPerf" href="#">Modificar perfil</a></li>
	            <li id="separador" role="separator" class="divider"></li>
	            <li><a href="#" id="aCerrarSesion">Cerrar Sesi&oacuten</a></li>
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>

  </header>

  	<div class="container">
		 <!-- --------------------------- ----------------EDITAR TODALA VISTA DENTRO DE ESTE DIV ----------------------- -->

     <h1>Actividades</h1>
     <!-- Actividades creadas y botones para crear/borrar/modificar-->

     <div class="row" style="margin-top: 20px; margin-bottom: 10px;">
       <div class="btn-group col-xs-6 col-sm-4 col-md-2 col-lg-2" role="group" style="margin-top: 10px;">

         <th>Actividades registradas</th>

         <!-- Actividades creadas -->
         <div id="container-acts" >
          <div><a href="consultarActividades.html">Spinning</a></div>
          <div><a href="#">Zumba</a></div>
          <div><a href="#">Aqua-Aerobic</a></div>
         </div>

	    </div>

      <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px;">
       <a href="crearActividad.html" style="text-decoration: none;"><button type="button" class="btn btn-default1" id="botonCrear">Crear Actividad</button></a>
      </div>


    <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-top: 10px;">
     <a href="modificarActividad.html" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonModificar">Modificar Actividad</button></a>
    </div>




    <footer id="footer">
    <p style="text-align: center;"><img alt="Uvigo" class="responsive-image" style="max-width: 100%;" src="../../img/navBar/logoUvigo.png"></p>
    <p style="text-align: center;"><a style="text-decoration: none;" href="#"><button type="button" class="btn btn-default" style="border-color: black;">Subir</button></a></p>
    </footer>

  </body>
</html>