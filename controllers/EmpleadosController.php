<?php

require_once './models/Empleados.php';

class EmpleadosController {
    private $empleadosModel;

    public function __construct() {
        $this->empleadosModel = new Empleados();
    }

    public function index() {
        $empleados = $this->empleadosModel->obtenerEmpleados();
        include './views/empleados/index.php';
    }
    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];
            
            // Validar nombre
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $nombre)) {
                // Nombre inválido, mostrar alerta y redirigir
                echo "<script>alert('El nombre solo puede contener letras y espacios');</script>";
                echo "<script>window.location.href = 'index.php?controller=EmpleadosController&action=alta';</script>";
                exit();
            }
            
            // Validar edad
            if (!ctype_digit($edad) || $edad <= 0 || $edad > 100) {
                // Edad inválida, mostrar alerta y redirigir
                echo "<script>alert('La edad debe ser un número entero positivo menor o igual a 100');</script>";
                echo "<script>window.location.href = 'index.php?controller=EmpleadosController&action=alta';</script>";
                exit();
            }
    
            // Si la validación pasa, insertar el empleado y redirigir
            $this->empleadosModel->insertarEmpleado($nombre, $edad);
            header("Location: index.php?controller=EmpleadosController&action=index");
        } else {
            include './views/empleados/alta.php';
        }
    }
    
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $edad = $_POST['edad'];
            
            // Validar nombre
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $nombre)) {
                // Nombre inválido, mostrar alerta y redirigir
                echo "<script>alert('El nombre solo puede contener letras y espacios');</script>";
                echo "<script>window.location.href = 'index.php?controller=EmpleadosController&action=editar&id=$id';</script>";
                exit();
            }
            
            // Validar edad
            if (!ctype_digit($edad) || $edad <= 0 || $edad > 100) {
                // Edad inválida, mostrar alerta y redirigir
                echo "<script>alert('La edad debe ser un número entero positivo menor o igual a 100');</script>";
                echo "<script>window.location.href = 'index.php?controller=EmpleadosController&action=editar&id=$id';</script>";
                exit();
            }
    
            // Si la validación pasa, actualizar el empleado y redirigir
            $this->empleadosModel->actualizarEmpleado($id, $nombre, $edad);
            header("Location: index.php?controller=EmpleadosController&action=index");
        } else {
            $id = $_GET['id'];
            $empleado = $this->empleadosModel->obtenerEmpleadoPorId($id);
            include './views/empleados/editar.php';
        }
    }
    
    public function eliminar() {
        $id = $_GET['id'];
        $this->empleadosModel->eliminarEmpleado($id);
        header("Location: index.php?controller=EmpleadosController&action=index");
    }
}
?>
