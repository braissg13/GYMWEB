<?php
	$tipo = $_SESSION['tipoUsuario'];
?>

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
	      <?php if($tipo=='Administrador'){ ?>
	        <li><a id="Item1" href="principal.php">Principal</a></li>
	        <li><a id="Item2" href="gestionUsuarios.php">Gesti&oacuten de Usuarios</a></li>
	        <li><a id="Item3" href="gestionActividades.php">Gesti&oacuten de Actividades</a></li>
	        <li><a id="Item4" href="gestionEjercicios.php">Gesti&oacuten de Ejercicios</a></li>
	       <?php }else{
	       		if($tipo == 'Entrenador'){ ?>
	        <li><a id="Item1" href="principal.php">Principal</a></li>
	        <li><a id="Item2" href="misActividades.php">Mis Actividades</a></li>
	        <li><a id="Item3" href="gestionEjercicios.php">Gesti&oacuten de Ejercicios</a></li>
	        <li><a id="Item4" href="gestionTablas.php">Gesti&oacuten de Tablas de Ejercicios</a></li>
	       		<?php }else if($tipo == 'DeportistaPEF' || $tipo == 'DeportistaTDU'){ ?> 
	       	<li><a id="Item1" href="principal.php">Principal</a></li>
	        <li><a id="Item2" href="misActividades.php">Mis Actividades</a></li>
	        <li><a id="Item3" href="ejercicios.php">Ejercicios</a></li>
	        <li><a id="Item4" href="misTablas.php">Tablas de Ejercicios</a></li>
	       	<?php	}
	       	}
	       	?>
	      </ul>
	      <?php if($tipo == 'DeportistaPEF' || $tipo == 'DeportistaTDU'){ ?>
		      <form class="navbar-form navbar-left" action="../../controller/defaultController.php?controlador=actividad&accion=buscar" method="POST">
		        <div class="form-group">
		          <input type="text" name="nomActividad" class="form-control" placeholder="Buscar Actividad...">
		        </div>
		        <button type="submit" id="botonBuscar" class="btn btn-default">Buscar</button>
		      </form>
	      <?php	
	  		} 
	      ?>
	      <ul class="nav navbar-nav navbar-right">
	       <!-- COMIENZO VER PERFIL -->
	       <li class="dropdown">
	          <a href="#" id="drop" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil <span class="caret"></span></a>
	          <ul id="ulDrop" class="dropdown-menu">
	            <li><a id="aVerPerf" href="verPerfil.php">Ver perfil</a></li>
	            <li><a id="aModificarPerf" href="modificarPerfil.php">Modificar perfil</a></li>
	            <li id="separador" role="separator" class="divider"></li>
	            <li><a href="../../controller/defaultController.php?controlador=usuario&accion=logout" id="aCerrarSesion">Cerrar Sesi&oacuten</a></li>
	            <!--<li><a href="../../controller/logout.php" id="aCerrarSesion">Cerrar Sesi&oacuten</a></li>-->
	          </ul>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
</nav>