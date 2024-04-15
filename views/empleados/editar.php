<div class="container mt-4">
    <h2>Editar Empleado</h2>

    <form method="post" action="./index.php?controller=EmpleadosController&action=editar">
        <input type="hidden" name="id" value="<?php echo $empleado['id_empleado']; ?>">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $empleado['nombre']; ?>" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="Ingresa un nombre válido (solo letras y espacios)">
        </div>
        <div class="form-group">
            <input type="number" name="edad" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $empleado['edad']; ?>" required required min="18" max="99">
        </div>

        <button type="submit" class="btn btn-outline-success">Guardar Cambios</button>
    </form>
</div>
