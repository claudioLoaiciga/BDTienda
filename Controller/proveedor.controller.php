<?php
include_once 'model/proveedor.php';

class ProveedorController {

    private $model;

    public function __CONSTRUCT() {
        $this->model = new Proveedor();
    }

    public function Index() {
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor.php';
        require_once 'view/footer.php';
    }

    public function Editar() {
        $prov = new Proveedor();

        if (isset($_POST['cedulaJuridica'])) {
            $prov = $this->model->Obtener($_POST['cedulaJuridica']);
        }else{
            header('Location: index.php?c=Proveedor&verIndefinido=true');  
        }

        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor-editar.php';
        require_once 'view/footer.php';
    }

    public function Registrar() {
        $prov = new Proveedor();

        if (isset($_POST['cedulaJuridica'])) {
            $prov = $this->model->Obtener($_POST['ced']);
        }
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar() {
        $prov = new Proveedor();
        $prov->cedulaJuridica = $_POST['cedulaJuridica'];
        $prov->nombre = $_POST['nombre'];
        $prov->telefono = $_POST['telefono'];
        $prov->email = $_POST['email'];
        $prov->tipo = $_POST['tipo'];
        $this->model->Registrar($prov);
        
        header('Location: index.php?c=Proveedor&error1=true');
    }

    public function Actualizar() {
        $prov = new Proveedor();
        $prov->cedulaJuridica = $_POST['cedulaJuridica'];
        $prov->nombre = $_POST['nombre'];
        $prov->telefono = $_POST['telefono'];
        $prov->email = $_POST['email'];
        $prov->tipo = $_POST['tipo'];
        $this->model->Actualizar($prov);
        
        header('Location: index.php?c=Proveedor&Actualizar=true');
       
    }

    public function Eliminar() {
        if($_POST['cedulaJuridica']){
         $this->model->Eliminar($_POST['cedulaJuridica']);
        header('Location: index.php?c=Proveedor&Eliminar=true');    
        }else{
            header('Location: index.php?c=Proveedor&verIndefinido=true');  
        }
       
    }

}

?>
