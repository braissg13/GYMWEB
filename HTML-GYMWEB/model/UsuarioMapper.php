<?php
include_once __DIR__."/../conexion/bdConexion.php";
class UsuarioMapper{
  /*Buscamos todos las Actividades*/
  public static function findAll()
  {
      global $connect;
      $resultado = mysqli_query($connect, 'SELECT * FROM usuario');
      return $resultado;
  }
    /*Buscamos Usuario por su nombreUsusario*/
    public static function findByUserName($nomUsuario)
    {
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM usuario WHERE nomUsuario ="'.$nomUsuario.'"');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $usuario= new Usuario($row['idUsuario'],$row['nomUsuario'],$row['password'],$row['email'],$row['tipoUsuario'],$row['nombre'],$row['apellidos']);
            return $usuario;
        } else {
            return NULL;
        }
    }

    /*Buscamos Usuario por su nombreUsusario*/
    public static function findByUserId($idUsuario)
    {
        global $connect;
        $resultado = mysqli_query($connect, 'SELECT * FROM usuario WHERE idUsuario ="'.$idUsuario.'"');
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $usuario= new Usuario($row['idUsuario'],$row['nomUsuario'],$row['password'],$row['email'],$row['tipoUsuario'],$row['nombre'],$row['apellidos']);
            return $usuario;
        } else {
            return NULL;
        }
    }

    /*Buscamos si existe un User por su Nombre de Usuario, devolvemos true si existe*/
    public static function existeUsuario($nomUsuario) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM usuario WHERE nomUsuario=\"$nomUsuario\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }
     /*Mira si el Usuario es valido y devuelve true.*/
    public static function esValidoUsuario($nomUsuario, $password) {
        global $connect;
        $resultado = mysqli_query($connect, "SELECT * FROM usuario WHERE nomUsuario=\"$nomUsuario\" AND password=\"$password\"");
        $busqueda = mysqli_num_rows($resultado);
        if( $busqueda > 0) {
            return true;
        }
    }
    /*Mira si el Usuario es valido (solo comprobando el nombre) y devuelve true.*/
   public static function usuarioValido($nomUsuario) {
       global $connect;
       $resultado = mysqli_query($connect, "SELECT * FROM usuario WHERE nomUsuario=\"$nomUsuario\"");
       $busqueda = mysqli_num_rows($resultado);
       if( $busqueda > 0) {
           return true;
       }
   }
    
    /*Mira si el Usuario es valido (solo comprobando el nombre) y devuelve true.*/
   public static function usuarioValidoId($idUsuario) {
       global $connect;
       $resultado = mysqli_query($connect, "SELECT * FROM usuario WHERE idUsuario=\"$idUsuario\"");
       $busqueda = mysqli_num_rows($resultado);
       if( $busqueda > 0) {
           return true;
       }
   }

      /* Guardamos un Usuario en la BD*/
    public static function guardarUsuario($user){
      global $connect;
      $resultado = false;
     $sqlcrear= "INSERT INTO usuario (nomUsuario,password,email,tipoUsuario,nombre, apellidos) VALUES ('";
      $sqlcrear = $sqlcrear.$user->getNomUsuario()."','".md5($user->getPassword())."','".$user->getEmail()."','".$user->getTipoUsuario()."','".$user->getNombre()."','".$user->getApellidos()."')";
        $resultado = mysqli_query($connect, $sqlcrear);
       return $resultado;
    }
    public static function update($idUsuario,$nomUsuario,$password,$email, $tipoUsuario, $nombre, $apellidos)
    {
        global $connect;
        
        $password = md5($password);
        
        $result = mysqli_query($connect, "UPDATE usuario SET nomUsuario=\"$nomUsuario\", password =\"$password\", email =\"$email\", tipoUsuario= \"$tipoUsuario\",nombre=\"$nombre\", apellidos=\"$apellidos\" WHERE idUsuario=\"$idUsuario\"");
        return $result;
    }

     public static function delete($idUsuario){
        global $connect;
        $resultado = mysqli_query($connect, "DELETE FROM usuario WHERE idUsuario=\"$idUsuario\"");
        return $resultado;
    }
}
?>