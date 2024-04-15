<?php

require_once './models/Conexion.php';

class Generos {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerGeneros() {
        $query = "SELECT * FROM genero";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertarGenero($nombre) {
        $query = "INSERT INTO genero (nombre) VALUES ('$nombre')";
        return $this->conexion->conectar()->query($query);
    }

    public function obtenerGeneroPorId($id) {
        $query = "SELECT * FROM genero WHERE id_genero = $id";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_assoc();
    }

    public function actualizarGenero($id, $nombre) {
        $query = "UPDATE genero SET nombre = '$nombre' WHERE id_genero = $id";
        return $this->conexion->conectar()->query($query);
    }

    public function eliminarGenero($id) {
        $query = "DELETE FROM genero WHERE id_genero = $id";
        return $this->conexion->conectar()->query($query);
    }
}
?>
