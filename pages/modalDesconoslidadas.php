<!-- Modal -->
<div id="<?php echo $idMaster; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <?php
  $sql = "SELECT * FROM registrodescon WHERE RegistroVD_idRegistroVD = '$idMaster'";
  $guiasDes=$mysqli->query($sql) or trigger_error($mysqli->error."[$sql]"); ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Guía Master: <?php echo $rowGuias['guiaMaster']; ?></h4>
      </div>
      <div class="modal-body">
            <table class="table table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Guía Master</th>
              <th>Guía House</th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php while ($rowGuiasDes = $guiasDes->fetch_array(MYSQLI_ASSOC)) { ?>
                <tr>
                  <td><?php echo $rowGuiasDes['numDesconsol']+1; ?></td>
                  <td><?php echo $rowGuias['guiaMaster']; ?></td>
                  <td><?php echo $rowGuiasDes['guiaHouse']; ?></td>
                  <td><a href="editarDigitalizacionH.php?id=<?php echo $rowGuiasDes['idRegistroDescon']; ?>" >
                      <i class="fas fa-edit"></i>
                    </a>
                  </td>
                  <td>
                    <a href="eliminarRegistroDescon.php?id=<?php echo $rowGuiasDes['idRegistroDescon']; ?>" >
                        <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
            <?php } ?>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar </button>
      </div>
    </div>
  </div>
</div>
