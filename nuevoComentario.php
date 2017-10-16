<?php
require 'includes/conexion.php';
?>
      <div class="container">        
          <form class="form-horizontal" enctype="multipart/form-data" action="guardarComentario.php" method="post" autocomplete="off">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="comentario">Dejar un comentario, <?php echo $Nombre; ?>:</label>
                  <textarea class="form-control" name="comentario" rows="2" id="comentario" required></textarea>
                </div>
                <input type="hidden" name="idPost" value="<?php echo $row['idPost']; ?>">

              </div>
              <div class="col-sm-2">
                <br>
                <input type="submit"class="btn-lg btn-primary btn-block" name="botonlg" value="Comentar" />
              </div>
            </div>
          </form>
        </div>
