<?php
include_once __DIR__."/../../model/model.php";
include_once __DIR__."/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION["usuario"]->getTipoUsuario() =='Entrenador'){

   $idActividad = $_GET['id'];

    $actividad = ActividadController::getActividad($idActividad);
    $row = ActividadController::getEntrenador($idActividad);

  //La fecha que nos devuleve la BD es de forma Año-Mes-Dia Hora:Min:Seg
  //Entonces hay cambiarla a Dia-Mes-Año Hora:Min y lo hacemos de
  //La siguiente manera: $format especificamos la manera en la que viene
  //La fecha de la bd, createfromformat() crea un Objeto de tipo DateTime
  //con elformato anterior y nuestra fecha de la bd.
  // $dateobj->format("d-m-Y H:i") Convierte la Fecha en el formato que queremos.
  // Este ultimo lo pondermos solo donde queremos mostrarlo que es en la tabla.
    $fecha = $actividad->getFecha();
    $format = "Y-m-d H:i:s";
    $dateobj = DateTime::createFromFormat($format, $fecha);
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
    <link href="../../css/consultarActividades.css" rel="stylesheet">

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


        <h1>Actividad: <?php echo $actividad->getNomActividad();?></h1>
        <!-- DIV MUESTRA ACTIVIDAD-->
      <div id="container-acts">
      <!-- COMIENZO ROW -->
       <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="border-style: solid;border-color: black;margin-bottom: 20px;"><img alt="imgAct" src="../../img/actividades/<?php echo $actividad->getImagenActividad();?>" style="max-width: 100%;max-height: 100%;"></div>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <pre style="background-color: transparent; border-color: black;">
<?php echo $actividad->getDescripActividad();?>
          </pre>

          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Plazas: <?php echo $actividad->getTotalPlazas();?></b></p></div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Plazas Ocupadas: <?php echo $actividad->getPlazasOcupadas();?></b></p></div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Fecha: <?php echo $dateobj->format("d-m-Y H:i");?></b></p></div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Entrenador: <?php foreach($row as $entrenador){
             echo $entrenador['nomUsuario'];
            }?></b></p></div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a href="controlReserva.php?id=<?php echo $actividad->getidActividad(); ?>" style="text-decoration: none;">
                  <button type="button" class="btn btn-default3" id="botonVerReserva">ver Reserva</button></a>
                <a href="misActividades.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
              </div>


       </div><!-- FIN ROW -->


     </div> <!-- FIN CONTAINER ACTIVIDADES -->

	</div>
  <?php include("../footer.php");  /*Cargamos el footer*/ ?>
  </body>
</html>
<?php
  /*Dependiendo que tipo de Usuario intente entrar donde no debe lo mandamosa su pagina principal.*/
  }else{
        ob_start();
         if (($_SESSION["usuario"]->getTipoUsuario()=='DeportistaPEF') || ($_SESSION["usuario"]->getTipoUsuario()=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");
          }else{
             if($_SESSION["usuario"]->getTipoUsuario()=='Administrador'){
                  header("Location: ../Administrador/principal.php");
             }else{
                header("Location: = /../index.php");
             }
          }

        ob_end_flush();
  }
?>
