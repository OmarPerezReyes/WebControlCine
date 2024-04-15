<div class="container mt-4">
    <h2>Alta de Película</h2>

    <form method="post" action="./index.php?controller=PeliculasController&action=alta">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Nombre" required>
        </div>
        <div class="form-group">
            <label for="sinopsis">Sinopsis:</label>
            <textarea name="sinopsis" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Sinopsis" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="id_genero">Género:</label>
            <select name="id_genero" class="form-control border-0 border-bottom border-primary mb-3" required>
                <?php foreach ($generos as $genero): ?>
                    <option value="<?php echo $genero['id_genero']; ?>"><?php echo $genero['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
    <label for="fecha_inicio_cartelera">Fecha Inicio Cartelera:</label>
    <input type="date" name="fecha_inicio_cartelera" class="form-control border-0 border-bottom border-primary mb-3" required min="2024-01-01" max="2025-12-31">
</div>
<div class="form-group">
    <label for="fecha_fin_cartelera">Fecha Fin Cartelera:</label>
    <input type="date" name="fecha_fin_cartelera" class="form-control border-0 border-bottom border-primary mb-3" required min="2024-01-01" max="2025-12-31">
</div>

        <div class="form-group">
            <label for="clasificacion">Clasificación:</label>
            <select name="clasificacion" class="form-control border-0 border-bottom border-primary mb-3" required>
                <option value="AA">AA - Películas para todo público con atractivo infantil</option>
                <option value="A">A - Películas para todo público</option>
                <option value="B">B - Películas para adolescentes de 12 años en adelante</option>
                <option value="B15">B15 - No recomendable para menores de 15 años</option>
                <option value="C">C - Películas para adultos de 18 años en adelante</option>
                <option value="D">D - Películas para adultos con contenido explícito</option>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-success">Guardar</button>
    </form>
</div>
