<?php

class seguridad {
    public $datoRecibo;
    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Backups() {
         try {
             $stm = $this->pdo
                     ->prepare("exec pa_respaldo");
             $stm->execute();
             return $stm->execute();

            /* try {
                $stm = $this->pdo
                        ->prepare("exec respaldo_diferencial");
                $stm->execute();
                return $stm->execute();
            } catch (Exception $e) {
                return $e->getMessage();
            }*/
         } catch (Exception $e) {
             return $e->getMessage();

         }


     }

     public function Restaurar() {
        try {
            $stm = $this->pdo
                    ->prepare("exec  pa_restoreBD");
            $stm->execute();
            return $stm->execute();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
