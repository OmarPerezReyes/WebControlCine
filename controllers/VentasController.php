<?php

require_once './models/Productos.php';
require_once './models/Clientes.php';
require_once './models/Empleados.php';
require_once './models/TicketProducto.php';

class VentasController {
    private $productosModel;
    private $clientesModel;
    private $empleadosModel;
    private $ticketProductoModel;

    public function __construct() {
        $this->productosModel = new Productos();
        $this->clientesModel = new Clientes();
        $this->empleadosModel = new Empleados();
        $this->ticketProductoModel = new TicketProducto();
    }

    public function indexProductos() {
        $ventas = $this->ticketProductoModel->obtenerTicketsProducto();
        // Obtener nombres de clientes y empleados
    foreach ($ventas as &$venta) {
        $id_cliente = $venta['id_cliente'];
        $id_empleado = $venta['id_empleado'];

        // Obtener nombre del cliente
        $cliente = $this->clientesModel->obtenerClientePorId($id_cliente);
        $venta['cliente_nombre'] = $cliente['nombre'];

        // Obtener nombre del empleado
        $empleado = $this->empleadosModel->obtenerEmpleadoPorId($id_empleado);
        $venta['empleado_nombre'] = $empleado['nombre'];
    }
        include './views/ventas/producto/index.php';
    }

    public function crearVentaProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id_cliente = $_POST['id_cliente'];
            $id_empleado = $_POST['id_empleado'];
            $fecha = $_POST['fecha'];
            $productosSeleccionados = $_POST['productos']; // Array de IDs de productos seleccionados
            $total = 0;
            echo "ID Cliente: $id_cliente <br>";
            echo "ID Empleado: $id_empleado <br>";
            echo "Fecha: $fecha <br>";
            echo "Productos seleccionados: <br>";
            var_dump($productosSeleccionados);
            echo "<br>";
            // Validar que se hayan seleccionado productos
            if (empty($productosSeleccionados)) {
                echo "<script>alert('Debe seleccionar al menos un producto para realizar la venta');</script>";
                echo "<script>window.location.href = 'index.php?controller=VentasController&action=crearVentaProducto';</script>";
                exit();
            }

            // Calcular el total sumando los precios de los productos seleccionados
            foreach ($productosSeleccionados as $id_producto) {
                $producto = $this->productosModel->obtenerProductoPorId($id_producto);
                $total += $producto['precio'];
            }

            // Insertar el ticket de venta
            $ticket_id = $this->ticketProductoModel->insertarTicketProducto($id_cliente, $id_empleado, $fecha, $total, $productosSeleccionados);

            // Redirigir al listado de ventas
            header("Location: index.php?controller=VentasController&action=indexProductos");
        } else {
            // Obtener lista de productos para mostrar en el formulario de venta
            $productos = $this->productosModel->obtenerProductos();
            $clientes = $this->clientesModel->obtenerClientes();
            $empleados = $this->empleadosModel->obtenerEmpleados();
            //var_dump($productos);
            include './views/ventas/producto/alta.php';
        }
    }

    public function eliminarTicketProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id_ticket_producto = $_GET['id'];
echo "aqui";
            // Eliminar el ticket de producto y los registros asociados en la tabla intermedia
            $this->ticketProductoModel->eliminarTicketProducto($id_ticket_producto);

            // Redirigir al listado de ventas de productos
            header("Location: index.php?controller=VentasController&action=indexProductos");
        } else {
            // Si no se proporciona un ID de ticket de producto, redirigir a la página de listado de ventas de productos
            header("Location: index.php?controller=VentasController&action=indexProductos");
        }
    }


    public function editarVentaProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id_ticket_producto = $_POST['id'];
            $id_cliente = $_POST['id_cliente'];
            $id_empleado = $_POST['id_empleado'];
            $fecha = $_POST['fecha'];
            $productosSeleccionados = $_POST['productos']; // Array de IDs de productos seleccionados
            $total = 0;
            echo $id_ticket_producto;

            // Validar que se hayan seleccionado productos
            if (empty($productosSeleccionados)) {
                echo "<script>alert('Debe seleccionar al menos un producto para realizar la venta');</script>";
                echo "<script>window.location.href = 'index.php?controller=VentasController&action=editarVentaProducto&id=$id_ticket_producto';</script>";
                exit();
            }
            // Calcular el total sumando los precios de los productos seleccionados
            foreach ($productosSeleccionados as $id_producto) {
                $producto = $this->productosModel->obtenerProductoPorId($id_producto);
                $total += $producto['precio'];
            }
            // Actualizar el ticket de venta
            $this->ticketProductoModel->actualizarTicketProducto($id_ticket_producto, $id_cliente, $id_empleado, $fecha, $total);
            
            // Eliminar los productos asociados al ticket antes de insertar los nuevos
            $this->ticketProductoModel->eliminarProductosVenta($id_ticket_producto);
            echo $id_ticket_producto;
            // Insertar los productos asociados al ticket en la tabla intermedia
            foreach ($productosSeleccionados as $id_producto) {
                $this->ticketProductoModel->insertarProductoTicket($id_ticket_producto, $id_producto);
            }
            echo "bien";
    
            // Redirigir al listado de ventas
            header("Location: index.php?controller=VentasController&action=indexProductos");
        } else {
            // Obtener ID de la venta a editar
            $id_ticket_producto = $_GET['id'];
            
            // Obtener información de la venta
            $venta = $this->ticketProductoModel->obtenerTicketProductoPorId($id_ticket_producto);
            //var_dump($venta);
            $productosAsociados =  $this->ticketProductoModel->obtenerProductosAsociados($id_ticket_producto);
            //var_dump($productosAsociados);
            // Obtener lista de productos para mostrar en el formulario de edición
            $productos = $this->productosModel->obtenerProductos();
            $clientes = $this->clientesModel->obtenerClientes();
            $empleados = $this->empleadosModel->obtenerEmpleados();
            // Incluir la vista de edición de venta
            include './views/ventas/producto/editar.php';
        }
    }
    
}
?>
