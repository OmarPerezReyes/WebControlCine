<div class="container mt-4">
    <h2 class="mb-4">Listado de Clientes</h2>

    <a href="./index.php?controller=ClientesController&action=alta" class="btn btn-primary mb-3">Agregar Cliente</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['id_cliente']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $cliente['edad']; ?></td>
                    <td>
                        <a href="./index.php?controller=ClientesController&action=editar&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="./index.php?controller=ClientesController&action=eliminar&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
