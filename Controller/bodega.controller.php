<?php
include_once 'model/bodega.php';

class BodegaController {

    private $model;

    public function __CONSTRUCT() {
        $this->model = new Bodega();
    }

    public function Index() {
        require_once 'view/header.php';
        require_once 'view/bodega/bodega.php';
        require_once 'view/footer.php';
    }

    //Metodo editar bodega
    public function Editar() {
        $emple = new Bodega();

        if (isset($_POST['id'])) {
            $emple = $this->model->Obtener($_POST['id']);
        }else{
            header('Location: index.php?c=Bodega&verIndefinido=true');
        }

        require_once 'view/header.php';
        require_once 'view/bodega/bodega-editar.php';
        require_once 'view/footer.php';
    }

    //Metodo registrar nueva bodega
    public function Registrar() {
        $emple = new Bodega();

        if (isset($_POST['idBodega'])) {
            $emple = $this->model->Obtener($_POST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/bodega/bodega-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar() {
      $emple = new Bodega();

      $emple->idBodega = $_POST['idBodega'];
      $emple->nombre = $_POST['nombre'];
      $emple->telefono = $_POST['telefono'];
      $emple->direccion = $_POST['direccion'];
      $emple->email = $_POST['email'];
        $this->model->Registrar($emple);
        header('Location: index.php?c=Bodega&error1=true');
    }

    public function Actualizar() {
      $emple = new Bodega();

      $emple->idBodega = $_POST['idBodega'];
      $emple->nombre = $_POST['nombre'];
      $emple->telefono = $_POST['telefono'];
      $emple->direccion = $_POST['direccion'];
      $emple->email = $_POST['email'];
        $this->model->Actualizar($emple);
        header('Location: index.php?c=Bodega&Actualizar=true');
    }

    //Metodo eliminar empleado
    public function Eliminar() {
        if($_POST['id']){
        $this->model->Eliminar($_POST['id']);
        header('Location: index.php?c=Bodega&Eliminar=true');   
        }else{
            header('Location: index.php?c=Bodega&verIndefinido=true');  
        }
       
    }
}
?>
