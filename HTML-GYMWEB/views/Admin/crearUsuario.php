<?php
include_once __DIR__."/../../model/model.php";
include_once __DIR__."/../../controller/defaultController.php";

if(!isset($_SESSION)) session_start();
 $user=$_SESSION["usuario"];
 /*Aqui comprobamos que no intenten entrar otros Usuarios que no sean Administradores*/
 if ($_SESSION["usuario"]->getTipoUsuario() =='Administrador'){
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
    <link href="../../css/crearUsuarios.css" rel="stylesheet">
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

        <h1>Crear Usuario</h1>

          <!-- DIV FORMULARIO -->
        <div id="container-usuarios" style="background:#0275d8; border: solid;border-radius:5px; border-color: black;">
           <form action="../../controller/defaultController.php?controlador=usuario&accion=crearUsuario" method="POST" style="margin:10px;">
           <!-- COMIENZO ROW-->
           <div class="row" style="margin-bottom: 10px;">
             
              <!-- DIV Nombre Usuario USU -->
              <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                           <label for="nomUser">Nombre Usuario: </label>
                           <input type="text" class="form-control" required="" name="nomUsuario" maxlength="30" placeholder="Nombre Usuario">
              </div>

              <!-- DIV password USU -->
              <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                           <label for="passUsu">Password: </label>
                           <input type="password" class="form-control" required="" name="password" maxlength="20" placeholder="password">
              </div>

             <!-- DIV NOMBRE  -->
             <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                 <label for="nomUsu">Nombre: </label>
                 <input type="text" class="form-control" name="nombre" required="" maxlength="30" placeholder="Nombre">
             </div>
             <!-- DIV APELLIDOS -->
             <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                 <label for="apellidoUser">Apellidos: </label>
                 <input type="text" class="form-control" name="apellidos" required="" maxlength="30" placeholder="Apellidos">
             </div>


               <!-- DIV EMAIL USU -->
               <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4">
                           <label for="emailUsu">Email: </label>
                           <input type="email" class="form-control" name="email" required="" maxlength="50" placeholder="email">
               </div>
               <!-- DIV TIPO USU -->
                         <div class="form-group">
                             <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                               <label for="tipoUsu">TipoUsuario: </label>
                                 <select class="form-control" name="tipoUsuario" required="">
                                      <option value="Administrador">Administrador</option>
                                       <option value="Entrenador">Entrenador</option>
                                       <option value="DeportistaPEF">DeportistaPEF</option>
                                       <option value="DeportistaTDU">DeportistaTDU</option>
                                 </select>
                             </div>
                       </div>

             </div> <!-- FIN ROW -->

             <p style="text-align:center">
             <button type="submit" class="btn btn-default1" style="margin-right: 10px;">
               <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
             </button>

             <a href="gestionUsuarios.php"><button type="button" class="btn btn-default2">Atr&aacutes</button></a></p>
           </form>
        </div> <!-- FIN FORMULARIO USUARIOS -->

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
                  header("Location: ../Entrenador/gestionEjercicios.php");  
             }else{
                header("Location: = /../index.php"); 
             }
          }
          
        ob_end_flush();  
  }
?>