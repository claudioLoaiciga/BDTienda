<?php

class Bodega {

  private $pdo;

  //Atributos
  public $idBodega;
  public $nombre;
  public $telefono;
  public $direccion;
  public $email;

  public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Muestra en pantalla la lista de bodegas registrados en la base de datos

    public function ListarBodegas() {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM V_BODEGA");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    //Obtiene los datos de las bodegas por su identificador
    public function Obtener($idBodega) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_buscarBodega @idBodega = ?");
            $stm->execute(array($idBodega));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    //Actualiza datos de la bodega en la base de datos

    public function Actualizar(Bodega $data) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_modificarBodega @idBodega = ?, @nombre = ?, @telefono = ?, @direccion = ?, @email = ?,  @retorno = ?");
            array(
              $stm->bindParam(1, $data->idBodega),
              $stm->bindParam(2, $data->nombre),
              $stm->bindParam(3, $data->telefono),
              $stm->bindParam(4, $data->direccion),
              $stm->bindParam(5, $data->email)
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


    //Procede al registro de la informacion de la bodega en la base de datos

    public function Registrar(Bodega $data) {
        try {
              $stm = $this->pdo
                    ->prepare("exec pa_agregarBodega @idBodega = ?, @nombre = ?, @telefono = ?, @direccion = ?, @email = ?,  @retorno = ?");
            array(
                $stm->bindParam(1, $data->idBodega),
                $stm->bindParam(2, $data->nombre),
                $stm->bindParam(3, $data->telefono),
                $stm->bindParam(4, $data->direccion),
                $stm->bindParam(5, $data->email)
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


    //Procede a eliminar la informacion de la bodega de la base de datos

    public function Eliminar($id) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_eliminarBodega @idBodega = ?, @retorno = ?");
            array(
                $stm->bindParam(1, $id)
            );
            $stm->bindParam(2, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 6);
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
