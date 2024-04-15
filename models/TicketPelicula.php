<?php

require_once './models/Conexion.php';

class TicketPelicula {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function obtenerTicketsPelicula() {
        //echo "g";
        $query = "SELECT * FROM ticket_pelicula";
        $resultado = $this->conexion->conectar()->query($query);

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function insertarTicketPelicula($id_pelicula, $id_cliente, $id_empleado, $fecha, $total) {
        // Establecer conexión
        $conexion = $this->conexion->conectar();
    
        // Insertar el ticket de Película
        $query = "INSERT INTO ticket_pelicula (id_pelicula, id_cliente, id_empleado, fecha, total) VALUES ('$id_pelicula','$id_cliente', '$id_empleado', '$fecha', '$total')";
        $conexion->query($query);
        
        // Obtener el ID del ticket de pelicula recién insertado
        $ticket_id = $conexion->insert_id;
        
        
        // Cerrar conexión
        $conexion->close();
    
        return $ticket_id;
    }

    public function eliminarTicketPelicula($id_ticket_pelicula) {
        // Establecer conexión
        $conexion = $this->conexion->conectar();
    
        // Eliminar el ticket de pelicula
        $query = "DELETE FROM ticket_pelicula WHERE id_ticket_pelicula = '$id_ticket_pelicula'";
        $conexion->query($query);
    
        // Cerrar conexión
        $conexion->close();
    }
    
    public function obtenerTicketPeliculaPorId($id_ticket_pelicula) {
        // Establecer conexión
        $conexion = $this->conexion->conectar();
    
        // Consulta SQL para obtener el ticket de pelicula por su ID
        $query = "SELECT * FROM ticket_pelicula WHERE id_ticket_pelicula = '$id_ticket_pelicula'";
    
        // Ejecutar la consulta
        $resultado = $conexion->query($query);
    
        // Verificar si se encontró un resultado
        if ($resultado->num_rows > 0) {
            // Obtener el primer y único resultado
            $ticket_pelicula = $resultado->fetch_assoc();
            
            // Cerrar la conexión
            $conexion->close();
            
            return $ticket_pelicula;
        } else {
            // Si no se encuentra el ticket de pelicula, retornar null
            $conexion->close();
            return null;
        }
    }

    // Función para actualizar un ticket de pelicula existente
    public function actualizarTicketPelicula($id_ticket_pelicula, $id_pelicula, $id_cliente, $id_empleado, $fecha, $total) {
        $query = "UPDATE ticket_pelicula SET id_pelicula = '$id_pelicula', id_cliente = '$id_cliente', id_empleado = '$id_empleado', fecha = '$fecha', total = '$total' WHERE id_ticket_pelicula = '$id_ticket_pelicula'";
        $this->conexion->conectar()->query($query);
    }

    
}
?>
