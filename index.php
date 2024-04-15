<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto U3</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo */
            color: #343a40; /* Color de texto */
        }
        .navbar {
            background-color: #343a40; /* Color de fondo de la barra de navegación */
        }
        .navbar-brand {
            color: #ffffff; /* Color del texto del enlace en la barra de navegación */
            font-weight: bold;
        }
        .nav-link {
            color: #ffffff; /* Color del texto del enlace en la barra de navegación */
        }
        .nav-link:hover {
    background-color: #5f6368; /* Color de fondo al pasar el cursor por encima */
    color: white !important; /* Color del texto del enlace en la barra de navegación */
}

        .container {
            margin-top: 50px; /* Espacio superior */
        }
        .nav-tabs .nav-item .nav-link {
            color: #343a40; /* Color del texto del enlace en la pestaña */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Control de cine</a>
    </nav>

    <div class="container mt-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="./index.php?controller=ClientesController&action=index">Clientes</a>
                <a class="nav-link" href="./index.php?controller=EmpleadosController&action=index">Empleados</a>
                <a class="nav-link" href="./index.php?controller=ProductosController&action=index">Productos</a>
                <a class="nav-link" href="./index.php?controller=GenerosController&action=index">Generos</a>
                <a class="nav-link" href="./index.php?controller=PeliculasController&action=index">Películas</a>
                <a class="nav-link" href="./index.php?controller=VentasController&action=indexProductos">Venta de productos</a>
                <a class="nav-link" href="./index.php?controller=VentasController&action=indexPeliculas">Venta de boletos</a>
                
                <!--Reportes-->
                <a class="nav-link" href="./index.php?controller=VentasController&action=ventasDiarias">Ventas diarias</a>
                <a class="nav-link" href="./index.php?controller=VentasController&action=leerRango">Ventas por rango de fecha</a>
                <a class="nav-link" href="./index.php?controller=ClientesController&action=index">Listado de clientes</a>
                <a class="nav-link" href="./index.php?controller=EmpleadosController&action=index">Listdo de empleados</a>
            </li>
        </ul>

        <?php
            if (isset($_GET['controller']) && isset($_GET['action'])) {
                $controller = $_GET['controller'];
                $action = $_GET['action'];

                require_once "controllers/$controller.php";
                
                $controller = new $controller();

                $controller->$action();
            }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
