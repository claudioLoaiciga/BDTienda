<br>
<div class="card col-lg-12 mx-auto p-6 animate-in-down">
    <div class="card-header">
        <div class="container">
            <h1 class="page-header" align="center">Gestion pedido</h1>
            <form id="frm-factura" method="POST" action="?c=Pedido&a=Guardar" enctype="multipart/form-data" onsubmit="miFuncion()">

                <div class="cbp-mc-form">

                    <div class="cbp-mc-column">
                        <label>Fecha:</label>
                        <input class="form-control" readonly="readonly" type="text" id="txtfecha" name="txtfecha" value="<?php echo $fac->fecha;  ?>" />
                    </div>

                    <div class="cbp-mc-column">
                        <label>Dirección del envío:</label>
                        <input class="form-control" readonly="readonly" type="text" id="cantArticulo" name="cantArticulo" value="<?php echo $fac->direccionEnvio; ?>" id="cantArticulo" placeholder="0" />
                    </div>
                    <div class="cbp-mc-column">
                        <label>Empleado</label>
                        <input class="form-control" required="" readonly type="text" id="txtEmpleado" name="txtEmpleado" value="<?php echo $fac->empleado  ?>" placeholder="Cedula Empleado" data-validacion-tipo="requerido|min:3" />
                    </div>
                </div>
                <hr style="background:black; with:400px">
                <div>
                    <h2>Productos</h2>
                </div>
                <div>

                    <div>
                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Codigo</th>
                                    <th>Descripcion</th>
                                    <th> Cantidad</th>
                                    <th> Precio</th>
                                    <th> Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="table" id="tbDetalle">
                                <?php foreach ($this->model->ListarDetallePedido($fac->idPedido) as $user) : ?>
                                    <tr>
                                        <td class="tt"><?php echo $user->producto; ?></td>
                                        <td class="tt"><?php echo $user->descripcion; ?></td>
                                        <td class="tt"><?php echo $user->cantidad; ?></td>
                                        <td class="tt"><?php echo $user->monto; ?></td>
                                        <td class="tt"><?php echo ($user->monto * $user->cantidad) ; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                          <button id="botonGuardar" class="btn btn-success"><a href="index.php?c=Pedido" style="color: white;">VOLVER</a></button>
                    </div>

                    <br>
                    <div>
                        <table align="right">
                            <tr>
                                <th> <b> SubTotal: </b></th>
                                <td>
                                    <input readonly="readonly" type="text" name="txtSubtotal" id="txtSubtotal" value="<?php echo $fac->total;  ?>" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
    </div>
</div>
