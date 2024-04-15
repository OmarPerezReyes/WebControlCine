<?php

require_once './models/Conexion.php';

class Productos {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerProductos() {
        $query = "SELECT * FROM producto";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertarProducto($nombre, $precio, $cantidad_inventario, $descripcion) {
        $query = "INSERT INTO producto (nombre, precio, cantidad_inventario, descripcion) VALUES ('$nombre', $precio, $cantidad_inventario, '$descripcion')";
        return $this->conexion->conectar()->query($query);
    }

    public function obtenerProductoPorId($id) {
        $query = "SELECT * FROM producto WHERE id_producto = $id";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_assoc();
    }

    public function actualizarProducto($id, $nombre, $precio, $cantidad_inventario, $descripcion) {
        $query = "UPDATE producto SET nombre = '$nombre', precio = $precio, cantidad_inventario = $cantidad_inventario, descripcion = '$descripcion' WHERE id_producto = $id";
        return $this->conexion->conectar()->query($query);
    }

    public function eliminarProducto($id) {
        $query = "DELETE FROM producto WHERE id_producto = $id";
        return $this->conexion->conectar()->query($query);
    }
}
?>
