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
            
            // Insertar el empleado y redirigir
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
            
            // Actualizar el empleado y redirigir
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
