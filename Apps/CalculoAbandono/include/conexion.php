<?php
$servidor = "localhost"; //el servidor que utilizaremos, en este caso será el localhost
$usuario = "root"; //El usuario que acabamos de crear en la base de datos
$contrasenha = ""; //La contraseña del usuario que utilizaremos
$db = "intranet"; //El nombre de la base de datos
$mysqli= new mysqli($servidor,$usuario,$contrasenha,$db);
if($mysqli->connect_error){
    die('Error en la conexion'.$mysqli->connect_error);
}
 ?>
