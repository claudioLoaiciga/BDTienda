<?php
include_once 'model/factura.php';

include_once 'model/producto.php';
include_once 'model/cliente.php';
include_once 'model/empleado.php';

class FacturaController
{

    private $model;
    private $modelProducto;
    private $modelCli;
    private $modelEmp;

    public function __CONSTRUCT()
    {
        $this->model = new Factura();

        $this->modelProducto = new Producto();
        $this->modelCli = new Cliente();
        $this->modelEmp = new Empleado();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/factura/factura.php';
        require_once 'view/footer.php';
    }

    //Metodo editar factura
    public function Ver()
    {
        $fac = new Factura();

        if (isset($_POST['numeroCompra'])) {
            $fac = $this->model->Obtener($_POST['numeroCompra']);
            require_once 'view/header.php';
            require_once 'view/factura/factura-editar.php';
            require_once 'view/footer.php';
        }else{
            header('Location: index.php?c=Factura&verIndefinido=true');
        }
    }

    //Metodo registrar nueva factura
    public function Registrar()
    {
        require_once 'view/header.php';
        require_once 'View/Factura/agregraFactura.php';
        require_once 'view/footer.php';
    }

    public function Guardar()
    {
        $alm = new Factura();
        $alm->fecha = $_POST['txtfecha'];
        $alm->empleado = $_POST['txtEmpleado'];
        $alm->cliente = $_POST['txtCliente'];
        $alm->cantidadArt = $_POST['cantArticulo'];
        $alm->subTotal = $_POST['txtSubtotal'];
        $alm->impuesto = $_POST['txtImp'];
        $alm->total = $_POST['txtTotal'];
        //return var_dump($alm);
        if (isset($_POST['det_Codigo'])) {
            $idProducto = $_POST['det_Codigo'];
            $cantidad = $_POST['det_Cantidad'];
            $precioUnidad = $_POST['det_Precio'];
            $articulo = $_POST['det_Articulo'];
            foreach ($idProducto as $p => $cod) {
                $this->model->agregarDetalle($cod, $articulo[$p], $cantidad[$p], $precioUnidad[$p]);
            }
            if ($this->model->Guardar($alm) === 'TRUE') {
                header('Location: index.php?c=Factura&error1=true');
            } else {
                header('Location: index.php?c=Factura&error2=true');
            }
        } else {

            header('Location: index.php?c=Factura&error3=true');
        }
    }

    //Metodo eliminar factura
    public function Eliminar()
    {
        if (isset($_POST['numeroCompra'])) {
            $this->model->Eliminar($_POST['numeroCompra']);
            header('Location: index.php?c=Factura&Eliminar=true');
        }else{
            header('Location: index.php?c=Factura&eliminarIndefinido=true');
        }
    }
}


//public function Eliminar() {
     // $this->model->Eliminar($_POST['numeroCompra']);
     // header('Location: index.php?c=Factura');
 // }
//}
