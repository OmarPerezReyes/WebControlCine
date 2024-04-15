<div class="container mt-4">
    <h2 class="mb-4">Listado de Géneros Cinematográficos</h2>

    <a href="./index.php?controller=GenerosController&action=alta" class="btn btn-primary mb-3">Agregar Género Cinematográfico</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($generos as $genero): ?>
                <tr>
                    <td><?php echo $genero['id_genero']; ?></td>
                    <td><?php echo $genero['nombre']; ?></td>
                    <td>
                        <a href="./index.php?controller=GenerosController&action=editar&id=<?php echo $genero['id_genero']; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="./index.php?controller=GenerosController&action=eliminar&id=<?php echo $genero['id_genero']; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
