<?php
include_once "/../../model/model.php";
include_once "/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION["usuario"]->getTipoUsuario() =='Administrador'){
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GYMWEB</title>

    <!-- Bootstrap -->
    <link href="../../css/navbar.css" rel="stylesheet">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/crearActividades.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>

  </head>
  <body>
  <header>
  	 <?php include("../navbar.php");  /*Cargamos la barra de navegación*/ ?>
  </header>

  	<div class="container">

		 <h1>Crear Actividad: </h1>

  		 <!-- DIV FORMULARIO -->
		 <div id="container-actividades" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
		 	<form action="../../controller/defaultController.php?controlador=actividad&accion=crearActividad" method="post" style="margin:10px;">
		 		<!-- COMIENZO ROW-->
		 		<div class="row">

          <!-- DIV NOMBRE ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="nomAct">Nombre: </label>
              <input type="text" class="form-control" name="nomAct" maxlength="30" placeholder="Nombre actividad">
          </div>

          <!-- DIV PLAZAS ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="nomAct">Plazas: </label>
              <input type="number" class="form-control" name="numPl" maxlength="3" placeholder="Plazas actividad">
          </div>

          <!-- DIV FECHA ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="dateAct">Fecha: </label>
              <input type="datetime-local" class="form-control" name="fecha">
          </div>


            <!-- DIV DESCRIP ACT -->
           <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
               <label for="descAct">Descripci&oacuten Actividad: </label>
               <textarea class="form-control" rows="4" maxlength="500" name="descrAct" placeholder="Breve descripción de la actividad"></textarea>
           </div>

           <!-- DIV IMAGEN-->
          <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top:30px;">
              <label for="imgAct">Subir Imagen: </label>
              <input type="file" name="imagen">
          </div>

					</div> <!-- FIN ROW -->

					<p style="text-align:center">
					<button type="submit" class="btn btn-default1" style="margin-right: 10px;">
						<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
					</button>

					<a href="gestionActividades.php"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
				</form>
		 </div> <!-- FIN FORMULARIO EJERCICIOS -->

	</div>

	<?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>
<?php
  /*Dependiendo que tipo de Usuario intente entrar donde no debe lo mandamosa su pagina principal.*/
  }else{
        ob_start();
         if (($_SESSION["usuario"]->getTipoUsuario()=='DeportistaPEF') || ($_SESSION["usuario"]->getTipoUsuario()=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/plantilla-por-defecto.php");
          }else{
             if($_SESSION["usuario"]->getTipoUsuario()=='Entrenador'){
                  header("Location: ../Entrenador/gestionEjercicios.php");
             }else{
                header("Location: = /../index.php");
             }
          }

        ob_end_flush();
  }
?>
