<?php

require_once './models/Peliculas.php';
require_once './models/Productos.php';
require_once './models/Clientes.php';
require_once './models/Empleados.php';
require_once './models/TicketProducto.php';
require_once './models/TicketPelicula.php';

class VentasController {
    private $peliculasModel;
    private $productosModel;
    private $clientesModel;
    private $empleadosModel;
    private $ticketProductoModel;

    public function __construct() {
        $this->peliculasModel = new Peliculas();
        $this->productosModel = new Productos();
        $this->clientesModel = new Clientes();
        $this->empleadosModel = new Empleados();
        $this->ticketProductoModel = new TicketProducto();
        $this->ticketPeliculaModel = new TicketPelicula();
    }


    //PRODUCTOS

    public function indexProductos() {
        $ventas = $this->ticketProductoModel->obtenerTicketsProducto();
       // Obtener nombres de clientes y empleados
foreach ($ventas as $index => $venta) {
    $id_cliente = $venta['id_cliente'];
    $id_empleado = $venta['id_empleado'];

    // Obtener nombre del cliente
    $cliente = $this->clientesModel->obtenerClientePorId($id_cliente);
    $ventas[$index]['cliente_nombre'] = $cliente['nombre'];

    // Obtener nombre del empleado
    $empleado = $this->empleadosModel->obtenerEmpleadoPorId($id_empleado);
    $ventas[$index]['empleado_nombre'] = $empleado['nombre'];
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
    



    //PELÍCULAS

    public function indexPeliculas() {
        $ventas = $this->ticketPeliculaModel->obtenerTicketsPelicula();
        //echo "hoola";
        // Obtener nombres de clientes y empleados
  
    
    // Obtener nombres de clientes y empleados
    foreach ($ventas as $index => $venta) {
    $id_pelicula = $venta['id_pelicula'];
    $id_cliente = $venta['id_cliente'];
    $id_empleado = $venta['id_empleado'];

            // Obtener nombre de la película
            $pelicula = $this->peliculasModel->obtenerPeliculaPorId($id_pelicula);
            $ventas[$index]['pelicula_nombre'] = $pelicula['nombre'];

    // Obtener nombre del cliente
    $cliente = $this->clientesModel->obtenerClientePorId($id_cliente);
    $ventas[$index]['cliente_nombre'] = $cliente['nombre'];

    // Obtener nombre del empleado
    $empleado = $this->empleadosModel->obtenerEmpleadoPorId($id_empleado);
    $ventas[$index]['empleado_nombre'] = $empleado['nombre'];
}
        include './views/ventas/pelicula/index.php';
    }


       public function crearVentaBoleto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id_pelicula = $_POST['id_pelicula'];
            $id_cliente = $_POST['id_cliente'];
            $id_empleado = $_POST['id_empleado'];
            $fecha = $_POST['fecha'];
            $total = 0;
          

            // Obtener fechas de inicio y fin de la cartelera
        list($fecha_inicio_cartelera, $fecha_fin_cartelera) = $this->peliculasModel->obtenerFechasCarteleraPorId($id_pelicula);

        // Validar que la fecha seleccionada esté dentro del rango de la cartelera
        $fecha_timestamp = strtotime($fecha);
        $inicio_cartelera_timestamp = strtotime($fecha_inicio_cartelera);
        $fin_cartelera_timestamp = strtotime($fecha_fin_cartelera);

        if ($fecha_timestamp < $inicio_cartelera_timestamp || $fecha_timestamp > $fin_cartelera_timestamp) {
            // La fecha seleccionada está fuera del rango de la cartelera
            echo "<script>alert('La fecha seleccionada está fuera del rango de la cartelera');</script>";
            echo "<script>window.location.href = 'index.php?controller=VentasController&action=indexPeliculas';</script>";
            exit();
        }
 // Calcular el total basado en la edad del cliente
 $cliente = $this->clientesModel->obtenerClientePorId($id_cliente);
 $edad = $cliente['edad'];
// echo $edad;
           
$pelicula = $this->peliculasModel->obtenerPeliculaPorId($id_pelicula);
$clasificacion_pelicula = $pelicula['clasificacion'];
//echo $clasificacion_pelicula;
// Verificar si la edad del cliente corresponde a la clasificación de la película
if (($clasificacion_pelicula == 'A' && $edad >= 0) ||
    ($clasificacion_pelicula == 'B' && $edad >= 12) ||
    ($clasificacion_pelicula == 'B15' && $edad >= 15) ||
    ($clasificacion_pelicula == 'C' && $edad >= 18) ||
    ($clasificacion_pelicula == 'AA' && $edad >=0) ||
    ($clasificacion_pelicula == 'D' && $edad >= 18)) {
      // La edad del cliente es adecuada para la clasificación de la película
  
    echo "bien";      
    
} else {
    echo "<script>alert('La edad del cliente no corresponde a la clasificación de la película seleccionada.');</script>";
    echo "<script>window.location.href = 'index.php?controller=VentasController&action=indexPeliculas';</script>";
    exit();
}
    // Asignar el precio correspondiente
    if ($edad >= 14 && $edad <= 60) {
        $total = 85; // Precio para adultos
    } else if ($edad < 14 || $edad > 60) {
        $total = 65; // Precio para niños y adultos de la tercera edad
    }
            // Insertar el ticket de venta
            $ticket_id = $this->ticketPeliculaModel->insertarTicketPelicula($id_pelicula, $id_cliente, $id_empleado, $fecha, $total);

            // Redirigir al listado de ventas
            header("Location: index.php?controller=VentasController&action=indexPeliculas");
        } else {
            // Obtener lista de peliculas para mostrar en el formulario de venta
            $peliculas = $this->peliculasModel->obtenerPeliculas();
            //var_dump($peliculas);
            
            $clientes = $this->clientesModel->obtenerClientes();
            $empleados = $this->empleadosModel->obtenerEmpleados();
            include './views/ventas/pelicula/alta.php';
        }
    }
    
