<?php
include_once __DIR__."/../../model/model.php";
include_once __DIR__."/../../controller/defaultController.php";
if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 if ($_SESSION["usuario"]->getTipoUsuario() =='Entrenador'){

  $idActividad = $_GET['id'];
  $row = UsuarioController::getUsuariosEntrenador($idActividad);
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
     <link href="../../css/gestionUsuarios.css" rel="stylesheet">
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

      <h1>Usuarios</h1>


      <div class="row" style="margin-top: 20px; margin-bottom: 10px;">


        <!-- COMIENZO DIV TABLA -->
        <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <table class="table table-striped">

           <thead>

              <tr>
                <th>#</th>
                <th>Nombre Usuario</th>
                <th >Apellidos</th>
              </tr>

            </thead>

            <tbody>
              <?php
              if ($row!=NULL) {

                foreach ($row as $usuario) {
                  ?>
              <tr>
                <td><?php echo $usuario['idUsuario']; ?></td>
                <td><a href="consultarUsuarios.php?id=<?php echo $usuario['idUsuario']; ?>" style="text-decoration: none;"><?php echo $usuario['nombre']; ?></a></td>
                <td><a href="consultarUsuarios.php?id=<?php echo $usuario['idUsuario']; ?>" style="text-decoration: none;"><?php echo $usuario['apellidos']; ?></a></td>

              </tr>
              
              <?php
                }
              }
              ?>

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
?>
