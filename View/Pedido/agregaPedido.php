<br>
<div class="card col-lg-12 mx-auto p-6 animate-in-down">
    <div class="card-header">
        <div class="container">
            <h1 class="page-header" align="center">Gestión de Pedido</h1>
            <form  method="POST" action="?c=Pedido&a=Guardar" enctype="multipart/form-data" id="factura" name="factura">
            <div id="oculto" style="display:none;">
                    <br>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <ul id="alertDatosIncompletos" name="alertDatosIncompletos">
                        </ul>
                        <button type="button" class="close" onclick="ocultarDiv();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="cbp-mc-form">
                    <div class="cbp-mc-column">
                        <label>Fecha:</label>
                        <input class="form-control" readonly="readonly" type="text" id="txtFecha" name="txtFecha" value="<?php echo date("Y-m-d"); ?>" />
                    </div>

                    <div class="cbp-mc-column">
                      <label>Direccion</label>
                        <input class="form-control"  type="text" id="txtDireccion" name="txtDireccion" placeholder="ingrese la direccion" />
                    </div>

                    <div class="cbp-mc-column">
                        <label>Cantidad de Productos:</label>
                        <input class="form-control" readonly="readonly" type="text" id="cantArticulo" name="cantArticulo" id="cantArticulo" placeholder="0" />
                    </div>
                    <div class="cbp-mc-column">
                        <label>Empleado</label>
                        <input class="form-control" required="" readonly type="text" id="txtEmpleado" name="txtEmpleado" placeholder="Cedula Empleado" data-validacion-tipo="requerido|min:3" />
                        <button type="button" id="botonGuardar" class="btn btn-primary" style="margin-top: 5px"  data-toggle="modal" data-target="#Empleado">
                            Buscar Empleado
                        </button>
                    </div>
                </div>
                <hr style="background:black; with:400px">
                <div>
                    <h2>Productos</h2>
                </div>
                <div>
                    <th> <button type="button" id="botonGuardar" class="btn btn-primary" data-toggle="modal" data-target="#producto">
                            Agregar Productos
                        </button>
                    </th>

                    <div>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Codigo</th>
                                    <th> Descripcion</th>
                                    <th> Cantidad</th>
                                    <th> Precio</th>
                                    <th> Subtotal</th>
                                    <th> Eliminar</th>
                                </tr>
                            </thead>
                            <tbody class="table" id="tbDetalle">

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div>
                        <button id="botonGuardar" class="btn btn-success">Guardar</button>
                        <button id="botonGuardar" class="btn btn-success"><a href="index.php?c=Pedido" style="color: white;">Cancelar</a></button>

                    </div>
                    <div>
                        <table align="right">
                            <tr>
                                <th> <b> Monto: </b></th>
                                <td>
                                    <input readonly="readonly" type="text" name="txtSubtotal" id="txtSubtotal" />
                                </td>
                          <!--  <tr>
                                <th>Impuestos: </th>
                                <td>
                                    <input readonly="readonly" type="text" name="txtImp" id="txtImp" />
                                </td>

                            <tr>
                                <th>Total: </th>
                                <td>
                                    <input readonly="readonly" type="text" name="txtTotal" id="txtTotal" />
                                </td>
                            </tr>-->
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
    </div>
</div>



