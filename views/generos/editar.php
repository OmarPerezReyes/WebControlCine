<div class="container mt-4">
    <h2>Editar Género Cinematográfico</h2>

    <form method="post" action="./index.php?controller=GenerosController&action=editar">
        <input type="hidden" name="id" value="<?php echo $genero['id_genero']; ?>">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $genero['nombre']; ?>" required>
        </div>
        <button type="submit" class="btn btn-outline-success">Guardar Cambios</button>
    </form>
</div>
