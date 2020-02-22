<?php

include_once 'model/empleado.php';

class LoginController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Empleado();
    }

    public function Index()
    {
        require_once 'view/Login/login.php';
    }

    public function Guardar()
    {
        $emple = new empleado();

        $emple->idEmpleado = $_POST['identificacion'];
        $emple->nombre = $_POST['nombre'];
        $emple->apellidos = $_POST['apellidos'];
        $emple->puesto = $_POST['puesto'];
        $emple->clave = $_POST['clave'];
        $this->model->Obtener($_POST['identificacion']) ?
            $this->model->Actualizar($emple) : $this->model->Registrar($emple);

        header('Location: index.php?c=Empleado');
    }

    public function Autenticar()
    {
        $dato = new Database();
        $IdEmpleado = $_POST['identificacion'];
        $Clave = $_POST[('clave')];

        $dato->setUsuario($IdEmpleado);
        $dato->setContrasena($Clave);


        if ($dato->StartUp()) {

            $validar = $this->model->Verificar($IdEmpleado, $Clave);
            if (isset($_SESSION['Iniciada'])) {
                session_destroy();
                header('Location: index.php?c=Login');
            } else {
                if ($validar) {
                    session_start();

                    $_SESSION['Iniciada'] = true;
                    $_SESSION['idEmpleado'] = $IdEmpleado;

                    header('Location: index.php?c=principal');
                } else {
                    header('Location: index.php?c=Login&error=true');
                }
            }
        } else {
            session_destroy();
            header('Location: index.php?c=Login');
        }
    }

    public function cerrar()
    {

        session_destroy();
        header('Location: index.php');
    }
}
