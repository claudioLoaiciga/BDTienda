<br>
<div class="card col-lg-7 mx-auto p-4 animate-in-down">
  <div class="card-header">
<div class="contTitleService">
    <div class="subContTitleService">
        <div id="titleService" class="container">
            <h1 class="page-header"><?php echo $emple->idEmpleado != null ? 'Editar Registro' : 'Nuevo Registro'; ?></h1>
        </div>
    </div>
</div>


<div class="container">
    <div>
        <ol class="breadcrumb">
            <li><a class="moduloTitle" href="?c=Empleado">Modulo de Empleados</a></li>
            <li id="NewEdit" class="active"><?php echo $emple->idEmpleado != null ? 'Editar Registro' : 'Nuevo Registro'; ?></li>
        </ol>
    </div>

    <form id="frm-empleado" action="  <?php echo $emple->idEmpleado != null ? ' ?c=Empleado&a=Actualizar' : ' ?c=Empleado&a=Guardar '; ?>" method="post" enctype="multipart/form-data" onsubmit="miFuncion()">
        <div class="form-group">
              <label>Identificacion</label>
              <input type="number" name="identificacion" value="<?php echo $emple->idEmpleado; ?>" <?php if(isset($emple->idEmpleado)) : echo "readonly";  endif;?> class="form-control" placeholder="Numero de identificacion" data-validacion-tipo="requerido|min:3"/>
          </div>

          <div class="form-group">
              <label>Nombre</label>
              <input type="text" name="nombre" required value="<?php echo $emple->nombre; ?>" class="form-control" placeholder="Ingrese su nombre" data-validacion-tipo="requerido|min:3" />
          </div>

          <div class="form-group">
              <label>Apellidos</label>
              <input type="text" name="apellidos" required value="<?php echo $emple->apellidos; ?>" class="form-control" placeholder="Ingrese su apellidos" data-validacion-tipo="requerido|min:3" />
          </div>

          <div class="form-group">
            <label>Telefono</label>
            <input type="text" name="telefono" required value="<?php echo $emple->telefono; ?>" class="form-control" placeholder="Ingrese su numero de telefono" data-validacion-tipo="requerido|min:3" />
        </div>

        <div class="form-group">
            <label>Puesto del empleado:</label>
            <select name="puesto" class="form-control" required>
                <option value="">No seleccionado</option>
                <option <?php echo $emple->puesto == 'Tecnico(a)' ? 'selected' : ''; ?> value="Tecnico(a)">Tecnico(a)</option>
                <option <?php echo $emple->puesto == 'Dependiente' ? 'selected' : ''; ?> value="Dependiente">Dependiente</option>
                <option <?php echo $emple->puesto == 'Miselaneo(a)' ? 'selected' : ''; ?> value="Miselaneo(a)">Miselaneo(a)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Clave</label>
            <input type="password" name="clave" value="<?php echo $emple->clave; ?>" class="form-control" placeholder="Ingrese su clave" data-validacion-tipo="requerido|min:4" minlength="6" />
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
        $("#frm-empleado").submit(function () {
            return $(this).validate();

        });
    })
</script>
