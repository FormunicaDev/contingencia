<?php
ini_set('display_error','On');
error_reporting(E_ALL);

/*$hostname_localhost="10.10.0.10";
$database_localhost="EXACTUS";
$username_localhost="gespinoza";
$password_localhost="Genet1995!";*/

$serverName = "10.10.0.10"; //serverName\instanceName
$connectionInfo = array( "Database"=>"EXACTUS", "UID"=>"gespinoza", "PWD"=>"Gdjeg1995","CharacterSet" => "UTF-8");

$conexion=sqlsrv_connect($serverName, $connectionInfo);
/*
if( $conexion ) {
    echo "Conexión establecida.<br />";
}else{
    echo "Conexión no se pudo establecer.<br />";
    die( print_r( sqlsrv_errors(), true));
}*/

?>