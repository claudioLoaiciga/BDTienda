<?php

class Producto {

    private $pdo;

    //Atributos
    public $codigo;
    public $nombreProducto;
    public $marca;
    public $descripcion;
    public $precio;
    public $tipo;
    public $stock;
    public $datoRecibo;

    //Llaves foraneas
    public $proveedor;
    public $bodega;

    public function __CONSTRUCT() {
          try {
              $this->pdo = Database::StartUp();
          } catch (Exception $e) {
              die($e->getMessage());
          }
      }

      //Muestra en pantalla la lista de productos registrados en la base de datos
      public function ListarProductos() {
          try {
              $result = array();
              $stm = $this->pdo->prepare("SELECT * FROM V_PRODUCTO");
              $stm->execute();

              return $stm->fetchAll(PDO::FETCH_OBJ);
          } catch (Exception $e) {
              die($e->getMessage());
          }
      }


      //Obtiene los datos de un producto por codigo
      public function Obtener($codigo) {
          try {
              $stm = $this->pdo
                      ->prepare("exec pa_buscarProducto @codigo = ?");
              $stm->execute(array($codigo));
              return $stm->fetch(PDO::FETCH_OBJ);
          } catch (Exception $e) {
              die($e->getMessage());
          }
      }



      //Actualiza datos de un producto en la base de datos
      public function Actualizar(Producto $data) {
          try {
              $stm = $this->pdo
                      ->prepare("exec pa_modificarProducto @codigo = ?, @nombreProducto = ?, @marca = ?, @descripcion = ?, @tipo = ?, @stock = ?, @proveedor = ?, @bodega = ?, @precio = ?,  @retorno = ?");
              array(
                $stm->bindParam(1, $data->codigo),
                $stm->bindParam(2, $data->nombreProducto),
                $stm->bindParam(3, $data->marca),
                $stm->bindParam(4, $data->descripcion),
                $stm->bindParam(5, $data->tipo),
                $stm->bindParam(6, $data->stock),
                $stm->bindParam(7, $data->proveedor),
                $stm->bindParam(8, $data->bodega),
                $stm->bindParam(9, $data->precio)
              );
              $stm->bindParam(10, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 9);
              $stm->execute();
              if ($this->datoRecibo == 'F') {
                  return 'F';
              }
              return 'TRUE';
          } catch (Exception $e) {
              return 'FALSE';
          }
      }


      //Procede al registro de la informacion de un producto en la base de datos
      public function Registrar(Producto $data) {
          try {
                $stm = $this->pdo
                      ->prepare("exec pa_agregarProducto  @codigo = ?, @nombreProducto = ?, @marca = ?, @descripcion = ?, @tipo = ?, @stock = ?, @proveedor = ?, @bodega = ?, @precio = ?,  @retorno = ?");
              array(
                $stm->bindParam(1, $data->codigo),
                $stm->bindParam(2, $data->nombreProducto),
                $stm->bindParam(3, $data->marca),
                $stm->bindParam(4, $data->descripcion),
                $stm->bindParam(5, $data->tipo),
                $stm->bindParam(6, $data->stock),
                $stm->bindParam(7, $data->proveedor),
                $stm->bindParam(8, $data->bodega),
                $stm->bindParam(9, $data->precio)
              );
              $stm->bindParam(10, $this->datoRecibo, PDO::PARAM_STR | \PDO::PARAM_INPUT_OUTPUT, 9);
              $stm->execute();
              if ($this->datoRecibo == 'F') {
                  return 'F';
              }
              return 'TRUE';
          } catch (Exception $e) {
              return 'FALSE';
          }
      }


      //Procede a eliminar la informacion de un producto de la base de datos
      public function Eliminar($codigo) {
          try {
              $stm = $this->pdo
                      ->prepare("exec pa_eliminarProducto @codigo = ?, @retorno = ?");
              array(
                  $stm->bindParam(1, $codigo)
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
