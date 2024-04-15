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
          
            // Insertar el genero y redirigir
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
            
            // Actualizar el genero y redirigir
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
