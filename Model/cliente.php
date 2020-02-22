<?php

class Cliente{

    private $pdo;
    public $cedula;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $direccion;
    public $datoRecibo;


    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Muestra en pantalla la lista de clientes registrados en la base de datos

    public function ListarClientes() {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM V_Cliente");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    //Obtiene los datos de un cliente por numero de cedula

    public function Obtener($cedula) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_buscarCliente @cedula = ?");
            $stm->execute(array($cedula));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }




    //Actualiza datos de un cliente en la base de datos
    public function Actualizar(cliente $data) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_modificarCliente @cedula = ?, @nombre = ?, @apellidos = ?, @email = ?, @telefono = ?, @direccion = ?,  @retorno = ?");
            array(
              $stm->bindParam(1, $data->cedula),
              $stm->bindParam(2, $data->nombre),
              $stm->bindParam(3, $data->apellidos),
              $stm->bindParam(4, $data->email),
              $stm->bindParam(5, $data->telefono),
              $stm->bindParam(6, $data->direccion)
            );
            $stm->bindParam(7, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 6);
            $stm->execute();
            if ($this->datoRecibo == 'F') {
                return 'F';
            }
            return 'TRUE';
        } catch (Exception $e) {
            return 'FALSE';
        }
    }






//Procede al registro de la informacion del cliente en la base de datos
    public function Registrar(Cliente $data) {
        try {
              $stm = $this->pdo
                    ->prepare("exec pa_agregarCliente @cedula = ?, @nombre = ?, @apellidos = ?, @email = ?, @telefono = ?, @direccion = ?,  @retorno = ? ");
            array(
                $stm->bindParam(1, $data->cedula),
                $stm->bindParam(2, $data->nombre),
                $stm->bindParam(3, $data->apellidos),
                $stm->bindParam(4, $data->email),
                $stm->bindParam(5, $data->telefono),
                $stm->bindParam(6, $data->direccion)
            );
            $stm->bindParam(7, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 6);
            $stm->execute();
            if ($this->datoRecibo == 'F') {
                return 'F';
            }
            return 'TRUE';
        } catch (Exception $e) {
            return 'FALSE';
        }
    }





    //Procede a eliminar la informacion del cliente de la base de datos
    public function Eliminar($id) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_eliminarCliente @cedula = ?, @retorno = ?");
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
