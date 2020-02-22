<?php
  if (isset($_GET['error1'])) {
    echo "<script language='JavaScript'>alert('Cliente agregado correctamente"
      . "');</script>";
    //header('refresh:0; url=index.php?c=Factura');
    echo "
    <script> 
    location.href = 'index.php?c=Cliente'; 
    </script>
    ";
  }

  if (isset($_GET['verIndefinido'])) {
      echo "<script language='JavaScript'>alert('Debe seleccionar un ítem"
      . "');</script>";
      echo "
      <script> 
      location.href = 'index.php?c=Cliente'; 
      </script>
      ";
  }
  if (isset($_GET['tipoCliente'])) {
    echo "<script language='JavaScript'>alert('No se puede eliminar este cliente"
    . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Cliente'; 
    </script>
    ";
}

  if (isset($_GET['Eliminar'])) {
    echo "<script language='JavaScript'>alert('Eliminado Correctamente"
    . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Cliente'; 
    </script>
    ";
  }
  if (isset($_GET['Actualizar'])) {
    echo "<script language='JavaScript'>alert('Cliente Actualizado Correctamente"
    . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Cliente'; 
    </script>
    ";
  }
?>


<div class="contTitleService">


<div class="card">
<form action="?c=Cliente" method="post">
<div class="card-header">
    <h1 class="page-header">Cliente</h1>
    <br>
    <div class="well well-sm text-right">

      <div  style= "float:left; width:300px;"class="contLabelBuscar"> <!--Contenedor de busqueda-->
        <label style="float: left;
        height: 60px;
        margin-top: 7px;
        margin-right: 7px"class="labelBuscar">Buscar:</label>
        <input class="form-control" id="buscar" type="text"  placeholder="Escriba algo para buscar" style="width:230px;" height="60px"/>
      </div>

        <div id="margenCont">
            <a id="botonRegistrar" class="btn btn-success" href="?c=Cliente&a=Registrar">Registrar</a>
            <input id="botonEditar" type="submit" value="Editar" name="a" class="btn btn-primary"/>
            <input id="botonEliminar" type="submit" value="Eliminar" name="a" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-danger"/>
        </div>
    </div>

    <table id="tabla" class="table table-striped">
        <thead>
            <tr>
                <th class="spaceCol">Seleccionar</th>
                <th class="spaceCol">Identificacion</th>
                <th class="spaceCol">Nombre</th>
                <th class="spaceCol">Apellidos</th>
                <th class="spaceCol">Telefono</th>
                <th class="spaceCol">Direccion</th>
                <th class="spaceCol">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->model->ListarClientes() as $clie): ?>
                <?php $valor = $clie->cedula; ?>
                <tr>
                    <td><input id="marginRadio" type=radio name=id value=<?php echo $clie->cedula; ?> ></td>
                    <td><?php echo $clie->cedula; ?></td>
                    <td><?php echo $clie->nombre; ?></td>
                    <td><?php echo $clie->apellidos; ?></td>
                    <td><?php echo $clie->telefono; ?></td>
                    <td><?php echo $clie->direccion; ?></td>
                    <td><?php echo $clie->email; ?></td>
                </tr>
            <?php endforeach; ?>
        <script src="assets/js/buscador.js"></script>
        </tbody>
    </table>
</form>
</div>
</div>
</div>
