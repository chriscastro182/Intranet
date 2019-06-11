<?php
require("includes/conexion.php");
//var_dump($_POST);

if (isset($_POST['idOficio'])) {
    $id = $_POST['idOficio'];
    $sql = "SELECT * FROM intranet.oficio WHERE idOficio = '$id'";
    $resultado = $mysqli->query($sql);
    if ($resultado->num_rows) {
        $obj = $resultado->fetch_object();
        $idOficio = $obj->idOficio;
        //var_dump($obj);
    }
    
} ?>
<html lang="es">
	<head>
		<?php require ('head.php'); ?>        
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">                    
            <?php if($resultado->num_rows) { ?>
                    <div class="well">
                        <h4>Oficio: <?php echo $obj->oficio ?></h4>
                        <div class="container">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Consecutivo</th>
                                        <th>Fecha de notificación</th>
                                        <th>Fecha de oficio</th>
                                        <th>Destino</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $obj->idOficio ?></td>
                                        <td><?php echo $obj->fechaNotificacion ?></td>
                                        <td><?php echo $obj->fechaoficio ?></td>
                                        <td><?php echo $obj->destino ?></td>
                                    </tr>                                    
                                </tbody>
                            </table>
                            <p><?php echo $obj->observacion; ?></p>
                        </div>
                    </div>
                    <a href="recalculo.php?id=<?php echo $obj->idOficio; ?>" class="btn btn-danger">Realizar cálculo con la tarifa actual, al oficio: <?php echo $obj->oficio ?></a>
            <?php } else { ?>
					<h3>No existe el oficio con # incrementativo: <?php echo $_POST['idOficio']; ?> que desea recalcular</h3>
            <?php } ?>
					<a href="menuAbandono.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
