<?php

require_once './models/Conexion.php';

class Empleados {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerEmpleados() {
        $query = "SELECT * FROM empleado";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertarEmpleado($nombre, $edad) {
        $query = "INSERT INTO empleado (nombre, edad) VALUES ('$nombre', $edad)";
        return $this->conexion->conectar()->query($query);
    }

    public function obtenerEmpleadoPorId($id) {
        $query = "SELECT * FROM empleado WHERE id_empleado = $id";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_assoc();
    }

    public function actualizarEmpleado($id, $nombre, $edad) {
        $query = "UPDATE empleado SET nombre = '$nombre', edad = $edad WHERE id_empleado = $id";
        return $this->conexion->conectar()->query($query);
    }

    public function eliminarEmpleado($id) {
        $query = "DELETE FROM empleado WHERE id_empleado = $id";
        return $this->conexion->conectar()->query($query);
    }
}
?>
