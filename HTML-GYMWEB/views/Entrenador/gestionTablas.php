<?php
include_once "/../../model/model.php";
include_once "/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION["usuario"]->getTipoUsuario() =='Entrenador'){
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
    <link href="../../css/gestionTablas.css" rel="stylesheet">
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




    <h1>Tablas de Ejercicios</h1>
    <!-- BOTON MOSTRAR USUARIOS CREAR USUARIOS ELIMINAR USUARIOS-->

    <div class="row" style="margin-top: 20px; margin-bottom: 10px;">


      <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-bottom: 10px;">
       <a href="crearTablas.php" style="text-decoration: none;"><button type="button" class="btn btn-default1" id="botonCrear">Crear Tabla</button></a>
      </div>

      <!-- COMIENZO DIV TABLA -->
      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">
         
         <thead>

            <tr>
              <th>#</th>
              <th>Nombre Tabla</th>
            </tr>

          </thead>

          <tbody>
            
            <tr>
              <td>1</td>
              <td><a href="consultarTabla.php?id=" style="text-decoration: none;">Tabla Ejercicio Genérica 1</a></td>
              <td><a href="modificarTabla.php?id=" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar Tabla</button></a></td>
              <td><a href="asignarTabla.php?id=" style="text-decoration: none;"><button type="button" class="btn btn-default4" id="botonAsignar">Asignar Tabla</button></a></td>
              <td><a href="consultarTabla.php?id=" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Tabla</button></a></td>
            </tr>

          </tbody>

        </table>

        <div id= "paginacion">
        <ul class="pagination">
          <li><a href="#">«</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">»</a></li>
        </ul>
        </div>
    </div>

  </div><!-- FIN ROW -->



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
                  header("Location: ../Admin/gestionEjercicios.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>