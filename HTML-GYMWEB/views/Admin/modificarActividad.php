<?php
include_once __DIR__."/../../model/model.php";
include_once __DIR__."/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION["usuario"]->getTipoUsuario() =='Administrador'){
  $idAct = $_GET['id'];
  $actividad = ActividadController::getActividad($idAct);

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
    <link href="../../css/modificarActividad.css" rel="stylesheet">
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
     
     <h1>Modificar Actividad: <?php echo $actividad->getNomActividad();?></h1>

       <!-- DIV MUESTRA ACTIVIDAD -->
     <div id="container-actividad">
     <!-- COMIENZO ROW -->
      <div class="row row1">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="border-style: solid;border-color: black;margin-bottom: 20px;"><img alt="imgActividad" src="../../img/actividades/<?php echo $actividad->getImagenActividad();?>" style="max-width: 100%;max-height: 100%;"></div>
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <pre style="background-color: transparent; border-color: black;">
<?php echo $actividad->getDescripActividad();?>
          </pre>  

          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Plazas: <?php echo $actividad->getTotalPlazas();?></b></p></div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Plazas Ocupadas: <?php echo $actividad->getPlazasOcupadas();?></b></p></div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"><p><b>Fecha: <?php echo $dateobj->format("d-m-Y H:i");?></b></p></div>
      </div><!-- FIN ROW -->

     </div> <!-- FIN CONTAINER ACTIVIDAD -->

     <div id="container-formulario">
     <h1>Modificar: </h1>

       <!-- DIV FORMULARIO -->
     <div id="container-formulario2" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
        <form action="../../controller/defaultController.php?controlador=actividad&accion=modificarActividad" method="post" style="margin:10px;" enctype="multipart/form-data">
        <!-- COMIENZO ROW 2-->  
        <div class="row"> 
        <!-- DIV NOMBRE ACTIVIDAD -->
              <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                   <label for="nomAct">Nombre: </label>
                   <input type="text" class="form-control" name="nomAct" maxlength="30" placeholder="Nombre actividad">
               </div>
        <!-- DIV PLAZAS ACTIVIDAD -->
               <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                   <label for="nomAct">Plazas: </label>
                   <input type="number" min="0" class="form-control" name="numPl" maxlength="3" placeholder="Plazas actividad">
               </div>
         <!-- DIV FECHA ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="dateAct">Fecha (dd/mm/aaaa): </label>
              <input type="date" required="" placeholder="dd/mm/aaaa" class="form-control" name="fecha">
          </div>
          <!-- DIV HORA ACT -->
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <label for="timeAct">Hora (HH:MM): </label>
              <input type="time" required="" placeholder="HH:MM" class="form-control" name="hora">
          </div>
        <!-- DIV DESCRIPCION ACTIVIDAD -->
                <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <label for="descAct">Descripci&oacuten Actividad: </label>
                    <textarea class="form-control" name="descrAct" rows="4" maxlength="500" placeholder="Breve descripción de la actividad"></textarea>
                </div>
      <!-- DIV IMAGEN ACTIVIDAD -->
                <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-top:30px;">
                  <label for="imgAct">Subir Imagen: </label>
                  <input type="file" name="imagen">
                </div>

            
          </div> <!-- FIN ROW 2-->
          <input type="hidden" name="idAct" value="<?php echo $actividad->getIdActividad();?>">
          <input type="hidden" name="plazasOc" value="<?php echo $actividad->getPlazasOcupadas();?>">
          <p style="text-align:center">
          <button type="submit" class="btn btn-default1" style="margin-right: 10px;">
            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
          </button>

          <a href="gestionActividades.php"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
        </form>
      </div> <!-- FIN FORMULARIO ACTIVIDAD -->
     </div>

  </div><!-- FIN CONTAINER -->

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
             if($_SESSION["usuario"]->getTipoUsuario()=='Entrenador'){
                  header("Location: ../Entrenador/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>