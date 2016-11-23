<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 if ($_SESSION['tipoUsuario'] =='Entrenador'){

  $row = ActividadController::getAll();
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
    <link href="../../css/principal.css" rel="stylesheet">
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
		 <h1>Actividades</h1>

     <div class="row" style="margin-top: 20px; margin-bottom: 10px;">
        <?php 
          if($row!=null){
            foreach ($row as $actividad) {
              //La fecha que nos devuleve la BD es de forma Año-Mes-Dia Hora:Min:Seg
              //Entonces hay cambiarla a Dia-Mes-Año Hora:Min y lo hacemos de 
              //La siguiente manera: $format especificamos la manera en la que viene
              //La fecha de la bd, createfromformat() crea un Objeto de tipo DateTime 
              //con elformato anterior y nuestra fecha de la bd.
              // $dateobj->format("d-m-Y H:i") Convierte la Fecha en el formato que queremos.
              // Este ultimo lo pondermos solo donde queremos mostrarlo que es en la tabla.
              $fecha = $actividad['fecha'];
              $format = "Y-m-d H:i:s";
              $dateobj = DateTime::createFromFormat($format, $fecha);
        ?>

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8" style="margin-bottom: 10px;border-color: #d0cccc;border-style: ridge; background-color: #0275d8;">
                <h3><b><a href="#" style="color: white;"><?php echo $actividad['nomActividad'];?></a></b></h3>
                <h5><b><?php echo $dateobj->format("d-m-Y H:i");?></b></h5>
                <img alt="imgActividad" src="../../img/actividades/<?php echo $actividad['imagenAct'];?>" style="max-width: 100%;max-height: 100%;">
            </div>
        <?php 
          } 
        }
        ?>
        </div>
     </div>


	</div>




    <?php include("../footer.php");  /*Cargamos el footer*/ ?>

  </body>
</html>

<?php
  }else{
        ob_start(); 
         if (($_SESSION['tipoUsuario']=='DeportistaPEF') || ($_SESSION['tipoUsuario']=='DeportistaTDU')){
            header("refresh: 1; url = ../Deportista/principal.php");  
          }else{
             if($_SESSION['tipoUsuario']=='Administrador'){
                  header("Location: ../Admin/principal.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>
