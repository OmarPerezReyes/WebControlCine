<div class="container mt-4">
    <h2>Alta de Empleado</h2>

    <form method="post" action="./index.php?controller=EmpleadosController&action=alta">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="Ingresa un nombre válido (solo letras y espacios)">
        </div>
        <div class="form-group">
            <input type="number" name="edad" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Edad" required required min="18" max="99">
        </div>

        <button type="submit" class="btn btn-outline-success">Guardar</button>
    </form>
</div>
