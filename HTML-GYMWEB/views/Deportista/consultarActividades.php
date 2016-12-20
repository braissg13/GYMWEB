<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION['tipoUsuario'] =='DeportistaPEF' || $_SESSION['tipoUsuario'] =='DeportistaTDU'){

   $idActividad = $_GET['id'];

    $actividad = ActividadController::getActividad($idActividad);
    $row = ActividadController::getEntrenador($idActividad);
    $row2 = ActividadController::existeReserva($idActividad,$idUsuario);
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
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Entrenador: <?php if($row!=null){ foreach($row as $entrenador){
             echo $entrenador['nomUsuario'];
            }}?></b></p></div>

           <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
           <?php 
            if($row2!=1){
           ?>
           <form action="../../controller/defaultController.php?controlador=reserva&accion=crearReserva" method="POST">
           <input type="hidden" name="idActividad" value="<?php echo $actividad->getIdActividad();?>">
           <input type="hidden" name="totalPlazas" value="<?php echo $actividad->getTotalPlazas();?>">
           <input type="hidden" name="fecha" value="<?php echo $dateobj->format("d-m-Y H:i");?>">
           <input type="hidden" name="plazasOcup" value="<?php echo $actividad->getPlazasOcupadas();?>">
           <input type="hidden" name="idUsuario" value="<?php echo $idUsuario;?>">
           <button type="submit" style="background-color: slateblue;color: white; margin-bottom: 10px;" class="btn btn-default4" id="ReservarPlaza">Reservar plaza</button></a>
           </form>
           <?php 
            } else{
           ?>
           <!-- PRINCIPIO MODAL ELMINAR Act -->
           <div class="form-group">

               <button type="button" class="btn btn-default1" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar Reserva</button>
               <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
               <div class="modal-dialog modal-sm" role="document">
                 <div class="modal-content" id="modalLogin">
                 <!-- COMIENZO FOMRULARIO LOGIN -->
                  <div class="text-center" style="padding:50px 0">

                 <h3><b>&iquest Desea eliminar la reserva?</b></h3>
                 <form action="../../controller/defaultController.php?controlador=reserva&accion=borrarReserva" method="POST">
                      <input type="hidden" name="idActividad" value="<?php echo $actividad->getIdActividad();?>">
                      <input type="hidden" name="plazasOcup" value="<?php echo $actividad->getPlazasOcupadas();?>">
                      <input type="hidden" name="idUsuario" value="<?php echo $idUsuario;?>">
                     <button type="submit" class="btn btn-default2">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                     </button>
                  
                  <a href="misActividades.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
                </form>  

                 </div>

                 </div>
               </div>
               </div>
             </div> <!-- FIN MODAL -->
           <?php
              }
           ?>  
            <a href="principal.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
            </div>

       </div><!-- FIN ROW -->

     </div> <!-- FIN CONTAINER ACTIVIDADES -->

  </div>
  <?php include("../footer.php");  /*Cargamos el footer*/ ?>
  </body>
</html>
<?php
  }else{
        ob_start();
         if (($_SESSION['tipoUsuario']=='Administrador')){
            header("refresh: 1; url = ../Admin/principal.php");
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
