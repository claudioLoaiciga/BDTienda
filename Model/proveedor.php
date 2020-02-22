<?php

class Proveedor{

    private $pdo;
    public $cedulaJuridica;
    public $nombre;
    public $telefono;
    public $email;
    public $tipo;
    public $datoRecibo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Muestra en pantalla la lista de proveedores registrados en la base de datos
    public function ListarProveedores() {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM V_PROVEEDOR");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Obtiene los datos de los proveedores por su identificador
    public function Obtener($cedulaJuridica) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_buscarProveedor @cedulaJuridica = ?");
            $stm->execute(array($cedulaJuridica));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Actualiza datos del proveedor en la base de datos
    public function Actualizar(Proveedor $data) {
      try {
          $stm = $this->pdo
                  ->prepare("exec  pa_modificarProveedor @cedulaJuridica = ?,@nombre = ?, @telefono = ?, @email = ?, @tipo = ?,  @retorno = ?");
          array(
            $stm->bindParam(1, $data->cedulaJuridica),
            $stm->bindParam(2, $data->nombre),
            $stm->bindParam(3, $data->telefono),
            $stm->bindParam(4, $data->email),
            $stm->bindParam(5, $data->tipo),
          );
          $stm->bindParam(6, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 5);
          $stm->execute();
          if ($this->datoRecibo == 'F') {
              return 'F';
          }
          return 'TRUE';
      } catch (Exception $e) {
          return 'FALSE';
      }
  }
    //Procede al registro de la informacion del proveedor en la base de datos
    public function Registrar(Proveedor $data) {
      try {
            $stm = $this->pdo
                  ->prepare("exec pa_agregarProveedor @cedulaJuridica = ?, @nombre = ?, @telefono = ?, @email = ?, @tipo = ?,  @retorno = ? ");
          array(
              $stm->bindParam(1, $data->cedulaJuridica),
              $stm->bindParam(2, $data->nombre),
              $stm->bindParam(3, $data->telefono),
              $stm->bindParam(4, $data->email),
              $stm->bindParam(5, $data->tipo)
          );
          $stm->bindParam(6, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 5);
          $stm->execute();
          if ($this->datoRecibo == 'F') {
              return 'F';
          }
          return 'TRUE';
      } catch (Exception $e) {
          return 'FALSE';
      }
    }

    //Procede a eliminar la informacion del proveedor de la base de datos
    public function Eliminar($ced) {
      try {
          $stm = $this->pdo
                  ->prepare("exec pa_eliminarProveedor @cedulaJuridica = ?, @retorno = ?");
          array(
              $stm->bindParam(1, $ced)
          );
          $stm->bindParam(2, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 5);
          $stm->execute();
          if ($this->datoRecibo == 'F') {
              return 'F';
          }
          return 'TRUE';
      } catch (Exception $e) {
          return 'FALSE';
      }
    }
}
