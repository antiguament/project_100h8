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
        // Cargar variables de entorno desde .env si existe
        if (file_exists(__DIR__ . '/../../.env')) {
            $this->loadEnv(__DIR__ . '/../../.env');
        }

        $this->servidor = getenv('DB_HOST') ?: 'localhost';
        $this->usuario = getenv('DB_USERNAME') ?: 'root';
        $this->contrasenia = getenv('DB_PASSWORD') ?: '';
        $this->baseDatos = getenv('DB_DATABASE') ?: 'laravel';

        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->baseDatos", $this->usuario, $this->contrasenia);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Falla de conexión: " . $e->getMessage());
        }
    }

    private function loadEnv($path)
    {
        if (!file_exists($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!getenv($name)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
            }
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