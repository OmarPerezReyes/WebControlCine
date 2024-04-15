<?php

require_once './models/Conexion.php';

class Peliculas {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerPeliculas() {
        $query = "SELECT * FROM pelicula";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertarPelicula($nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $clasificacion) {
        $query = "INSERT INTO pelicula (nombre, sinopsis, id_genero, fecha_inicio_cartelera, fecha_fin_cartelera, clasificacion) 
                  VALUES ('$nombre', '$sinopsis', '$id_genero', '$fecha_inicio_cartelera', '$fecha_fin_cartelera', '$clasificacion')";

        return $this->conexion->conectar()->query($query);
    }

    public function obtenerPeliculaPorId($id) {
        $query = "SELECT * FROM pelicula WHERE id_pelicula = $id";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_assoc();
    }

    public function actualizarPelicula($id, $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $clasificacion) {
        $query = "UPDATE pelicula SET nombre = '$nombre', sinopsis = '$sinopsis', id_genero = '$id_genero', 
                  fecha_inicio_cartelera = '$fecha_inicio_cartelera', fecha_fin_cartelera = '$fecha_fin_cartelera', 
                  clasificacion = '$clasificacion' WHERE id_pelicula = $id";
        return $this->conexion->conectar()->query($query);
    }

    public function eliminarPelicula($id) {
        $query = "DELETE FROM pelicula WHERE id_pelicula = $id";
        return $this->conexion->conectar()->query($query);
    }
}
?>
