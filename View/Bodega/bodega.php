<?php
  if (isset($_GET['error1'])) {
    echo "<script language='JavaScript'>alert('Bodega agregada correctamente"
      . "');</script>";
      echo "
      <script> 
      location.href = 'index.php?c=Bodega'; 
      </script>
      ";
  }

  if (isset($_GET['verIndefinido'])) {
      echo "<script language='JavaScript'>alert('Debe seleccionar un ítem"
      . "');</script>";
      echo "
      <script> 
      location.href = 'index.php?c=Bodega'; 
      </script>
      ";
  }

  if (isset($_GET['Eliminar'])) {
    echo "<script language='JavaScript'>alert('Eliminado Correctamente"
    . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Bodega'; 
    </script>
    ";
  }
  if (isset($_GET['Actualizar'])) {
    echo "<script language='JavaScript'>alert('Bodega Actualizado Correctamente"
    . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Bodega'; 
    </script>
    ";
  }
?>


<div class="contTitleService">
    <!--<div class="subContTitleService">
        <div id="titleService" class="container">
            <h1 class="page-header">Bodega</h1>
        </div>
    </div>-->

<div class="card">
<form action="?c=Bodega" method="post">
  <div class="card-header">
    <h2>Bodega</h2>
    <br>
    <div class="well well-sm text-right">

        <div class="contLabelBuscar"> <!--Contenedor de busqueda-->
          <label class="labelBuscar">Buscar:</label>
          <input class="form-control" id="buscar" type="text"  placeholder="Escriba algo para buscar"  height="60px"/>
        </div> <!--Fin Contenedor de busqueda-->

          <div id="margenCont"> <!--Contenedor de botones-->
            <a id="botonRegistrar" class="btn btn-primary" href="?c=Bodega&a=Registrar">Registrar</a>
            <input id="botonEditar" type="submit" value="Editar" name="a" class="btn btn-primary"/>
            <input id="botonEliminar" type="submit" value="Eliminar" name="a" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-primary"/>
          </div> <!--Fin Contenedor de botones-->

          <table id="tabla" class="table table-striped">
            <thead> <!--Encabezado tabla-->
              <tr>
                <th class="spaceCol">Seleccionar</th>
                <th class="spaceCol">Codigo bodega</th>
                <th class="spaceCol">Nombre</th>
                <th class="spaceCol">Telefono</th>
                <th class="spaceCol">Direccion</th>
                <th class="spaceCol">Email</th>
                <!--<th class="spaceCol">Clave</th>-->
                <th class="spaceCol"></th>
              </tr>
            </thead> <!--Fin Encabezado tabla-->
            <tbody>
              <?php foreach ($this->model->ListarBodegas() as $emple): ?>
                <?php $valor = $emple->idBodega; ?>
                <tr>
                    <td><input id="marginRadio" type=radio name=id value=<?php echo $emple->idBodega; ?> ></td>
                    <td><?php echo $emple->idBodega; ?></td>
                    <td><?php echo $emple->nombre; ?></td>
                    <td><?php echo $emple->telefono; ?></td>
                    <td><?php echo $emple->direccion; ?></td>
                    <td><?php echo $emple->email; ?></td>
                    <!--<td><?php// echo $emple->clave; ?></td>-->
                </tr>
              <?php endforeach; ?>
            <script src="assets/js/buscador.js"></script>
          </tbody>
          </table>
    </div>
</form>
</div>
</div>
</div>
