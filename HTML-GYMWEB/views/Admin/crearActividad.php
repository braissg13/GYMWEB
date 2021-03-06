<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION['tipoUsuario'] =='Administrador'){
   $row = UsuarioController::getAllEntrenadores();
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
		 	<form action="../../controller/defaultController.php?controlador=actividad&accion=crearActividad" method="post" style="margin:10px;" enctype="multipart/form-data">
		 		<!-- COMIENZO ROW-->
		 		<div class="row">

          <!-- DIV NOMBRE ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="nomAct">Nombre: </label>
              <input type="text" required="" class="form-control" name="nomAct" maxlength="30" placeholder="Nombre actividad">
          </div>

          <!-- DIV PLAZAS ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="numPl">Plazas: </label>
              <input type="number" required="" class="form-control" name="numPl" maxlength="3" placeholder="Plazas actividad">
          </div>

          <!-- DIV FECHA ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="dateAct">Fecha (dd/mm/aaaa): </label>
              <input type="date" placeholder="dd/mm/aaaa" required="" class="form-control" name="fecha">
          </div>
          <!-- DIV HORA ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="timeAct">Hora (HH:MM): </label>
              <input type="time" placeholder="HH:MM" required="" class="form-control" name="hora">
          </div>

            <!-- DIV DESCRIP ACT -->
           <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
               <label for="descAct">Descripci&oacuten Actividad: </label>
               <textarea class="form-control" required="" rows="4" maxlength="500" name="descrAct" placeholder="Breve descripción de la actividad"></textarea>
           </div>

           <!-- DIV IMAGEN-->
          <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top:30px;">
              <label for="imgAct">Subir Imagen: </label>
              <input type="file" required="" name="imagen">
          </div>

          <!-- DIV ASIGNAR ENTRENADOR -->
         <div class="form-group">
             <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <label for="tipoUsu">Asignar entrenador: </label>
                 <select class="form-control" name="entrenador" required="">
                 <?php
                  if($row!=NULL){
                  foreach($row as $entrenador){ ?>
                      <option value="<?php echo $entrenador['idUsuario'];?>"><?php echo $entrenador['nomUsuario'];?></option>
                  <?php } 
                    }
                  ?>
                 </select>
             </div>
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
  }else{
        ob_start(); 
         if (($_SESSION['tipoUsuario']=='DeportistaPEF') || ($_SESSION['tipoUsuario'] =='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");  
          }else{
             if($_SESSION['tipoUsuario']=='Entrenador'){
                  header("Location: ../Entrenador/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>