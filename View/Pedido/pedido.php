<?php
if (isset($_GET['error1'])) {
    echo "<script language='JavaScript'>alert('Pedido agregado correctamente"
        . "');</script>";
    echo "
<script> 
location.href = 'index.php?c=Pedido'; 
</script>
";
}

if (isset($_GET['verIndefinido'])) {
    print "<script language='JavaScript'>alert('Debe seleccionar un ítem"
        . "');</script>";

    echo "
<script> 
location.href = 'index.php?c=Pedido'; 
</script>
";
}

if (isset($_GET['Eliminar'])) {
    print "<script language='JavaScript'>alert('Eliminado Correctamente"
        . "');</script>";

    echo "
<script> 
location.href = 'index.php?c=Pedido'; 
</script>
";
}


?>

<div class="contTitleService">
    <br>

    <!--<div class="contTitleService">
    <div class="subContTitleService">
        <div id="titleService" class="container">
            <h1 class="page-header">Pedido</h1>
        </div>
    </div>-->

    <div class="card">
        <form action="?c=Pedido" method="post">
            <div class="card-header">
                <h2>Pedido</h2>
                <br>
                <div class="well well-sm text-right">

                    <div class="contLabelBuscar">
                        <label class="labelBuscar">Buscar:</label>
                        <input class="form-control" id="buscar" type="text" placeholder="Escriba algo para buscar" height="60px" />
                    </div>

                    <div id="margenCont">
                        <!--Contenedor de botones-->
                        <a id="botonRegistrar" class="btn btn-primary" href="?c=Pedido&a=Registrar">Registrar</a>
                        <!-- <input type="submit" title="Buscar Factura" value="Eliminar" name="a"/> -->
                        <input id="botonEditar" type="submit" value="Ver" name="a" class="btn btn-primary" />
                        <input id="botonEliminar" type="submit" value="Eliminar" name="a" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" class="btn btn-primary" />
                    </div>
                </div>

                <table id="tabla" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="spaceCol">Seleccionar</th>
                            <th class="spaceCol">Codigo del pedido</th>
                            <th class="spaceCol">Direccion de envio</th>
                            <th class="spaceCol">Fecha del pedido</th>
                            <th class="spaceCol">Empleado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->model->ListarPedido() as $emple) : ?>
                            <?php $valor = $emple->idPedido; ?>
                            <tr>
                                <td><input id="marginRadio" type=radio name=idPedido value=<?php echo $emple->idPedido; ?>></td>
                                <td><?php echo $emple->idPedido; ?></td>
                                <td><?php echo $emple->direccionEnvio; ?></td>
                                <td><?php echo $emple->fecha; ?></td>
                                <td><?php echo $emple->empleado; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <script src="assets/js/buscador.js"></script>
                    </tbody>
                </table>
        </form>
    </div>
</div>
</div>