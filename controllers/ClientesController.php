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
            
            // Validar nombre
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $nombre)) {
                // Nombre inválido, mostrar alerta y redirigir
                echo "<script>alert('El nombre solo puede contener letras y espacios');</script>";
                echo "<script>window.location.href = 'index.php?controller=ClientesController&action=alta';</script>";
                exit();
            }
            
            // Validar edad
            if (!ctype_digit($edad) || $edad <= 0 || $edad > 100) {
                // Edad inválida, mostrar alerta y redirigir
                echo "<script>alert('La edad debe ser un número entero positivo menor o igual a 100');</script>";
                echo "<script>window.location.href = 'index.php?controller=ClientesController&action=alta';</script>";
                exit();
            }
    
            // Si la validación pasa, insertar el cliente y redirigir
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
            
            // Validar nombre
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $nombre)) {
                // Nombre inválido, mostrar alerta y redirigir
                echo "<script>alert('El nombre solo puede contener letras y espacios');</script>";
                echo "<script>window.location.href = 'index.php?controller=ClientesController&action=editar&id=$id';</script>";
                exit();
            }
            
            // Validar edad
            if (!ctype_digit($edad) || $edad <= 0 || $edad > 100) {
                // Edad inválida, mostrar alerta y redirigir
                echo "<script>alert('La edad debe ser un número entero positivo menor o igual a 100');</script>";
                echo "<script>window.location.href = 'index.php?controller=ClientesController&action=editar&id=$id';</script>";
                exit();
            }
    
            // Si la validación pasa, actualizar el cliente y redirigir
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
