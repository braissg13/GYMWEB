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


	       <!-- COMINENZO VER ACTIVIDAD -->
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

     <h1>Modificar Actividad: Zumba</h1>
     <!-- DIV MUESTRA USUARIO -->
   <div id="container-usuarios">
   <!-- COMIENZO ROW -->
    <div class="row row1">
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

    <div ><p><b>Plazas: 50</b></p></div>
    <div><p><b>Plazas ocupadas: 30</b></p></div>
    <div ><p><b>Descripción: Actividad en la sala B del Gimnasio que durará aprox. 50 min.</b></p></div>
    <div><p><b>Fecha: 28/11/2016</b></p></div>

</div>
    </div><!-- FIN ROW -->

  </div> <!-- FIN CONTAINER ACTIVIDADES -->

		 <div id="container-formulario">
        <h1>Modificar</h1>

          <!-- DIV FORMULARIO -->
        <div id="container-actividades" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
           <form action="#" method="post" style="margin:10px;">
           <!-- COMIENZO ROW-->
           <div class="row">

             <!-- DIV NOMBRE ACT -->
             <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                 <label for="nomAct">Nombre: </label>
                 <input type="text" class="form-control" id="nomAct" maxlength="30" placeholder="Nombre actividad">
             </div>

             <!-- DIV PLAZAS ACT -->
             <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                 <label for="nomAct">Plazas: </label>
                 <input type="number" class="form-control" id="numPl" maxlength="3" placeholder="Plazas actividad">
             </div>

             <!-- DIV FECHA ACT -->
             <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                 <label for="dateAct">Fecha: </label>
                 <input type="datetime" class="form-control" id="numPl" placeholder="Fecha actividad">
             </div>


               <!-- DIV DESCRIP ACT -->
              <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
                  <label for="descAct">Descripci&oacuten Actividad: </label>
                  <textarea class="form-control" rows="4" maxlength="500" placeholder="Breve descripción de la actividad"></textarea>
              </div>

             </div> <!-- FIN ROW -->

             <p style="text-align:center">
             <button type="submit" class="btn btn-default1" style="margin-right: 10px;">
               <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
             </button>

             <a href="gestionUsuarios.html"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
           </form>
        </div> <!-- FIN FORMULARIO USUARIOS -->


	</div>




    <footer id="footer">
    <p style="text-align: center;"><img alt="Uvigo" class="responsive-image" style="max-width: 100%;" src="../../img/navBar/logoUvigo.png"></p>
    <p style="text-align: center;"><a style="text-decoration: none;" href="#"><button type="button" class="btn btn-default" style="border-color: black;">Subir</button></a></p>
    </footer>

  </body>
</html>
