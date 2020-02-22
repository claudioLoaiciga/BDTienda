<?php
class PrincipalController{
    public function Index() {
        require_once 'view/header.php';
        require_once 'view/inicio/principal.php';
        require_once 'view/footer.php';
    }

    //¿Esto que hace?
    /*public function Reservar(){
        header('Location: index.php?c=reserva');
    }

    public function Facturacion(){
        header('Location: index.php?c=facturacion');
    }

    public function Productos(){
        header('Location: index.php?c=productos');
    }

    public function Clientes(){
        header('Location: index.php?c=Cliente');
    }

    public function Mesas(){
         header('Location: index.php?c=mesas');
    }

    public function Empleados(){
         header('Location: index.php?c=Empleado');
    }*/
}
