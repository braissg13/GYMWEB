<?php

require_once(__DIR__."/../conexion/bdConexion.php");
require_once(__DIR__."/../model/BuscadorMapper.php");
require_once(__DIR__."/../model/Buscador.php");

  class BuscarController{

    //Obtener coincidencias con la búsqueda de actividades.
    public static function getResultadosBusqueda($buscador){
      if(!isset($_SESSION)) session_start();
     $busq = Buscador::actividadesBuscadas($buscador);
     return $busq;
    }

  }
