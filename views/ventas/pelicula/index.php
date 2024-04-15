<div class="container mt-4">
    <h2 class="mb-4">Listado de Ventas de Boletos</h2>

    <a href="./index.php?controller=VentasController&action=crearVentaBoleto" class="btn btn-primary mb-3">Agregar Venta de Boleto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID de Venta</th>
                <th>ID de Película</th>
                <th>ID de Cliente</th>
                <th>ID de Empleado</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php //echo var_dump($ventas);
 foreach ($ventas as $venta): ?>
                <tr>
                    <td><?php echo $venta['id_ticket_pelicula']; ?></td>
                    <td><?php echo $venta['pelicula_nombre']; ?></td>
                    <td><?php echo $venta['cliente_nombre']; ?></td>
                    <td><?php echo $venta['empleado_nombre']; ?></td>
                    <td><?php echo $venta['fecha']; ?></td>
                    <td><?php echo $venta['total']; ?></td>
                    <td>
                        <a href="./index.php?controller=VentasController&action=editarVentaPelicula&id=<?php echo $venta['id_ticket_pelicula']; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="./index.php?controller=VentasController&action=eliminarTicketPelicula&id=<?php echo $venta['id_ticket_pelicula']; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
