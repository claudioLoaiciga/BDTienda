<?php

class Pedido
{

    private $pdo;
    public $idPedido = "";
    public $direccionEnvio = "";
    public $empleado = "";

    public $idDetalleP = "";
    public $cantidad = "";
    public $monto = "";
    public $pedido = "";
    public $producto = "";
    public $precio = "";





    public $datoRecibo;
    // Atributos del Detalle
    public $detallePedido;


    public function __CONSTRUCT()
    {
        try {
            $this->detallePedido = array();
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function agregarDetalle($cantidad, $producto, $precio, $descripcion)
    {
        $this->detallePedido[] = array(
            'cantidad' => $cantidad,
            'producto' => $producto,
            'precio' => $precio,
            'monto' => $precio * $cantidad,
            'descripcion' => $descripcion
        );
    }

    //Muestra en pantalla la lista de facturas registrados en la base de datos
    public function ListarPedido()
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT idPedido, direccionEnvio, fecha, empleado FROM pedido");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Obtiene los datos de una factura por su numero de compra
    public function Obtener($idPedido)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM Pedido WHERE idPedido = ?");
            $stm->execute(array($idPedido));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarDetallePedido($id)
    {
        try {
            $stm = $this->pdo->prepare("select * from f_DetallePedido($id)");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    /*explicar el metodo de Guardar*/
    public function Guardar(Pedido $data)
    {
        try {
            $stm = $this->pdo
                ->prepare("exec  pa_agregar_pedido @direccionEnvio = ?, @fecha = ?, @empleado = ?,@monto =?");
            array(
                $stm->bindParam(1, $data->direccionEnvio),
                $stm->bindParam(2, date('Y-m-d')),
                $stm->bindParam(3, $data->empleado),
                $stm->bindParam(4, $data->monto)
            );
            $stm->execute();

            $this->idPedido =  $this->pdo->lastInsertId();

            foreach ($this->detallePedido as $detalle) {
                //     $sql = "INSERT INTO detallefactura VALUES('{$this->idDetalle}','{$this->numeroCompra}', '{$detalle['producto']}','{$detalle['descripcion']}','{$detalle['cantidad']}' ,'{$detalle['precio']}','{$detalle['subtotal']}')";
                //   $this->pdo->query($sql);

                $stm = $this->pdo
                    ->prepare("exec pa_agregar_detPedido  @cantidad = ?, @monto =?, @pedido= ?, @producto = ?, @precio = ?, @descripcion =?");
                array(
                    $stm->bindParam(1, $detalle['cantidad']),
                    $stm->bindParam(2, $detalle['monto']),
                    $stm->bindParam(3, $this->idPedido),
                    $stm->bindParam(4, $detalle['producto']),
                    $stm->bindParam(5, $detalle['precio']),
                    $stm->bindParam(6, $detalle['descripcion'])
                );
                $stm->execute();
            }


            return $this->idPedido;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Procede a eliminar la informacion de una factura de la base de datos
    public function Eliminar($idPedido)
    {
        try {
            $stm = $this->pdo
                ->prepare("exec pa_eliminarPedido @idPedido = ?, @retorno = ?");
            array(
                $stm->bindParam(1, $idPedido)
            );
            $stm->bindParam(2, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 6);
            $stm->execute();
            if ($this->datoRecibo == 'F') {
                return 'F';
            }
            return 'TRUE';
        } catch (Exception $e) {
            return $e;
        }
    }
}
