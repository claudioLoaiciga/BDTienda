<?php
include_once 'model/pedido.php';

include_once 'model/producto.php';

include_once 'model/empleado.php';

class PedidoController
{

    private $model;
    private $modelProducto;
    private $modelEmp;

    public function __CONSTRUCT()
    {
        $this->model = new Pedido();
        $this->modelProducto = new Producto();
        $this->modelEmp = new Empleado();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/pedido/pedido.php';
        require_once 'view/footer.php';
    }

    //Metodo editar factura
    public function Ver()
    {
        $fac = new Pedido();
        if (isset($_POST['idPedido'])) {
            $fac = $this->model->Obtener($_POST['idPedido']);
            require_once 'view/header.php';
            require_once 'view/Pedido/pedido-editar.php';
            require_once 'view/footer.php';
        }else{
            header('Location: index.php?c=Pedido&verIndefinido=true');
        }
    }

    //Metodo registrar nueva factura
    public function Registrar()
    {
        require_once 'view/header.php';
        require_once 'View/pedido/agregaPedido.php';
        require_once 'view/footer.php';
    }

    public function Guardar()
    {
        $alm = new Pedido();
        $alm->direccionEnvio = $_POST['txtDireccion'];
        $alm->fecha = $_POST['txtFecha'];
        $alm->empleado = $_POST['txtEmpleado'];
        $alm->cantidadArt = $_POST['cantArticulo'];
        $alm->monto = $_POST['txtSubtotal'];

        if (isset($_POST['det_Codigo'])) {
            $idProducto = $_POST['det_Codigo'];
            $cantidad = $_POST['det_Cantidad'];
            $precioUnidad = $_POST['det_Precio'];
            $descripcion = $_POST['det_Articulo'];
            foreach ($idProducto as $p => $cod) {
                $this->model->agregarDetalle($cantidad[$p], $cod, $precioUnidad[$p] , $descripcion[$p]);
            }
            if ($this->model->Guardar($alm) === 'TRUE') {
                header('Location: index.php?c=Pedido&error1=true');
            } else {
                header('Location: index.php?c=Pedido&error1=true');
            }
        } else {

            header('Location: index.php?c=Pedido&error3=true');
        }
    }

    //Metodo eliminar factura
    public function Eliminar()
    {
        if (isset($_POST['idPedido'])) {
            $this->model->Eliminar($_POST['idPedido']); 
            header('Location: index.php?c=Pedido&Eliminar=true');
        }else{
            header('Location: index.php?c=Pedido&verIndefinido=true');
        }
       
    }
}

