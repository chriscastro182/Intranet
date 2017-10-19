<?php
require 'includes/conexion.php';
?>
      <div class="container">
          <form class="form-horizontal" enctype="multipart/form-data" action="guardarComentario.php" method="post" autocomplete="off">
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="comentario">Dejar un comentario, <?php echo $Nombre; ?>:</label>
                  <textarea class="form-control" name="comentario" rows="2" id="comentario" required></textarea>
                </div>
                <input type="hidden" name="idPost" value="<?php echo $row['idPost']; ?>">
              </div>
            </div>
              <div class="row">
                <div class="col-sm-5">
                  <input type="submit"class="btn-lg btn-primary pull-right" name="botonlg" value="Comentar" />
                </div>
              </div>
          </form>
        </div>
