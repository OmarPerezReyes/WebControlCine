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
    
public function obtenerFechasCarteleraPorId($id_pelicula) {
    $query = "SELECT fecha_inicio_cartelera, fecha_fin_cartelera FROM pelicula WHERE id_pelicula = $id_pelicula";
    $result = $this->conexion->conectar()->query($query);

    // Verificar si se obtuvieron resultados
    if ($result) {
        // Extraer las fechas de inicio y fin de la cartelera de la fila obtenida
        $cartelera = $result->fetch_assoc();
        $fecha_inicio_cartelera = $cartelera['fecha_inicio_cartelera'];
        $fecha_fin_cartelera = $cartelera['fecha_fin_cartelera'];
        // Devolver las fechas de inicio y fin de la cartelera
        return array($fecha_inicio_cartelera, $fecha_fin_cartelera);
    } else {
        // Si no se encuentran datos, devolver un array vacío o null
        return array();
    }
}
}



?>
