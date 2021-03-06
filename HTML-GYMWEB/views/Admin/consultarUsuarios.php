<?php
require_once("../../controller/defaultController.php");

if(!isset($_SESSION)) session_start();
 $idUsuario=$_SESSION['idUsuario'];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION['tipoUsuario'] =='Administrador'){

  $idUsu = $_GET['id'];
  $usuario = UsuarioController::getUsuario($idUsu);
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
    <link href="../../css/consultarUsuarios.css" rel="stylesheet">

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
          <?php //Comprobamos si el usuario tiene imagen, si no tiene mostramos una por defecto
              if($usuario->getImagenPerfil()==Null){
          ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 20px; margin-right: 10px;"><img alt="imgUsuario" src="../../img/usuarios/default.png" style="max-width: 100%;max-height: 100%;">
            </div>
          <?php }else{
          ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom: 20px; margin-right: 10px;"><img alt="imgUsuario" src="../../img/usuarios/<?php echo $usuario->getImagenPerfil(); ?>" style="max-width: 100%;max-height: 100%;">
            </div>
          <?php
          }
          ?>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-style: solid;border-color: black; margin-bottom: 10px;">
            <p><b>Nombre Usuario:  <?php echo $usuario->getNomUsuario(); ?></b></p>
            <p><b>Nombre: <?php echo $usuario->getNombre(); ?></b></p>
            <p><b>Apellidos:  <?php echo $usuario->getApellidos(); ?></b></p>
            <p><b>Email: <?php echo $usuario->getEmail(); ?></b></p>
            <p><b>Tipo Usuario:  <?php echo $usuario->getTipoUsuario(); ?></b></p>
            </div>


  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
           <!-- PRINCIPIO MODAL ELMINAR Usuario -->
           <div class="form-group">

               <button type="button" class="btn btn-default1" data-toggle="modal" data-target=".bs-example-modal-sm">Eliminar</button>
               <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
               <div class="modal-dialog modal-sm" role="document">
                 <div class="modal-content" id="modalLogin">
                 <!-- COMIENZO FOMRULARIO LOGIN -->
                     <div class="text-center" style="padding:50px 0">

                 <h3><b>&iquest Desea eliminar este usuario?</b></h3>

                 <form action="../../controller/defaultController.php?controlador=usuario&accion=borrarUsuario" method="POST">
                   <input type="hidden" name="idUsuario" value="<?php echo $usuario->getIdUsuario();?>">
                   <input type="hidden" name="nomUsuario" value="<?php echo $usuario->getNomUsuario();?>">
                   <input type="hidden" name="tipoUsuario" value="<?php echo $usuario->getTipoUsuario();?>">
                  <button type="submit" class="btn btn-default2">
                   <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                 </button>
                 <a href="gestionUsuarios.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>

                 </div>

                 </div>
               </div>
               </div>
             </div> <!-- FIN MODAL -->

           </div>

           <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
               <a href="gestionUsuarios.php"><button type="button" class="btn btn-default3">Atr&aacutes</button></a>
           </div>

       </div><!-- FIN ROW -->

     </div> <!-- FIN CONTAINER USUARIOS -->

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