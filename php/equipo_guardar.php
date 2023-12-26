<?php

require_once "../inc/inicio_de_sesion.php";
require_once "../php/main.php";

/* Almacenamiento de datos */
$activo=limpiar_cadena($_POST['equipo_activo']);
$sector=limpiar_cadena($_POST['equipo_sector']);
$piso=limpiar_cadena($_POST['equipo_piso']);
$ubicacion=limpiar_cadena($_POST['equipo_ubicacion']);
$serie=limpiar_cadena($_POST['equipo_serie']);
$marca=limpiar_cadena($_POST['equipo_marca']);
$modelo=limpiar_cadena($_POST['equipo_modelo']);
$responsable=limpiar_cadena($_POST['equipo_responsable']);
$categoria=limpiar_cadena($_POST['equipo_categoria']);

/* Verificación de datos obligatorios */
if($activo=="" || $sector=="" || $piso=="" || $ubicacion=="" || $serie=="" || $marca=="" ||
 $modelo=="" || $responsable=="" || $categoria==""){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    No llenaste todos los datos solicitados
  </div>';
    exit();
}

/* Verificación de integridad de datos */
if(verificar_datos("[0-9]{3,40}", $activo)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos del Activo Fijo no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $sector)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos del Sector no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-Z0-9]{1,20}", $piso)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos del Piso no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{2,40}", $ubicacion)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos de la Ubicación no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-Z0-9]{7,100}", $serie)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos del Serial no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,100}", $marca)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos de la Marca no corresponden con el formato solicitado
  </div>';
    exit();

}


if(verificar_datos("[a-zA-Z0-9().,$#\-\/ ]{3,100}", $modelo)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos del Modelo no corresponden con el formato solicitado
  </div>';
    exit();
}

if(verificar_datos("[a-zA-Z0-9]{2,100}", $responsable)){
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Ups ocurrio un problema!</strong><br>
    Los datos del Responsable no corresponden con el formato solicitado
  </div>';
    exit();
}

/* verificar activo */
$check_activo=conexion();
$check_activo=$check_activo->query("SELECT equipo_activo From equipos where equipo_activo='$activo'");
if($check_activo->rowCount()>0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Ups ocurrio un error inesperado!</strong><br>
  El Activo Fijo ya esta ingresado
  </div>
  ';
  exit();

}
$check_activo=null;

/*verificar serie */
$check_serie=conexion();
$check_serie=$check_serie->query("SELECT equipo_serie From equipos where equipo_serie='$serie'");
if($check_serie->rowCount()>0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Ups ocurrio un error inesperado!</strong><br>
  El Numero de serie ya esta ingresado
  </div>
  ';
  exit();

}
$check_serie=null;

/*verificar categoria */
$check_categoria=conexion();
$check_categoria=$check_categoria->query("SELECT id_categoria From categoria where id_categoria='$categoria'");
if($check_categoria->rowCount()<=0){
  echo'
  <div class="notification is-danger is-light">
  <strong>¡Ups ocurrio un error inesperado!</strong><br>
  La Categoria no existe
  </div>
  ';
  exit();

}
$check_categoria=null;

      
  	/* Guardando datos */
    $guardar_equipo=conexion();
    $guardar_equipo=$guardar_equipo->prepare("INSERT INTO equipos (equipo_activo,equipo_sector,equipo_piso,equipo_ubicacion,
    equipo_serie,equipo_marca,equipo_modelo,equipo_responsable,id_categoria) VALUES(:activo,:sector,:piso,:ubicacion,:serie,:marca,:modelo,:responsable,:categoria)");

    $marcadores=[
        ":activo"=>$activo,
        ":sector"=>$sector,
        ":piso"=>$piso,
        ":ubicacion"=>$ubicacion,
        ":serie"=>$serie,
        ":marca"=>$marca,
        ":modelo"=>$modelo,
        ":responsable"=>$responsable,
        ":categoria"=>$categoria        
    ];

    $guardar_equipo->execute($marcadores);

    if($guardar_equipo->rowCount()==1){
        echo '
        <div class="notification is-info is-light">
        <strong>¡Equipo Registrado!</strong><br>
        El equipo se registro correctamente
    </div>
';
}else{
echo '
    <div class="notification is-danger is-light">
        <strong>¡Ups ocurrio un error inesperado!</strong><br>
        No se pudo registrar el equipo, por favor intente nuevamente
    </div>
        ';
    }
    $guardar_equipo=null;