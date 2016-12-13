<?php
require_once("../../controller/defaultController.php");

  if(!isset($_SESSION)) session_start();
    $idUsuario=$_SESSION['idUsuario'];
    $tipo=$_SESSION['tipoUsuario'];
  if ($tipo =='Administrador'){

  $usuario = UsuarioController::getUsuario($idUsuario);
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
	  <h1>Usuario: <?php echo $usuario->getNomUsuario();?></h1>
        <!-- DIV MUESTRA USUARIO -->
      <div id="container-usuarios">
      <!-- COMIENZO ROW -->
       <div class="row">

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-style: solid;border-color: black; margin-bottom: 10px;">
            <?php //Comprobamos si el usuario tiene imagen, si no tiene mostramos una por defecto
              if($usuario->getImagenPerfil()==Null){
            ?>
              <img alt="imgUsuario" src="../../img/usuarios/default.png" style="max-width: 100%;max-height: 100%;">
            <?php }else{
            ?>
              <img alt="imgUsuario" src="../../img/usuarios/<?php echo $usuario->getImagenPerfil(); ?>" style="max-width: 100%;max-height: 100%;">
            <?php
            }
            ?>
            <p><b>Nombre Usuario:  <?php echo $usuario->getNomUsuario(); ?></b></p>
            <p><b>Nombre: <?php echo $usuario->getNombre(); ?></b></p>
            <p><b>Apellidos:  <?php echo $usuario->getApellidos(); ?></b></p>
            <p><b>Email: <?php echo $usuario->getEmail(); ?></b></p>
            </div>	 

	     </div>

      </div>
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