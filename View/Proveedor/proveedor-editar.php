<br>
<div class="card col-lg-7 mx-auto p-4 animate-in-down">
  <div class="card-header">
<div class="contTitleService">
    <div class="subContTitleService">
        <div id="titleService" class="container">
            <h1 class="page-header"><?php echo $prov->cedulaJuridica != null ? 'Editar Registro' : 'Nuevo Registro'; ?></h1>
        </div>
    </div>
</div>

<div class="container">
    <div>
        <ol class="breadcrumb">
            <li><a class="moduloTitle" href="?c=Proveedor">Modulo de Proveedor</a></li>
            <li id="NewEdit" class="active"><?php echo $prov->cedulaJuridica != null ? 'Editar Registro' : 'Nuevo Registro'; ?></li>
        </ol>
    </div>
    <form id="frm-empleado" action="<?php echo $prov->cedulaJuridica != null ? ' ?c=Proveedor&a=Actualizar' : ' ?c=Proveedor&a=Guardar';?>" method="post" enctype="multipart/form-data" onsubmit="miFuncion()">
        <div class="form-group">
            <label>Cedula Juridica</label>
            <input name="cedulaJuridica"  required type="number" value="<?php echo $prov->cedulaJuridica; ?>" <?php if(isset($prov->cedulaJuridica)) : echo "readonly";  endif;?> class="form-control" placeholder="Numero de cedula juridica" data-validacion-tipo="requerido|min:3"/>
        </div>

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" required value="<?php echo $prov->nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
        </div>

        <div class="form-group">
            <label>Telefono</label>
            <input type="number" name="telefono" required value="<?php echo $prov->telefono; ?>" class="form-control" placeholder="Ingrese el numero de telefono" data-validacion-tipo="requerido|min:3" />
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required value="<?php echo $prov->email; ?>" class="form-control" placeholder="Ingrese el correo electronico" data-validacion-tipo="requerido|min:3" />
        </div>

        <div class="form-group">
            <label>Tipo de proveedor:</label>
            <select name="tipo" class="form-control">
                <option value="">No seleccionado</option>
                <option <?php echo $prov->tipo == 'Repuestos' ? 'selected' : ''; ?> value="Repuestos">Repuesto</option>
                <option <?php echo $prov->tipo == 'Accesorios' ? 'selected' : ''; ?> value="Accesorios">Accesorios</option>
            </select>
        </div>

        <div class="text-right">
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
        $("#frm-proveedor").submit(function () {
            return $(this).validate();

        });
    })

</script>
