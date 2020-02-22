<?php

class Database
{

    private $usuario;
    private $contrasena;
    public function getUsuario() {
        return $this->usuario;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }
    
    public static function StartUp()
    {
        $DB = new Database();
        try {
            $pdo = new PDO('sqlsrv:Server=localhost; Database=sistemadecomprasv2;', $DB->getUsuario(), $DB->getContrasena()  );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            return false;
        }
    }
}
