<?php

require_once './models/Productos.php';

class ProductosController {
    private $productosModel;

    public function __construct() {
        $this->productosModel = new Productos();
    }

    public function index() {
        $productos = $this->productosModel->obtenerProductos();
        include './views/productos/index.php';
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad_inventario = $_POST['cantidad_inventario'];
            $descripcion = $_POST['descripcion'];

            // Insertar el producto y redirigir
            $this->productosModel->insertarProducto($nombre, $precio, $cantidad_inventario, $descripcion);

            header("Location: index.php?controller=ProductosController&action=index");
        } else {
            include './views/productos/alta.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad_inventario = $_POST['cantidad_inventario'];
            $descripcion = $_POST['descripcion'];
            
            // Actualizar el producto y redirigir
            $this->productosModel->actualizarProducto($id, $nombre, $precio, $cantidad_inventario, $descripcion);
            header("Location: index.php?controller=ProductosController&action=index");
        } else {
            $id = $_GET['id'];
            $producto = $this->productosModel->obtenerProductoPorId($id);
            include './views/productos/editar.php';
        }
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->productosModel->eliminarProducto($id);
        header("Location: index.php?controller=ProductosController&action=index");
    }
}
?>
