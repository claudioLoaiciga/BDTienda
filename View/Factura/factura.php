<?php
  if (isset($_GET['error1'])) {
    echo "<script language='JavaScript'>alert('Factura agregada correctamente"
      . "');</script>";
    //header('refresh:0; url=index.php?c=Factura');
    echo "
    <script> 
    location.href = 'index.php?c=Factura'; 
    </script>
    ";
  }

  if (isset($_GET['verIndefinido'])) {
      echo "<script language='JavaScript'>alert('Debe seleccionar un ítem"
      . "');</script>";
      echo "
    <script> 
    location.href = 'index.php?c=Factura'; 
    </script>
    ";
  }

  if (isset($_GET['eliminarIndefinido'])) {
    echo "<script language='JavaScript'>alert('Debe seleccionar un ítem"
    . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Factura'; 
    </script>
    ";
  }
  if (isset($_GET['Eliminar'])) {
    echo "<script language='JavaScript'>alert('Debe seleccionar un ítem"
    . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Factura'; 
    </script>
    ";
  }
?>
<div class="contTitleService">
  <br>

  <div class="card">
    <form action="?c=Factura" method="POST" id="Tablafactura" name="Tablafactura">
      <div class="card-header">
        <h2> Factura </h2>
        <br>
        <div class="well well-sm text-right">
          
        <div id="ocultoFactura" style="display:none;">
            <br>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <ul id="alertDatosIncompletosFactura" name="alertDatosIncompletos">
              </ul>
              <button type="button" class="close" onclick="ocultarDiv();" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
         
          <div class="contLabelBuscar">
            <!--Contenedor de busqueda-->
            <label class="labelBuscar">Buscar:</label>
            <input class="form-control" id="buscar" type="text" placeholder="Escriba algo para buscar" height="60px" />
          </div>
          <!--Fin Contenedor de busqueda-->

          <div id="margenCont">
            <!--Contenedor de botones-->
            <a id="botonRegistrar" class="btn btn-primary" href="?c=Factura&a=Registrar">Registrar</a>
            <!-- <input type="submit" title="Buscar Factura" value="Eliminar" name="a"/> -->
            <input id="botonEditar" type="submit" value="Ver" name="a" class="btn btn-primary" />
            <input id="botonEliminar" type="submit" value="Eliminar" name="a" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-primary" />
          </div>
          <!--Fin Contenedor de botones-->

          <table id="tabla" class="table table-striped">
            <thead>
              <!--Encabezado tabla-->
              <tr>
                <th class="spaceCol">Seleccionar</th>
                <th class="spaceCol">Numero de compra</th>
                <th class="spaceCol">Fecha</th>
                <th class="spaceCol">Impuesto</th>
                <th class="spaceCol">Descuento</th>
                <th class="spaceCol">Empleado</th>
                <th class="spaceCol">Total</th>
                <th class="spaceCol">Cliente</th>
                <th class="spaceCol"></th>
              </tr>
            </thead>
            <!--Fin Encabezado tabla-->
            <tbody>
              <?php foreach ($this->model->ListarFacturas() as $fac) : ?>
                <?php $valor = $fac->numeroCompra; ?>
                <tr>
                  <td><input id="numeroCompra" type=radio name='numeroCompra' value=<?php echo $fac->numeroCompra; ?>></td>
                  <td><?php echo $fac->numeroCompra; ?></td>
                  <td><?php echo $fac->fecha; ?></td>
                  <td><?php echo $fac->impuesto; ?></td>
                  <td><?php echo $fac->descuento; ?></td>
                  <td><?php echo $fac->empleado; ?></td>
                  <td><?php echo $fac->total; ?></td>
                  <td><?php echo $fac->cliente; ?></td>
                </tr>
              <?php endforeach; ?>
              <script src="assets/js/buscador.js"></script>
            </tbody>
          </table>
        </div>
    </form>
  </div>
</div>