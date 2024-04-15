<div class="container mt-4">
    <h2>Editar Película</h2>

    <form method="post" action="./index.php?controller=PeliculasController&action=editar">
        <input type="hidden" name="id" value="<?php echo $pelicula['id_pelicula']; ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $pelicula['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="sinopsis">Sinopsis:</label>
            <textarea name="sinopsis" class="form-control border-0 border-bottom border-primary mb-3" rows="3" required><?php echo $pelicula['sinopsis']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="id_genero">Género:</label>
            <select name="id_genero" class="form-control border-0 border-bottom border-primary mb-3" required>
                <?php foreach ($generos as $genero): ?>
                    <option value="<?php echo $genero['id_genero']; ?>" <?php if ($genero['id_genero'] === $pelicula['id_genero']) echo 'selected'; ?>><?php echo $genero['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio_cartelera">Fecha Inicio Cartelera:</label>
            <input type="date" name="fecha_inicio_cartelera" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $pelicula['fecha_inicio_cartelera']; ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_cartelera">Fecha Fin Cartelera:</label>
            <input type="date" name="fecha_fin_cartelera" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $pelicula['fecha_fin_cartelera']; ?>" required>
        </div>
        <div class="form-group">
            <label for="clasificacion">Clasificación:</label>
            <select name="clasificacion" class="form-control border-0 border-bottom border-primary mb-3" required>
                <option value="AA" <?php if ($pelicula['clasificacion'] === 'AA') echo 'selected'; ?>>AA - Películas para todo público con atractivo infantil</option>
                <option value="A" <?php if ($pelicula['clasificacion'] === 'A') echo 'selected'; ?>>A - Películas para todo público</option>
                <option value="B" <?php if ($pelicula['clasificacion'] === 'B') echo 'selected'; ?>>B - Películas para adolescentes de 12 años en adelante</option>
                <option value="B15" <?php if ($pelicula['clasificacion'] === 'B15') echo 'selected'; ?>>B15 - No recomendable para menores de 15 años</option>
                <option value="C" <?php if ($pelicula['clasificacion'] === 'C') echo 'selected'; ?>>C - Películas para adultos de 18 años en adelante</option>
                <option value="D" <?php if ($pelicula['clasificacion'] === 'D') echo 'selected'; ?>>D - Películas para adultos con contenido explícito</option>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-success">Guardar Cambios</button>
    </form>
</div>
