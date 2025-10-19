<?php

namespace App\Database;

use PDO;
use PDOException;

class Conexion
{
    private $servidor;
    private $usuario;
    private $contrasenia;
    private $baseDatos;
    private $conexion;

    public function __construct()
    {
        $this->servidor = env('DB_HOST', 'localhost');
        $this->usuario = env('DB_USERNAME', 'root');
        $this->contrasenia = env('DB_PASSWORD', '');
        $this->baseDatos = env('DB_DATABASE', 'laravel');

        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->baseDatos", $this->usuario, $this->contrasenia);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Falla de conexión: " . $e->getMessage());
        }
    }

    public function ejecutar($sql)
    {
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }

    public function consultar($sql)
    {
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}