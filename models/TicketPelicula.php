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

    public function obtenerVentasDiariasPeliculas($fecha) {
        // Consulta SQL para obtener las ventas de películas para la fecha especificada
        $sql = "SELECT * FROM ticket_pelicula WHERE DATE(fecha) = '$fecha'";
        $resultado = $this->conexion->conectar()->query($sql);
        
        // Array para almacenar las ventas de películas y sus detalles
        $ventas_peliculas = array();
        
        // Verificar si se encontraron ventas de películas
        if ($resultado->num_rows > 0) {
            // Iterar sobre las ventas de películas
            while ($venta = $resultado->fetch_assoc()) {
                // Obtener el nombre de la película
                $id_pelicula = $venta['id_pelicula'];
                $query_nombre_pelicula = "SELECT nombre FROM pelicula WHERE id_pelicula = '$id_pelicula'";
                $resultado_nombre_pelicula = $this->conexion->conectar()->query($query_nombre_pelicula);
                $nombre_pelicula = ($resultado_nombre_pelicula->num_rows > 0) ? $resultado_nombre_pelicula->fetch_assoc()['nombre'] : '';
    
                // Obtener el costo del boleto y determinar la categoría
                $costo_boleto = $venta['total'];
                $categoria = '';
                if ($costo_boleto == 85) {
                    $categoria = 'Adulto';
                } elseif ($costo_boleto == 65) {
                    $categoria = 'Menor o Adulto Mayor';
                } else {
                    // Cualquier otro costo que no sea 85 ni 65 se considera como categoría no definida
                    $categoria = 'No Definida';
                }
    
                // Agregar el nombre de la película y la categoría del boleto a los detalles de la venta
                $venta['nombre_pelicula'] = $nombre_pelicula;
                $venta['categoria_boleto'] = $categoria;
                $venta['costo_boleto'] = $costo_boleto;

    
                // Agregar la venta de película al array de ventas de películas
                $ventas_peliculas[] = $venta;
            }
        }
        
        return $ventas_peliculas;
    }
    
}
?>
