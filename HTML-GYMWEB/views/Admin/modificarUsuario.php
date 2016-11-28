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
     <link href="../../css/modificarUsuarios.css" rel="stylesheet">
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


 <h1>Modificar Usuario: <?php echo $usuario->getNomUsuario();?></h1>
     <!-- DIV MUESTRA USUARIO -->
           <div id="container-usuarios">
           <!-- COMIENZO ROW -->
            <div class="row row1">

              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <p><b>Nombre Usuario: <?php echo $usuario->getNomUsuario();?></b></p>
                <p><b>Nombre: <?php echo $usuario->getNombre();?></b></p>
                <p><b>Apellidos: <?php echo $usuario->getApellidos();?></b></p>
                <p><b>Email: <?php echo $usuario->getEmail();?></b></p>
                <p><b>Tipo Usuario: <?php echo $usuario->getTipoUsuario();?></b></p>
              </div>

            </div><!-- FIN ROW -->

          </div> <!-- FIN CONTAINER USUARIOS -->

             <div id="container-formulario">
                <h1>Modificar</h1>

                  <!-- DIV FORMULARIO -->
                <div id="container-usuarios" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
                   <form action="../../controller/defaultController.php?controlador=usuario&accion=modificarUsuario" method="post" style="margin:10px;">
                   <!-- COMIENZO ROW-->
                       <div class="row" style="margin-bottom: 10px;">

                       <!-- DIV nombreUsuario USU -->
                         <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                     <label for="nomUser">Nombre Usuario: </label>
                                     <input type="text" class="form-control" name="nomUsuario" maxlength="30" placeholder="nombre usuario">
                         </div>

                         <!-- DIV password nueva USU -->
                         <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                     <label for="passUsu">Password nueva: </label>
                                     <input type="password" class="form-control"  name="password" maxlength="20" placeholder="password usuario">
                         </div>
                         <!-- DIV NOMBRE USU -->
                         <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                             <label for="nomUsu">Nombre: </label>
                             <input type="text" class="form-control" name="nombre" maxlength="30" placeholder="Nombre">
                         </div>
                         <!-- DIV APELLIDOS USU -->
                         <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                             <label for="apellUsu">Apellidos: </label>
                             <input type="text" class="form-control" name="apellidos" maxlength="30" placeholder="Apellidos">
                         </div>


                         <!-- DIV EMAIL USU -->
                         <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                     <label for="emailUsu">Email: </label>
                                     <input type="email" class="form-control" name="email" maxlength="50" placeholder="email usuario">
                         </div>


                      <!-- DIV TIPO USU -->
                      <?php if($usuario->getTipoUsuario()!="Administrador"){ ?>
                             <div class="form-group">
                                 <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                   <label for="tipoUsu">TipoUsuario: </label>
                                     <select class="form-control" name="tipoUsuario">
                                       <option value="Entrenador">Entrenador</option>
                                       <option value="DeportistaPEF">DeportistaPEF</option>
                                       <option value="DeportistaTDU">DeportistaTDU</option>
                                     </select>
                                 </div>
                           </div>
                      <?php } ?>

                    </div> <!-- FIN ROW -->

                    <input type="hidden" name="idUsu" value="<?php echo $usuario->getIdUsuario();?>">

                    <p style="text-align:center">
                    <button type="submit" class="btn btn-default1" style="margin-right: 10px;">
                      <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
                    </button>

                      <a href="gestionUsuarios.php"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
               </form>
        </div> <!-- FIN FORMULARIO USUARIOS -->


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