<div class="container mt-4">
    <h2>Alta de Empleado</h2>

    <form method="post" action="./index.php?controller=EmpleadosController&action=alta">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Nombre" required>
        </div>
        <div class="form-group">
            <input type="number" name="edad" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Edad" required>
        </div>

        <button type="submit" class="btn btn-outline-success">Guardar</button>
    </form>
</div>
