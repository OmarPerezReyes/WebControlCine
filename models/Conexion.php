<?php

class Conexion {
    private $host = "localhost";
    private $user = "admin";
    private $password = "be17af928cb8ea2ca2418261803f684deb3e60a9b3537483";
    private $database = "cine";

    public function conectar() {
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}
