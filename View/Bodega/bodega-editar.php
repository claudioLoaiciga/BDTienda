<br>
<div class="card col-lg-7 mx-auto p-4 animate-in-down">
  <div class="card-header">
<div class="contTitleService">
    <div class="subContTitleService">
        <div id="titleService" class="container">
            <h1 class="page-header"><?php echo $emple->idBodega != null ? 'Editar Registro' : 'Nuevo Registro'; ?></h1>
        </div>
    </div>
</div>

<div class="container">
    <div>
        <ol class="breadcrumb">
            <li><a class="moduloTitle" href="?c=Bodega">Modulo de Bodega</a></li>
            <li id="NewEdit" class="active"><?php echo $emple->idBodega != null ? 'Editar Registro' : 'Nuevo Registro'; ?></li>
        </ol>
    </div>

    <form id="frm-bodega" action="<?php echo $emple->idBodega != null ? ' ?c=Bodega&a=Actualizar' : ' ?c=Bodega&a=Guardar';?>" method="post" enctype="multipart/form-data" onsubmit="miFuncion()">
        <div class="form-group">
              <label>Codigo de bodega</label>
              <input name="idBodega" required type="number" value="<?php echo $emple->idBodega; ?>" <?php if(isset($emple->idBodega)) : echo "readonly";  endif;?> class="form-control" placeholder="Codigo de bodega" data-validacion-tipo="requerido|min:3"/>
          </div>

          <div class="form-group">
              <label>Nombre</label>
              <input type="text" name="nombre" required value="<?php echo $emple->nombre; ?>" class="form-control" placeholder="Ingrese su nombre de bodega" data-validacion-tipo="requerido|min:3" />
          </div>

          <div class="form-group">
            <label>Telefono</label>
            <input type="text" name="telefono" required value="<?php echo $emple->telefono; ?>" class="form-control" placeholder="Ingrese su numero de telefono" data-validacion-tipo="requerido|min:3" />
          </div>

          <div class="form-group">
            <label>Direccion</label>
            <input type="text" name="direccion" required value="<?php echo $emple->direccion; ?>" class="form-control" placeholder="Ingrese la direccion" data-validacion-tipo="requerido|min:3" />
          </div>

        <div class="form-group">
          <label>Email</label>
          <input type="text" name="email" required value="<?php echo $emple->email; ?>" class="form-control" placeholder="Ingrese email" data-validacion-tipo="requerido|min:3" />
        </div>

        <div class="text-right"> <!--contenedor boton guardar registro-->
            <button id="botonGuardar" class="btn btn-success">Guardar</button>
        </div>
      </form>
  </div>
  <br>
  <br>
    </div>
  </div>
<script>
    $(document).ready(function () {
        $("#frm-bodega").submit(function () {
            return $(this).validate();

        });
    })
</script>
