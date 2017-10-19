<?php
require 'includes/conexion.php';
if(!isset($_SESSION))
    {
        session_start();
    }
if (isset($_SESSION['Rol_idRol'])!=2 || isset($_SESSION['Rol_idRol'])!=1) {
  header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php require('head.php'); ?>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php require('nav.php'); ?>
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <img src="images/BannerPostNuevo.png" class="page-header" width="100%">
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <div class="container">
            <div class="row">
              <h2>Crear un publicación para el apartado de noticias:</h2>
            </div>
              <form class="form-horizontal" enctype="multipart/form-data" action="guardarPost.php" method="post" autocomplete="off">
                <div class="row">
                  <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input class="form-control" name="titulo" id="titulo" required></input>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="contenido">Texto de la noticia:</label>
                      <textarea class="form-control" name="contenido" rows="5" id="contenido" required></textarea>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="archivo" class="col-sm-1 control-label">Anexar foto:</label>
                      <input type="file" class="form-control" id="archivo" name="archivo" accept="image/*">
                    </div>
                    <input type="submit"class="btn-lg btn-success btn-block" name="botonlg" value="Publicar" />
                  </div>
                </div>
              </form>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>

</html>
