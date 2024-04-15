<div class="container mt-4">
    <h2>Editar Cliente</h2>

    <form method="post" action="./index.php?controller=ClientesController&action=editar">
        <input type="hidden" name="id" value="<?php echo $cliente['id_cliente']; ?>">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $cliente['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <input type="number" name="edad" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $cliente['edad']; ?>" required>
        </div>

        <button type="submit" class="btn btn-outline-success">Guardar Cambios</button>
    </form>
</div>