    public function editarVentaPelicula() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id_ticket_pelicula = $_POST['id_ticket_pelicula'];
            $id_pelicula = $_POST['id_pelicula'];
            $id_cliente = $_POST['id_cliente'];
            $id_empleado = $_POST['id_empleado'];
            $fecha = $_POST['fecha'];
            $total = 0;
            // Obtener fechas de inicio y fin de la cartelera
            list($fecha_inicio_cartelera, $fecha_fin_cartelera) = $this->peliculasModel->obtenerFechasCarteleraPorId($id_pelicula);
    
            // Validar que la fecha seleccionada esté dentro del rango de la cartelera
            $fecha_timestamp = strtotime($fecha);
            $inicio_cartelera_timestamp = strtotime($fecha_inicio_cartelera);
            $fin_cartelera_timestamp = strtotime($fecha_fin_cartelera);
    
            if ($fecha_timestamp < $inicio_cartelera_timestamp || $fecha_timestamp > $fin_cartelera_timestamp) {
                // La fecha seleccionada está fuera del rango de la cartelera
                echo "<script>alert('La fecha seleccionada está fuera del rango de la cartelera');</script>";
                echo "<script>window.location.href = 'index.php?controller=VentasController&action=indexPeliculas';</script>";
                exit();
            }
            
 // Calcular el total basado en la edad del cliente
 $cliente = $this->clientesModel->obtenerClientePorId($id_cliente);
 $edad = $cliente['edad'];
// echo $edad;
           
$pelicula = $this->peliculasModel->obtenerPeliculaPorId($id_pelicula);
$clasificacion_pelicula = $pelicula['clasificacion'];
//echo $clasificacion_pelicula;
// Verificar si la edad del cliente corresponde a la clasificación de la película
if (($clasificacion_pelicula == 'A' && $edad >= 0) ||
    ($clasificacion_pelicula == 'B' && $edad >= 12) ||
    ($clasificacion_pelicula == 'B15' && $edad >= 15) ||
    ($clasificacion_pelicula == 'C' && $edad >= 18) ||
    ($clasificacion_pelicula == 'AA' && $edad >=0) ||
    ($clasificacion_pelicula == 'D' && $edad >= 18)) {
      // La edad del cliente es adecuada para la clasificación de la película
  
    echo "bien";      
    
} else {
    echo "<script>alert('La edad del cliente no corresponde a la clasificación de la película seleccionada.');</script>";
    echo "<script>window.location.href = 'index.php?controller=VentasController&action=indexPeliculas';</script>";
    exit();
}
    // Asignar el precio correspondiente
    if ($edad >= 14 && $edad <= 60) {
        $total = 85; // Precio para adultos
    } else if ($edad < 14 || $edad > 60) {
        $total = 65; // Precio para niños y adultos de la tercera edad
    }
    

            // Actualizar el ticket de venta
            $this->ticketPeliculaModel->actualizarTicketPelicula($id_ticket_pelicula, $id_pelicula, $id_cliente, $id_empleado, $fecha, $total);
            //echo "bien";
    
            // Redirigir al listado de ventas
           header("Location: index.php?controller=VentasController&action=indexPeliculas");
        } else {
            // Obtener el ID del ticket de película a editar
            $id_ticket_pelicula = $_GET['id'];

            // Obtener datos de la venta de boleto de película para mostrar en el formulario de edición
            $venta = $this->ticketPeliculaModel->obtenerTicketPeliculaPorId($id_ticket_pelicula);
    
            // Obtener lista de películas, clientes y empleados para mostrar en el formulario de edición
            $peliculas = $this->peliculasModel->obtenerPeliculas();
            $clientes = $this->clientesModel->obtenerClientes();
            $empleados = $this->empleadosModel->obtenerEmpleados();
    
            // Incluir el formulario de edición
            include './views/ventas/pelicula/editar.php';
        }
    }
    


public function eliminarTicketPelicula() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id_ticket_pelicula = $_GET['id'];
echo "aqui";
        // Eliminar el ticket de pelicula y los registros asociados en la tabla intermedia
        $this->ticketPeliculaModel->eliminarTicketPelicula($id_ticket_pelicula);

        // Redirigir al listado de ventas de peliculas
        header("Location: index.php?controller=VentasController&action=indexPeliculas");
    } else {
        // Si no se proporciona un ID de ticket de pelicula, redirigir a la página de listado de ventas de peliculas
        header("Location: index.php?controller=VentasController&action=indexPeliculas");
    }
}

 
    //REPORTES
    public function ventasDiarias() {
        // Llamar al método del modelo para obtener las ventas diarias de productos
        $fecha_actual = date('Y-m-d');

        $ventas_productos = $this->ticketProductoModel->obtenerVentasDiariasProductos($fecha_actual);
        $ventas_boletos = $this->ticketPeliculaModel->obtenerVentasDiariasPeliculas($fecha_actual);
        
        // Retornar el resultado obtenido del modelo
        //var_dump ($ventas_productos);
        //var_dump($ventas_boletos);
        include './views/ventas/ventas_diarias.php';

    }
    
    
    

}
?>
