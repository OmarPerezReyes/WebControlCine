<?php

require_once './models/Conexion.php';

class TicketProducto {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerTicketsProducto() {
        $query = "SELECT * FROM ticket_producto";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertarTicketProducto($id_cliente, $id_empleado, $fecha, $total, $productosSeleccionados) {
        // Establecer conexión
        $conexion = $this->conexion->conectar();
    
        // Insertar el ticket de producto
        $query = "INSERT INTO ticket_producto (id_cliente, id_empleado, fecha, total) VALUES ('$id_cliente', '$id_empleado', '$fecha', '$total')";
        $conexion->query($query);
        
        // Obtener el ID del ticket de producto recién insertado
        $ticket_id = $conexion->insert_id;
        
        // Insertar los productos asociados al ticket en la tabla intermedia
        foreach ($productosSeleccionados as $id_producto) {
            $query = "INSERT INTO ticket_producto_producto (id_ticket_producto, id_producto) VALUES ('$ticket_id', '$id_producto')";
            $conexion->query($query);
        }
        
        // Cerrar conexión
        $conexion->close();
    
        return $ticket_id;
    }

    public function eliminarTicketProducto($id_ticket_producto) {
        // Establecer conexión
        $conexion = $this->conexion->conectar();
    
        // Eliminar los registros asociados en la tabla intermedia
        $query = "DELETE FROM ticket_producto_producto WHERE id_ticket_producto = '$id_ticket_producto'";
        $conexion->query($query);
    
        // Eliminar el ticket de producto
        $query = "DELETE FROM ticket_producto WHERE id_ticket_producto = '$id_ticket_producto'";
        $conexion->query($query);
    
        // Cerrar conexión
        $conexion->close();
    }
    
    public function obtenerTicketProductoPorId($id_ticket_producto) {
        // Establecer conexión
        $conexion = $this->conexion->conectar();
    
        // Consulta SQL para obtener el ticket de producto por su ID
        $query = "SELECT * FROM ticket_producto WHERE id_ticket_producto = '$id_ticket_producto'";
    
        // Ejecutar la consulta
        $resultado = $conexion->query($query);
    
        // Verificar si se encontró un resultado
        if ($resultado->num_rows > 0) {
            // Obtener el primer y único resultado
            $ticket_producto = $resultado->fetch_assoc();
            
            // Cerrar la conexión
            $conexion->close();
            
            return $ticket_producto;
        } else {
            // Si no se encuentra el ticket de producto, retornar null
            $conexion->close();
            return null;
        }
    }

    public function obtenerProductosAsociados($id_ticket_producto) {
        // Establecer conexión
        $conexion = $this->conexion->conectar();
    
        // Consulta SQL para obtener los id_producto asociados al id_ticket_producto en la tabla intermedia
        $query = "SELECT id_producto FROM ticket_producto_producto WHERE id_ticket_producto = '$id_ticket_producto'";
    
        // Ejecutar la consulta
        $resultado = $conexion->query($query);
    
        // Array para almacenar los id_producto
        $productos_asociados = array();
    
        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Iterar sobre los resultados y almacenar los id_producto en el array
            while ($fila = $resultado->fetch_assoc()) {
                $productos_asociados[] = $fila['id_producto'];
            }
        }
    
        // Cerrar la conexión
        $conexion->close();
    
        return $productos_asociados;
    }
    // Función para actualizar un ticket de producto existente
    public function actualizarTicketProducto($id_ticket_producto, $id_cliente, $id_empleado, $fecha, $total) {
        $query = "UPDATE ticket_producto SET id_cliente = '$id_cliente', id_empleado = '$id_empleado', fecha = '$fecha', total = '$total' WHERE id_ticket_producto = '$id_ticket_producto'";
        $this->conexion->conectar()->query($query);
    }

    // Función para eliminar los productos asociados a un ticket
    public function eliminarProductosVenta($id_ticket_producto) {
        $query = "DELETE FROM ticket_producto_producto WHERE id_ticket_producto = '$id_ticket_producto'";
        $this->conexion->conectar()->query($query);
    }
    
    // Función para insertar un producto asociado a un ticket en la tabla intermedia
    public function insertarProductoTicket($id_ticket_producto, $id_producto) {
        $query = "INSERT INTO ticket_producto_producto (id_ticket_producto, id_producto) VALUES ('$id_ticket_producto', '$id_producto')";
        $this->conexion->conectar()->query($query);
    }
    
}
?>
