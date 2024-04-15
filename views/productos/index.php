<div class="container mt-4">
    <h2 class="mb-4">Listado de Productos</h2>

    <a href="./index.php?controller=ProductosController&action=alta" class="btn btn-primary mb-3">Agregar Producto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad en Inventario</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto['id_producto']; ?></td>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['precio']; ?></td>
                    <td><?php echo $producto['cantidad_inventario']; ?></td>
                    <td><?php echo $producto['descripcion']; ?></td>
                    <td>
                        <a href="./index.php?controller=ProductosController&action=editar&id=<?php echo $producto['id_producto']; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="./index.php?controller=ProductosController&action=eliminar&id=<?php echo $producto['id_producto']; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
