<?php

require_once './models/Generos.php';

class GenerosController {
    private $generosModel;

    public function __construct() {
        $this->generosModel = new Generos();
    }

    public function index() {
        $generos = $this->generosModel->obtenerGeneros();
        include './views/generos/index.php';
    }
    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            // Validar nombre
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $nombre)) {
                // Nombre inválido, mostrar alerta y redirigir
                echo "<script>alert('El nombre solo puede contener letras y espacios');</script>";
                echo "<script>window.location.href = 'index.php?controller=GenerosController&action=alta';</script>";
                exit();
            }

            // Si la validación pasa, insertar el genero y redirigir
            $this->generosModel->insertarGenero($nombre);

            header("Location: index.php?controller=GenerosController&action=index");
        } else {
            include './views/generos/alta.php';
        }
    }
    
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            
            // Validar nombre
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $nombre)) {
                // Nombre inválido, mostrar alerta y redirigir
                echo "<script>alert('El nombre solo puede contener letras y espacios');</script>";
                echo "<script>window.location.href = 'index.php?controller=GenerosController&action=editar&id=$id';</script>";
                exit();
            }
            
    
            // Si la validación pasa, actualizar el genero y redirigir
            $this->generosModel->actualizarGenero($id, $nombre);
            header("Location: index.php?controller=GenerosController&action=index");
        } else {
            $id = $_GET['id'];
            $genero = $this->generosModel->obtenerGeneroPorId($id);
            include './views/generos/editar.php';
        }
    }
    
    public function eliminar() {
        $id = $_GET['id'];
        $this->generosModel->eliminarGenero($id);
        header("Location: index.php?controller=GenerosController&action=index");
    }
}
?>
