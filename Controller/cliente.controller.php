<?php

include_once 'model/cliente.php';

class ClienteController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Cliente();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/cliente/cliente.php';
        require_once 'view/footer.php';
    }

    public function Editar()
    {
        $clie = new Cliente();

        if (isset($_POST['id'])) {
            $clie = $this->model->Obtener($_POST['id']);
        } else {
            header('Location: index.php?c=Cliente&verIndefinido=true');
        }

        require_once 'view/header.php';
        require_once 'view/cliente/cliente-editar.php';
        require_once 'view/footer.php';
    }
    public function Registrar()
    {
        $clie = new Cliente();

        if (isset($_POST['cedula'])) {
            $clie = $this->model->Obtener($_POST['cedula']);
        }

        require_once 'view/header.php';
        require_once 'view/cliente/cliente-editar.php';
        require_once 'view/footer.php';
    }


    public function Guardar()
    {
        $clie = new Cliente();

        $clie->cedula = $_POST['cedula'];
        $clie->nombre = $_POST['Nombre'];
        $clie->apellidos = $_POST['Apellidos'];
        $clie->email = $_POST['Email'];
        $clie->telefono = $_POST['Telefono'];
        $clie->direccion = $_POST['Direccion'];
        $this->model->Registrar($clie);

        header('Location: index.php?c=Cliente&error1=true');
    }



    public function Actualizar()
    {
        $clie = new Cliente();

        $clie->cedula = $_POST['cedula'];
        $clie->nombre = $_POST['Nombre'];
        $clie->apellidos = $_POST['Apellidos'];
        $clie->email = $_POST['Email'];
        $clie->telefono = $_POST['Telefono'];
        $clie->direccion = $_POST['Direccion'];
        $this->model->Actualizar($clie);

        header('Location: index.php?c=Cliente&Actualizar=true');
    }



    public function Eliminar()
    {
        if ($_POST['id']) {
            if ($_POST['id'] == 1) {
                header('Location: index.php?c=Cliente&tipoCliente=true');
            } else {
                $this->model->Eliminar($_POST['id']);
                header('Location: index.php?c=Cliente&Eliminar=true');
            }
        } else {
            header('Location: index.php?c=Cliente&verIndefinido=true');
        }
    }
}
