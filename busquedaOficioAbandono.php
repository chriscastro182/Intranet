<?php
require("includes/conexion.php");
//var_dump($_POST);

if (isset($_POST['idOficio'])) {
    $id = $_POST['idOficio'];
    $sql = "SELECT * FROM intranet.oficio WHERE idOficio = '$id'";
    $resultado = $mysqli->query($sql);
    if ($resultado->num_rows) {
        $obj = $resultado->fetch_object();
    }
    
} ?>
<html lang="es">
	<head>
		<?php require ('head.php'); ?>
        <script>
            function redireccionar(url) {
                window.location.replace(url);
            }            
        </script>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
                    <?php if($resultado->num_rows) 
                    {
                        echo "<script>redireccionar('oficio.php?id=".$obj->idOficio."')</script>";
                    } else { ?>
						<h3>No existe un oficio con # incrementativo: <?php echo $_POST['idOficio']; ?></h3>
			  <?php } ?>
					<a href="menuAbandono.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>
