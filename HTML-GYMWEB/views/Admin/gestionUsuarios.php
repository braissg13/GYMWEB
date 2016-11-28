<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION['tipoUsuario'] =='Administrador'){
   $row = UsuarioController::getAll();
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
    <!-- BOTON MOSTRAR USUARIOS CREAR USUARIOS ELIMINAR USUARIOS-->

    <div class="row" style="margin-top: 20px; margin-bottom: 10px;">


      <div class="btn-group col-xs-6 col-sm-4 col-md-4 col-lg-2" role="group" style="margin-bottom: 10px;">
       <a href="crearUsuario.php" style="text-decoration: none;"><button type="button" class="btn btn-default1" id="botonCrear">Crear Usuario</button></a>
      </div>

      <!-- COMIENZO DIV TABLA -->
      <div class="table-responsive col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-striped">

         <thead>

            <tr>
              <th>#</th>
              <th>Nombre Usuario</th>
              <th >Tipo Usuario</th>
            </tr>

          </thead>

          <tbody>
            <?php
            if($row!=null){
              foreach ($row as $usuario) {
                ?>
            
            <tr>
              <td><?php echo $usuario['idUsuario']; ?></td>
              <td><a href="consultarUsuarios.php?id=<?php echo $usuario['idUsuario']; ?>" style="text-decoration: none;"><?php echo $usuario['nomUsuario']; ?></a></td>
              <td><a href="modificarUsuario.php?id=<?php echo $usuario['idUsuario']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default3" id="botonModificar">Modificar usuario</button></a></td>
                <td><a href="consultarUsuarios.php?id=<?php echo $usuario['idUsuario']; ?>" style="text-decoration: none;"><button type="button" class="btn btn-default2" id="botonEliminar">Eliminar Usuario</button></a></td>
            </tr>
            <?php
              }
            }
            ?>

          </tbody>

        </table>
      </div>

  </div><!-- FIN ROW -->



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

