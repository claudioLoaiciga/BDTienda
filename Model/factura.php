<?php

class Factura
{

    private $pdo;
    public $numeroCompra = "";
    public $fecha = " ";
    public $impuesto = "";
    public $descuento = " ";
    public $empleado = " ";
    public $total = " ";
    public $cliente = " ";
    public $producto = " ";
    private $idDetalle = " ";

    public $datoRecibo;
    // Atributos del Detalle
    public $detalleFactura;


    public function __CONSTRUCT()
    {
        try {
            $this->detalleFactura = array();
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function agregarDetalle($producto, $descripcion, $cantidad, $precio)
    {
        $this->detalleFactura[] = array(
            'producto' => $producto,
            'descripcion' => $descripcion,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'subtotal' => $cantidad * $precio
        );
    }

    //Muestra en pantalla la lista de facturas registrados en la base de datos
    public function ListarFacturas()
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT numeroCompra, fecha, impuesto, descuento, empleado, total, cliente FROM factura");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Obtiene los datos de una factura por su numero de compra
    public function Obtener($numeroCompra)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM factura WHERE numeroCompra = ?");
            $stm->execute(array($numeroCompra));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarDetalle($id) {
        try {
            $stm = $this->pdo->prepare("select * from f_DetalleFactura($id)");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
    /*explicar el metodo de Guardar*/
    public function Guardar(Factura $data)
    {
        try {
            $stm = $this->pdo
                ->prepare("exec pa_agregar_factura @fecha = ?, @impuesto = ?, @descuento = ?, @empleado = ?, @total = ?, @cliente = ?, @producto = ?");
            array(
                $stm->bindParam(1, date('Y-m-d')),
                $stm->bindParam(2, $data->impuesto),
                $stm->bindParam(3, $data->descuento),
                $stm->bindParam(4, $data->empleado),
                $stm->bindParam(5, $data->total),
                $stm->bindParam(6, $data->cliente),
                $stm->bindParam(7, $data->cantidadArt)
            );
            $stm->execute();

            $this->numeroCompra =  $this->pdo->lastInsertId();

            foreach ($this->detalleFactura as $detalle) {
           //     $sql = "INSERT INTO detallefactura VALUES('{$this->idDetalle}','{$this->numeroCompra}', '{$detalle['producto']}','{$detalle['descripcion']}','{$detalle['cantidad']}' ,'{$detalle['precio']}','{$detalle['subtotal']}')";
             //   $this->pdo->query($sql);

                $stm = $this->pdo
                    ->prepare("exec pa_agregar_detFactura @factura = ?, @producto = ?, @descripcion = ?, @cantidad  = ?, @precio = ?, @subTotal = ?");
                array(
                    $stm->bindParam(1, $this->numeroCompra),
                    $stm->bindParam(2, $detalle['producto']),
                    $stm->bindParam(3, $detalle['descripcion']),
                    $stm->bindParam(4, $detalle['cantidad']),
                    $stm->bindParam(5, $detalle['precio']),
                    $stm->bindParam(6, $detalle['subtotal'])
                );
                $stm->execute();
            }

            return 'TRUE';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Procede a eliminar la informacion de una factura de la base de datos
    public function Eliminar($numeroCompra) {
        try {
            $stm = $this->pdo
                    ->prepare("exec pa_eliminarFactura @numeroCompra = ?, @retorno = ?");
            array(
                $stm->bindParam(1, $numeroCompra)
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
