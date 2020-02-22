<br>
<div class="card col-lg-7 mx-auto p-4 animate-in-down">
<div class="contTitleService">
    <div class="subContTitleService">
        <div id="titleService" class="container">
            <h1 class="page-header"><?php echo $emple->idDetallePedido != null ? 'Editar Detalle del Pedido' : 'Nuevo Detalle del Pedido'; ?></h1>
        </div>
    </div>
</div>

<div class="container">
    <div>
        <ol class="breadcrumb">
            <li><a class="moduloTitle" href="?c=DetallePedido">Modulo de Detalle de Pedidos</a></li>
            <li id="NewEdit" class="active"><?php echo $emple->idDetallePedido != null ? 'Editar Detalle del Pedido' : 'Nuevo Detalle del Pedido'; ?></li>
        </ol>
    </div>

    <form id="frm-detallepedido" action="?c=DetallePedido&a=Guardar" method="post" enctype="multipart/form-data" onsubmit="miFuncion()">
        <div class="form-group">
            <label>Codigo del detalle del pedido</label>
            <input name="idDetallePedido" value="<?php echo $emple->idDetallePedido; ?>" class="form-control" placeholder="Codigo del detalle pedido" data-validacion-tipo="requerido|min:3"/>
        </div>

        <div class="form-group">
            <label>Cantidad</label>
            <input type="number" name="Cantidad" value="<?php echo $emple->Cantidad; ?>" class="form-control" min="0"/>
        </div>

        <div class="form-group">
            <label>Monto</label>
            <input type="text" name="Monto" value="<?php echo $emple->Monto; ?>" class="form-control" placeholder="Ingrese el monto a pagar" data-validacion-tipo="requerido|min:3" />
        </div>

        <div class="form-group">
            <label>Pedido:</label>
            <select name="idPedido" class="form-control">

              <!-- Este metodo llama de la base de datos los id de los empleados -->
              <option value="">No seleccionado</option>

              <?php foreach ($this->model->ListarPedidos() as $emp) :
                 $valor = $emp->idPedido; ?>
                 <option <?php echo $valor == $emp->idPedido ? 'selected' : ''; ?> value="<?php echo $valor ?>"><?php echo $emp->idPedido; ?></option>

              <?php endforeach; ?>
          <script src="assets/js/buscador.js"></script>
          </select>
        </div>

        <div class="form-group">
            <label>Producto:</label>
            <select name="Codigo" class="form-control">

              <!-- Este metodo llama de la base de datos los id de los empleados -->
              <option value="">No seleccionado</option>

              <?php foreach ($this->model->ListarProductos() as $emp) :
                 $valor = $emp->Codigo; ?>
                 <option <?php echo $valor == $emp->Codigo ? 'selected' : ''; ?> value="<?php echo $valor ?>"><?php echo $emp->Codigo; ?></option>

              <?php endforeach; ?>
          <script src="assets/js/buscador.js"></script>
          </select>
        </div>

        <div class="text-right">
            <button id="botonGuardar" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div class="container">
<br>
<br>
  </div>

<script>
    $(document).ready(function () {
        $("#frm-detallepedido").submit(function () {
            return $(this).validate();

        });
    })

</script>
