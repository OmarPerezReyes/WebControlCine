<div class="container mt-4">
    <h2 class="mb-4">Listado de Empleados</h2>

    <a href="./index.php?controller=EmpleadosController&action=alta" class="btn btn-primary mb-3">Agregar Empleado</a>

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
            <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?php echo $empleado['id_empleado']; ?></td>
                    <td><?php echo $empleado['nombre']; ?></td>
                    <td><?php echo $empleado['edad']; ?></td>
                    <td>
                        <a href="./index.php?controller=EmpleadosController&action=editar&id=<?php echo $empleado['id_empleado']; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="./index.php?controller=EmpleadosController&action=eliminar&id=<?php echo $empleado['id_empleado']; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
