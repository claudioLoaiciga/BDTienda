<?php
include_once 'model/empleado.php';

class EmpleadoController {

    private $model;

    public function __CONSTRUCT() {
        $this->model = new Empleado();
    }

    public function Index() {
        require_once 'view/header.php';
        require_once 'view/empleado/empleado.php';
        require_once 'view/footer.php';
    }

    //Metodo editar empleado
    public function Editar() {
        $emple = new Empleado();

        if (isset($_POST['id'])) {
            $emple = $this->model->Obtener($_POST['id']);
        }else{
            header('Location: index.php?c=Empleado&verIndefinido=true');  
        }

        require_once 'view/header.php';
        require_once 'view/empleado/empleado-editar.php';
        require_once 'view/footer.php';
    }

    //Metodo registrar nuevo empleado
    public function Registrar() {
        $emple = new Empleado();

        if (isset($_POST['idEmpleado'])) {
            $emple = $this->model->Obtener($_POST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/empleado/empleado-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar() {
        $emple = new Empleado();

        $emple->idEmpleado = $_POST['identificacion'];
        $emple->nombre = $_POST['nombre'];
        $emple->apellidos = $_POST['apellidos'];
        $emple->telefono = $_POST['telefono'];
        $emple->puesto = $_POST['puesto'];
        $emple->clave = $_POST['clave'];
        $this->model->Registrar($emple);

        header('Location: index.php?c=Empleado&error1=true');
    }

    public function Actualizar() {
        $emple = new Empleado();

        $emple->idEmpleado = $_POST['identificacion'];
        $emple->nombre = $_POST['nombre'];
        $emple->apellidos = $_POST['apellidos'];
        $emple->telefono = $_POST['telefono'];
        $emple->puesto = $_POST['puesto'];
        $emple->clave = $_POST['clave'];
        $this->model->actualizar($emple);

        header('Location: index.php?c=Empleado&Actualizar=true');
    }
    //Metodo eliminar empleado
    public function Eliminar() {
        if($_POST['id']){
        $this->model->Eliminar($_POST['id']);
        header('Location: index.php?c=Empleado&Eliminar=true');   
        }else{
            header('Location: index.php?c=Empleado&verIndefinido=true');  
        }
        
    }
}
?>
