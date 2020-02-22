<?php

class Empleado {

    private $pdo;
    public $idEmpleado;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $puesto;
    public $clave;
    public $datoRecibo;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_buscarEmpleado @idEmpleado = ?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Verificar($idEmpleado, $clave) {

        try {
            $sql = "SELECT  idEmpleado, clave FROM empleado WHERE idEmpleado = ? AND clave = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($idEmpleado, $clave));

            $empleadoDatos = $stm->fetch(PDO::FETCH_OBJ);
            if ($empleadoDatos == NULL) {
                return FALSE;
            } else {
                return TRUE;
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function Eliminar($id) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_eliminarEmpleado @idEmpleado = ?, @retorno = ?");
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

    public function ListarEmpleados() {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM V_Empleado");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Empleado $data) {
        try {
            	$stm = $this->pdo
                    ->prepare("exec pa_agregarEmpleado @idEmpleado = ?, @nombre = ?, @apellidos = ?, @telefono = ?, @puesto = ?, @clave = ?,  @retorno = ? ");
            array(
                $stm->bindParam(1, $data->idEmpleado),
                $stm->bindParam(2, $data->nombre),
                $stm->bindParam(3, $data->apellidos),
                $stm->bindParam(4, $data->telefono),
                $stm->bindParam(5, $data->puesto),
                $stm->bindParam(6, $data->clave)
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

    public function actualizar(empleado $data) {
        try {
            $stm = $this->pdo
                    ->prepare("exec  pa_modificarEmpleado @idEmpleado = ?,@nombre = ?, @apellidos = ?, @telefono = ?, @puesto = ?, @clave = ?,  @retorno = ?");
            array(
              $stm->bindParam(1, $data->idEmpleado),
              $stm->bindParam(2, $data->nombre),
              $stm->bindParam(3, $data->apellidos),
              $stm->bindParam(4, $data->telefono),
              $stm->bindParam(5, $data->puesto),
              $stm->bindParam(6, $data->clave)
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

}




/**/
