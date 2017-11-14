<?php
require('includes/conexion.php');
$sql = "INSERT INTO `sistemaproceso` (`idSistemaProceso`, `nombreSistemaPro`) VALUES
('1', 'Contpaq'), ('2', 'Comercial'), ('3', 'Sicafi'), ('4', 'Digitalización'),
('5', 'Cálculo de abandono'), ('6', 'Interfaz comercial'), ('7', 'Facturación'),
('8', 'Monitoreo'), ('9', 'Control de Inventarios'), ('10', 'Consulta de Pedimentos')";

$procesos=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]");
if ($procesos) {
  echo "Consulta de procesos con éxito";
}
 ?>
