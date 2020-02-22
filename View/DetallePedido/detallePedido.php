<div class="contTitleService">
  <br>
<div class="contTitleService">
<!--    <div class="subContTitleService">
        <div id="titleService" class="container">
            <h1 class="page-header">Detalle del Pedido</h1>
        </div>
    </div>
</div>-->
  <div class="card">
<form action="?c=DetallePedido" method="post">
  <div class="card-header">
    <h2>  Empleados</h2>
    <br>
  <div class="well well-sm text-right">
    <div class="contLabelBuscar">
          <label class="labelBuscar">Buscar:</label>
          <input class="form-control" id="buscar" type="text"  placeholder="Escriba algo para buscar"  height="60px"/>
      </div>

      <div id="margenCont">
          <a id="botonRegistrar" class="btn btn-primary" href="?c=DetallePedido&a=Registrar">Realizar pedido</a>
          <input id="botonEditar" type="submit" value="Editar" name="a" class="btn btn-primary"/>
          <input id="botonEliminar" type="submit" value="Eliminar" name="a" onclick="javascript:return confirm('¿Seguro de eliminar este pedido?');" class="btn btn-primary"/>
      </div>
  </div>

  <table id="tabla" class="table table-striped">
      <thead>
          <tr>
              <th class="spaceCol">Seleccionar</th>
              <th class="spaceCol">Codigo del detalle del pedido</th>
              <th class="spaceCol">Cantidad</th>
              <th class="spaceCol">Monto</th>
              <th class="spaceCol">Pedido</th>
              <th class="spaceCol">Producto</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($this->model->Listar() as $emple): ?>
              <?php $valor = $emple->idDetallePedido; ?>
              <tr>
                  <td><input id="marginRadio" type=radio name=id value=<?php echo $emple->idDetallePedido; ?> ></td>
                  <td><?php echo $emple->idDetallePedido; ?></td>
                  <td><?php echo $emple->Cantidad; ?></td>
                  <td><?php echo $emple->monto; ?></td>
                  <td><?php echo $emple->pedido; ?></td>
                  <td><?php echo $emple->producto; ?></td>
              </tr>
          <?php endforeach; ?>
      <script src="assets/js/buscador.js"></script>
      </tbody>
  </table>
</form>
</div>
</div>
</div>
</div>
