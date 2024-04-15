<div class="container mt-4">
    <h2 class="mb-4">Listado de Ventas de Productos</h2>

    <a href="./index.php?controller=VentasController&action=crearVentaProducto" class="btn btn-primary mb-3">Agregar Venta de Producto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID de Venta</th>
                <th>ID de Cliente</th>
                <th>ID de Empleado</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?php echo $venta['id_ticket_producto']; ?></td>
                    <td><?php echo $venta['cliente_nombre']; ?></td>
                    <td><?php echo $venta['empleado_nombre']; ?></td>
                    <td><?php echo $venta['fecha']; ?></td>
                    <td><?php echo $venta['total']; ?></td>
                    <td>
                        <a href="./index.php?controller=VentasController&action=editarVentaProducto&id=<?php echo $venta['id_ticket_producto']; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="./index.php?controller=VentasController&action=eliminarTicketProducto&id=<?php echo $venta['id_ticket_producto']; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
