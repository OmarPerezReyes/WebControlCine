<?php

require_once './models/Peliculas.php';
require_once './models/Generos.php';

class PeliculasController {
    private $peliculasModel;
    private $generosModel;

    public function __construct() {
        $this->peliculasModel = new Peliculas();
        $this->generosModel = new Generos();
    }

    public function index() {
        $peliculas = $this->peliculasModel->obtenerPeliculas();
        $generos = $this->generosModel->obtenerGeneros(); // Obtener lista de géneros
         // Crear un diccionario de géneros para buscar nombres de género por ID de género
    $generos_dict = [];
    foreach ($generos as $genero) {
        $generos_dict[$genero['id_genero']] = $genero['nombre'];
    }

    // Agregar el nombre del género correspondiente a cada película
    foreach ($peliculas as &$pelicula) {
        $genero_id = $pelicula['id_genero'];
        if (isset($generos_dict[$genero_id])) {
            $pelicula['genero_nombre'] = $generos_dict[$genero_id];
        } else {
            $pelicula['genero_nombre'] = 'Desconocido'; // Manejo de géneros desconocidos
        }
    }

        include './views/peliculas/index.php';
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $sinopsis = $_POST['sinopsis'];
            $id_genero = $_POST['id_genero'];
            $fecha_inicio_cartelera = $_POST['fecha_inicio_cartelera'];
            $fecha_fin_cartelera = $_POST['fecha_fin_cartelera'];
            $clasificacion = $_POST['clasificacion'];

             // Validar que la fecha de fin sea posterior a la fecha de inicio
             if ($fecha_inicio_cartelera >= $fecha_fin_cartelera) {
                // Mostrar alerta y redirigir
                echo "<script>alert('La fecha de fin de cartelera debe ser posterior a la fecha de inicio');</script>";
                echo "<script>window.location.href = 'index.php?controller=PeliculasController&action=alta';</script>";
                exit();
            }

            // Insertar la película y redirigir
            $this->peliculasModel->insertarPelicula($nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $clasificacion);
            header("Location: index.php?controller=PeliculasController&action=index");
        } else {
            $generos = $this->generosModel->obtenerGeneros();
            include './views/peliculas/alta.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $sinopsis = $_POST['sinopsis'];
            $id_genero = $_POST['id_genero'];
            $fecha_inicio_cartelera = $_POST['fecha_inicio_cartelera'];
            $fecha_fin_cartelera = $_POST['fecha_fin_cartelera'];
            $clasificacion = $_POST['clasificacion'];

        // Validar que la fecha de fin sea posterior a la fecha de inicio
        if ($fecha_inicio_cartelera >= $fecha_fin_cartelera) {
            // Mostrar alerta y redirigir
            echo "<script>alert('La fecha de fin de cartelera debe ser posterior a la fecha de inicio');</script>";
            echo "<script>window.location.href = 'index.php?controller=PeliculasController&action=editar&id=$id';</script>";
            exit();
        }

            // Actualizar la película y redirigir
            $this->peliculasModel->actualizarPelicula($id, $nombre, $sinopsis, $id_genero, $fecha_inicio_cartelera, $fecha_fin_cartelera, $clasificacion);
            header("Location: index.php?controller=PeliculasController&action=index");
        } else {
            $id = $_GET['id'];
            $pelicula = $this->peliculasModel->obtenerPeliculaPorId($id);
            $generos = $this->generosModel->obtenerGeneros();
            include './views/peliculas/editar.php';
        }
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->peliculasModel->eliminarPelicula($id);
        header("Location: index.php?controller=PeliculasController&action=index");
    }
}
?>
