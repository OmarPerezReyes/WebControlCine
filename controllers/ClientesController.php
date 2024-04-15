<?php

require_once './models/Clientes.php';

class ClientesController {
    private $clientesModel;

    public function __construct() {
        $this->clientesModel = new Clientes();
    }

    public function index() {
        $clientes = $this->clientesModel->obtenerClientes();
        include './views/clientes/index.php';
    }
    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];

            // Insertar el cliente y redirigir
            $this->clientesModel->insertarCliente($nombre, $edad);
            header("Location: index.php?controller=ClientesController&action=index");
        } else {
            include './views/clientes/alta.php';
        }
    }
    
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];
            
    
            // Actualizar el cliente y redirigir
            $this->clientesModel->actualizarCliente($id, $nombre, $edad);
            header("Location: index.php?controller=ClientesController&action=index");
        } else {
            $id = $_GET['id'];
            $cliente = $this->clientesModel->obtenerClientePorId($id);
            include './views/clientes/editar.php';
        }
    }
    
    public function eliminar() {
        $id = $_GET['id'];
        $this->clientesModel->eliminarCliente($id);
        header("Location: index.php?controller=ClientesController&action=index");
    }
}
?>