<!-- Modal -->
<!--<div class="modal" id="exampleModalCentered" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width:50%">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalCenteredLabel">Buscar Cliente:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?c=Cliente" method="post">
                    <div class="well well-sm text-right">

                        <div style="float:left; width:300px;" class="contLabelBuscar">

                            <label style="float: left; height: 60px; margin-top: 7px; margin-right: 7px" class="labelBuscar">Buscar:</label>
                            <input class="form-control" id="buscar" type="text" placeholder="Escriba algo para buscar" style="width:230px;" height="60px" />
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabla" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="spaceCol">Identificacion</th>
                                    <th class="spaceCol">Nombre</th>
                                    <th class="spaceCol">Apellidos</th>
                                    <th class="spaceCol"> Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                </*?php foreach ($this->modelCli->ListarClientes() as $clie) : ?>
                                    </*?php $valor = $clie->cedula; ?>
                                    <tr>
                                        <td></*?php echo $clie->cedula; ?></td>
                                        <td></*?php echo $clie->nombre; ?></td>
                                        <td></*?php echo $clie->apellidos; ?></td>
                                        <td class='text-center'><a class='btn btn-info' id="botonGuardar" href="#" onclick="agregarCliente('</*?php echo $clie->cedula ?>')"><i class="glyphicon glyphicon-plus"></i>Agregar</a></td>
                                    </tr>
                                </*?php endforeach; ?>
                                <script src="assets/js/buscador.js"></script>
                            </tbody>
                        </table>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar </button>
            </div>
        </div>
    </div>
</div>-->

<!-- Termina Modal Cliente -->

<!-- Modal Empleado -->
<div class="modal" id="Empleado" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="width:50%">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalCenteredLabel">Buscar Empleado:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?c=Empleado" method="post">
                    <div class="well well-sm text-right">

                        <div style="float:left; width:300px;" class="contLabelBuscar">
                            <!--Contenedor de busqueda-->
                            <label style="float: left; height: 60px; margin-top: 7px; margin-right: 7px" class="labelBuscar">Buscar:</label>
                            <input class="form-control" id="buscar2" type="text" placeholder="Escriba algo para buscar" style="width:230px;" height="60px" />
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabla2" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="spaceCol">Identificacion</th>
                                    <th class="spaceCol">Nombre</th>
                                    <th class="spaceCol">Apellidos</th>
                                    <th class="spaceCol"> Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->modelEmp->ListarEmpleados() as $emple) : ?>
                                    <?php $valor = $emple->idEmpleado; ?>
                                    <tr>
                                        <td><?php echo $emple->idEmpleado; ?></td>
                                        <td><?php echo $emple->nombre; ?></td>
                                        <td><?php echo $emple->apellidos; ?></td>
                                        <td class='text-center'><a class='btn btn-info' id="botonGuardar" href="#" onclick="agregarEmpleado('<?php echo $emple->idEmpleado ?>')"><i class="glyphicon glyphicon-plus"></i>Agregar</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                <script src="assets/js/buscarEmpleado.js"></script>
                            </tbody>
                        </table>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar </button>
            </div>
        </div>
    </div>
</div>

<!-- Termina Modal Empleado -->
<div class="modal" id="producto" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:50%">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalCenteredLabel">Buscar Producto:</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?c=Empleado" method="post">
                    <div class="well well-sm text-right">

                        <div style="float:left; width:300px;" class="contLabelBuscar">
                            <!--Contenedor de busqueda-->
                            <label style="float: left; height: 60px; margin-top: 7px; margin-right: 7px" class="labelBuscar">Buscar:</label>
                            <input class="form-control" id="buscar3" type="text" placeholder="Escriba algo para buscar" style="width:230px;" height="60px" />
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabla3" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="spaceCol">Codigo</th>
                                    <th class="spaceCol">Descripcion</th>
                                    <th class="spaceCol">Cantidad</th>
                                    <th class="spaceCol">Precio</th>
                                    <th class="spaceCol"> Agregar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($this->modelProducto->ListarProductos() as $emple) : ?>
                                    <tr>
                                        <td><?php echo $emple->codigo; ?></td>
                                        <td><input class="form-control" readonly="readonly" type="text" name="nombre_" id="nombre_<?php echo $emple->codigo; ?>" value="<?php echo $emple->nombreProducto; ?>" /></td>
                                        <td><input class="form-control" type="text" name="cantidad_" id="cantidad_<?php echo $emple->codigo; ?>" value="1"></td>
                                        <td><input class="form-control" readonly="readonly" type="text" name="precio_" id="precio_<?php echo $emple->codigo; ?>" value="<?php echo $emple->precio; ?>" /></td>
                                        <td class='text-center'><a class='btn btn-info' id="botonGuardar" href="#" onclick="agregar('<?php echo $emple->codigo ?>')"><i class="glyphicon glyphicon-plus"></i>Agregar</a></td>
                                    </tr>
                                <?php endforeach; ?>



                                <script src="assets/js/buscarProducto.js"></script>
                            </tbody>
                        </table>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar </button>
            </div>
        </div>
    </div>
</div>

