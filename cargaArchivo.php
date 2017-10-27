<?php
  if($_FILES["archivo"]["error"]>0){
    echo "Error al cargar archivo";
    } else {
    $permitidos = array("application/pdf");
    $limite_kb = 500024;
    if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 1024){
      $ruta = 'PDFs/'.$idVuelo.'/';
      $archivo = $ruta.$_FILES["archivo"]["name"];
      if(!file_exists($ruta)){
        mkdir($ruta, 0755, true);
      }
      if(!file_exists($archivo)){
        $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
        if($resultado){
          $sql = "UPDATE vuelodigitalizacion SET documentoVD='$archivo', estatusVD='5' WHERE idVueloDigitalizacion = '$idVuelo'";
          echo $sql;
          $resultado = $mysqli->query($sql);
          } else {
          echo "Error al guardar archivo";
        }
        } else {
        echo "Archivo ya existe";
         }
      } else {
      echo "Archivo no permitido o excede el tamaño";
    }
  }
 ?>
