<div class="container mt-4">
    <h2 class="mb-4">Listado de Películas</h2>

    <a href="./index.php?controller=PeliculasController&action=alta" class="btn btn-primary mb-3">Agregar Película</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Sinopsis</th>
                <th>Género</th>
                <th>Fecha Inicio Cartelera</th>
                <th>Fecha Fin Cartelera</th>
                <th>Clasificación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php // var_dump($peliculas);
             foreach ($peliculas as $pelicula): ?>
                <tr>
                    <td><?php echo $pelicula['id_pelicula']; ?></td>
                    <td><?php echo $pelicula['nombre']; ?></td>
                    <td><?php echo $pelicula['sinopsis']; ?></td>
                    <td><?php echo $pelicula['genero_nombre']; ?></td>
                    <td><?php echo $pelicula['fecha_inicio_cartelera']; ?></td>
                    <td><?php echo $pelicula['fecha_fin_cartelera']; ?></td>
                    <td><?php echo $pelicula['clasificacion']; ?></td>
                    <td>
                        <a href="./index.php?controller=PeliculasController&action=editar&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-outline-secondary btn-sm">Editar</a>
                        <a href="./index.php?controller=PeliculasController&action=eliminar&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn btn-outline-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
