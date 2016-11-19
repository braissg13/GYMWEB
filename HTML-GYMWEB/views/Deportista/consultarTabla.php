<?php
 include_once __DIR__."/../../model/model.php";
	include_once __DIR__."/../../controller/defaultController.php";

	if(!isset($_SESSION)) session_start();
 		$user=$_SESSION["usuario"];
 	if (($_SESSION["usuario"]->getTipoUsuario()=='DeportistaPEF') || ($_SESSION["usuario"]->getTipoUsuario()=='DeportistaTDU')){

    $idTabla = $_GET['id'];

    $tabla = TablaController::getTabla($idTabla);
    $row = TablaController::getEjercicios($idTabla);
    $row2 = UsuarioController::getComentarios($idTabla,$_SESSION["usuario"]->getIdUsuario());
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
    <!-- SCRIPT para imprimir -->
    <script type="text/javascript">
      function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      }
</script>
  </head>
  <body>
  <header>
  
  <?php include("../navbar.php");  /*Cargamos la barra de navegación*/ ?>

  </header>

  	<div class="container">
  		 <!-- DIV MUESTRA Tabla -->
		 <div id="container-ejercicios">

			<div class="row" id="imprimir">
       <h1>Tabla: <?php echo $tabla->getNomTabla();?></h1>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="visibility: hidden;"></div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="visibility: hidden;"></div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 10px;">
          <button type="button" class="btn btn-default" onClick="printDiv('imprimir');">
            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          </button>
        </div>

        <?php 
        if($row!=null){
          foreach ($row as $ejercicio) {
        ?>
  				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-style: solid;border-color: black;margin-bottom: 20px; margin-right: 10px;"><img alt="imgEjer" src="../../img/ejercicios/<?php echo $ejercicio['imagen']; ?>" style="max-width: 100%;max-height: 100%;">
            <p style="font-size: 10px;"><b>Nombre Ejercicio: <?php echo $ejercicio['nomEjercicio']; ?></b></p>
            <p><b>Peso (Kg): <?php echo $ejercicio['carga']; ?></b></p>
            <p><b>Repeticiones: <?php echo $ejercicio['repeticiones']; ?></b></p>
          </div>
        <?php 
          }
        }
        ?>

			</div><!-- FIN ROW -->

		 </div> <!-- FIN CONTAINER EJERCICIOS -->

     <div class="row"><!-- INICIO ROW2 -->
      <h1>Comentarios: </h1>
        <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">
         <thead>
            <tr>
              <th>Comentario</th>
              <th>Fecha</th>
              <th>Entrenamiento Completado</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if($row2!=NULL){
              foreach ($row2 as $comentario) {
                //La fecha que nos devuleve la BD es de forma Año-Mes-Dia Hora:Min:Seg
                //Entonces hay cambiarla a Dia-Mes-Año Hora:Min y lo hacemos de 
                //La siguiente manera: $format especificamos la manera en la que viene
                //La fecha de la bd, createfromformat() crea un Objeto de tipo DateTime 
                //con elformato anterior y nuestra fecha de la bd.
                // $dateobj->format("d-m-Y H:i") Convierte la Fecha en el formato que queremos.
                // Este ultimo lo pondermos solo donde queremos mostrarlo que es en la tabla.
                  $fecha = $comentario['fecha'];
                  $format = "Y-m-d H:i:s";
                  $dateobj = DateTime::createFromFormat($format, $fecha);
            ?>
            <tr>
              <td><?php echo $comentario['texto']; ?></td>
              <td><?php echo $dateobj->format("d-m-Y"); ?></td>
              <td><?php echo $comentario['completado']; ?></td>
            </tr>
            <?php
                }
              }
            ?>
          </tbody>
        </table>
        </div>
        <h1>Crear Comentario: </h1>
         <!-- DIV FORMULARIO -->
         <div id="container-actividades" style="background:#0275d8; border: solid;border-radius:5px; border-color: black; margin-bottom: 10px;">
          <form action="../../controller/defaultController.php?controlador=usuario&accion=addComentarioTabla" method="post" style="margin:10px;">

                <!-- DIV Comentario -->
               <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <label for="coment">Comentario: </label>
                   <textarea class="form-control" required="" rows="4" maxlength="500" name="comentario" placeholder="Comentario sobre ejercicios realizados"></textarea>
                   <input type="radio" name="completado" required="" value="Si"><b>Entrenamiento Completado</b>
                  <input type="radio" name="completado" required="" value="No"><b>Entrenamiento no Completado</b>
               </div>
               <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["usuario"]->getIdUsuario();?>">
               <input type="hidden" name="idTabla" value="<?php echo $tabla->getIdTabla();?>">
              <p style="text-align:center">
              <button type="submit" class="btn btn-default1" style="margin-right: 10px;">
                <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
              </button>
          </form>
         </div> <!-- FIN FORMULARIO EJERCICIOS -->
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <a href="misTablas.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
            </div>
     </div><!-- FIN ROW2 -->

	</div><!-- FIN CONTAINER -->
   
	<?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>

<?php
  }else{
        ob_start(); 
         if (($_SESSION["usuario"]->getTipoUsuario()=='Entrenador')){
            header("refresh: 1; url = ../Entrenador/principal.php");  
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