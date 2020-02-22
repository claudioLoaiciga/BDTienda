<?php
include_once 'model/producto.php';
include_once 'model/proveedor.php';
include_once 'model/bodega.php';

class ProductoController
{

    private $model;
    private $modelPro;
    private $modelBod;

    public function __CONSTRUCT()
    {
        $this->model = new Producto();
        $this->modelPro = new Proveedor();
        $this->modelBod = new Bodega();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/producto/producto.php';
        require_once 'view/footer.php';
    }

    //Metodo editar producto
    public function Editar()
    {
        $emple = new Producto();

        if (isset($_POST['codigo'])) {
            $emple = $this->model->Obtener($_POST['codigo']);
        } else {
            header('Location: index.php?c=Producto&verIndefinido=true');
        }

        require_once 'view/header.php';
        require_once 'view/producto/producto-editar.php';
        require_once 'view/footer.php';
    }

    //Metodo registrar nuevo producto
    public function Registrar()
    {
        $emple = new Producto();

        if (isset($_POST['codigo'])) {
            $emple = $this->model->Obtener($_POST['cod']);
        }

        require_once 'view/header.php';
        require_once 'view/producto/producto-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar()
    {
        $emple = new Producto();

        $emple->codigo = $_POST['codigo'];
        $emple->nombreProducto = $_POST['nombreProducto'];
        $emple->marca = $_POST['marca'];
        $emple->descripcion = $_POST['descripcion'];
        $emple->precio = $_POST['precio'];
        $emple->tipo = $_POST['tipo'];
        $emple->stock = $_POST['stock'];
        $emple->proveedor = $_POST['proveedor'];
        $emple->bodega = $_POST['bodega'];
        $this->model->Registrar($emple);

        header('Location: index.php?c=Producto&error1=true');
    }

    public function Actualizar()
    {
        $emple = new Producto();

        $emple->codigo = $_POST['codigo'];
        $emple->nombreProducto = $_POST['nombreProducto'];
        $emple->marca = $_POST['marca'];
        $emple->descripcion = $_POST['descripcion'];
        $emple->precio = $_POST['precio'];
        $emple->tipo = $_POST['tipo'];
        $emple->stock = $_POST['stock'];
        $emple->proveedor = $_POST['proveedor'];
        $emple->bodega = $_POST['bodega'];
        $this->model->Actualizar($emple);
        header('Location: index.php?c=Producto&Actualizar=true');
    }



    //Metodo eliminar producto
    public function Eliminar()
    {
        if ($_POST['codigo']) {
            $this->model->Eliminar($_POST['codigo']);
            header('Location: index.php?c=Producto&Eliminar=true');
        }else{
            header('Location: index.php?c=Producto&verIndefinido=true');  
        }
    }
}
