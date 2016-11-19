<?php
 include_once __DIR__."/../../model/model.php";
	include_once __DIR__."/../../controller/defaultController.php";

	if(!isset($_SESSION)) session_start();
 		$user=$_SESSION["usuario"];
 	if ($_SESSION["usuario"]->getTipoUsuario() =='Entrenador'){

    $idTabla = $_GET['id'];

    $tabla = TablaController::getTabla($idTabla);
    $row = TablaController::getEjercicios($idTabla);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>GYMWEB</title>

    <!-- Bootstrap -->
    <link href="../../css/navbar.css" rel="stylesheet">
    <link href="../../css/consultarTabla.css" rel="stylesheet">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    
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
		 
		 <h1>Tabla: <?php echo $tabla->getNomTabla();?></h1>

  		 <!-- DIV MUESTRA Tabla -->
		 <div id="container-ejercicios">

			<div class="row">
        <?php 
        if($row!=null){
          foreach ($row as $ejercicio) {
        ?>
  				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-style: solid;border-color: black;margin-bottom: 20px; margin-right: 10px;"><img alt="imgEjer" src="../../img/ejercicios/<?php echo $ejercicio['imagen']; ?>" style="max-width: 100%;max-height: 100%;">
            <p><b>Peso (Kg): <?php echo $ejercicio['carga']; ?></b></p>
            <p><b>Repeticiones: <?php echo $ejercicio['repeticiones']; ?></b></p>
          </div>
        <?php 
          }
        }
        ?>
  				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
  					<!-- PRINCIPIO MODAL ELMINAR TABLA -->
		  			<div class="form-group">
			      		<button type="button" class="btn btn-default2" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar</button>
			      		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		  					<div class="modal-dialog modal-sm" role="document">
		    					<div class="modal-content" id="modalLogin">
		      						<div class="text-center" style="padding:50px 0">
												
									<h3><b>&iquest Desea eliminar este ejercicio?</b></h3>
                  <form action="../../controller/defaultController.php?controlador=tabla&accion=borrarTabla" method="POST">
                    <input type="hidden" name="idTabla" value="<?php echo $tabla->getIdTabla();?>">
                    <input type="hidden" name="nomTabla" value="<?php echo $tabla->getNomTabla();?>">
									   <button type="submit" class="btn btn-default2">
										  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
									   </button>
                  
									<a href="gestionTablas.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a></form>	
								
									</div> 
									
		    					</div>
		  					</div>
			      		</div>
			      	</div>	<!-- FIN MODAL -->

  				</div>

          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <a href="gestionTablas.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
          </div>

			</div><!-- FIN ROW -->

		 </div> <!-- FIN CONTAINER EJERCICIOS -->

	</div><!-- FIN CONTAINER -->
   
	<?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>

<?php
  }else{
        ob_start(); 
         if (($_SESSION["usuario"]->getTipoUsuario()=='DeportistaPEF') || ($_SESSION["usuario"]->getTipoUsuario()=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");  
          }else{
             if($_SESSION["usuario"]->getTipoUsuario()=='Administrador'){
                  header("Location: ../Admin/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>