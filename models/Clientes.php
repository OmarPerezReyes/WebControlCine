<?php

require_once './models/Conexion.php';

class Clientes {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerClientes() {
        $query = "SELECT * FROM cliente";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertarCliente($nombre, $edad) {
        $query = "INSERT INTO cliente (nombre, edad) VALUES ('$nombre', $edad)";
        return $this->conexion->conectar()->query($query);
    }

    public function obtenerClientePorId($id) {
        $query = "SELECT * FROM cliente WHERE id_cliente = $id";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_assoc();
    }

    public function actualizarCliente($id, $nombre, $edad) {
        $query = "UPDATE cliente SET nombre = '$nombre', edad = $edad WHERE id_cliente = $id";
        return $this->conexion->conectar()->query($query);
    }

    public function eliminarCliente($id) {
        $query = "DELETE FROM cliente WHERE id_cliente = $id";
        return $this->conexion->conectar()->query($query);
    }
}
?>
