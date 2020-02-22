
<?php
include_once 'model/seguridad.php';
class SeguridadController{
    private $model;

    public function __CONSTRUCT() {
      $this->model = new seguridad();
    }

    public function Index() {
        require_once 'view/header.php';
        require_once 'view/seguridad/seguridad.php';
        require_once 'view/footer.php';
    }

    public function Backup() {
       
        if($this->model->Backups() == 1){
            header('Location: index.php?c=Seguridad&Backup=true');  
        }else{
            header('Location: index.php?c=Seguridad&Error=true');  
        }
    }

    public function Restaurar(){
        if($this->model->Restaurar() == 1){
            header('Location: index.php?c=Seguridad&Restauracion=true');  
        }else{
            header('Location: index.php?c=Seguridad&Error=true');  
        }
    }



}
