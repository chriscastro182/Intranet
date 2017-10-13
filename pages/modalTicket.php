  <div class="modal fade" id="<?php echo $idTicket; ?>" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <?php
        $sqlPOP= "SELECT * FROM reporte WHERE idReporte = $idTicket";
        $resulTicketAPOP = $mysqli->query($sqlPOP);
        $rowPOP = $resulTicketAPOP->fetch_array(MYSQLI_ASSOC);
        $validaImagen="";
        if ($rowPOP['evidencia']==NULL) {
          $validaImagen="hidden";
        }
        // Consulta para obtener al solicitante
        $foraneaReporte =$rowPOP['Solicitante_idSolicitante'];
        $sqlSol="SELECT * FROM solicitante WHERE idSolicitante = $foraneaReporte";
        $resulSoli = $mysqli->query($sqlSol);
        $rowSoli = $resulSoli->fetch_array(MYSQLI_ASSOC);
        // Consulta para obtener al usuario, tomando como foránea al solicitante
        $foraneaSolicitante= $rowSoli['Usuario_idUsuario'];
        $sqlUsr="SELECT * FROM usuario WHERE idUsuario = $foraneaSolicitante";
        $resulUsr = $mysqli->query($sqlUsr);
        $rowUsr = $resulUsr->fetch_array(MYSQLI_ASSOC);

        // Consulta para obtener a la persona asignada a ese ticket
        $foraneaReporte =$rowPOP['Solucionador_idSolucionador'];
        $sqlSol="SELECT * FROM solucionador WHERE idSolucionador = $foraneaReporte";
        $resulSolu = $mysqli->query($sqlSol);
        $rowSolu = $resulSolu->fetch_array(MYSQLI_ASSOC);
        // Consulta para obtener los datos del encargado de ese ticket, tomando como foránea al solucionador
        $foraneaSolucionador= $rowSolu['Usuario_idUsuario'];
        $sqlS="SELECT * FROM usuario WHERE idUsuario = $foraneaSolucionador";
        $resulS = $mysqli->query($sqlS);
        $rowS = $resulS->fetch_array(MYSQLI_ASSOC);
      ?>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-3">
              <h3 class="modal-title">Ticket # <?php echo $rowPOP['idReporte']; ?></h3>
            </div>
            <div class="col-sm-4">
              <h4>Solicitante: <?php echo $rowUsr['nombresU']." ".$rowUsr['apellidosU']; ?></h4>
            </div>
            <div class="col-sm-5">
              <h4>Atendido por: <?php echo $rowS['nombresU']." ".$rowS['apellidosU']; ?></h4>
            </div>
          </div>
          <p>
            <h3><?php echo $rowPOP['descripcion']; ?></h3>
          </p>
          <img <?php echo $validaImagen; ?> src="<?php echo $rowPOP['evidencia'];?>" class="img-thumbnail" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>

    </div>
  </div>
