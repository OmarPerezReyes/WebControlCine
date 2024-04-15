<div class="container mt-4">
    <h2>Búsqueda de Ventas Diarias</h2>

    <form method="post" action="./index.php?controller=VentasController&action=leerRango">
        <div class="form-group">
            <label for="fechaInicio">Fecha de inicio:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" class="form-control border-0 border-bottom border-primary mb-3" required>
        </div>
        <div class="form-group">
            <label for="fechaFin">Fecha de fin:</label>
            <input type="date" id="fechaFin" name="fechaFin" class="form-control border-0 border-bottom border-primary mb-3" required>
        </div>
        <button type="submit" class="btn btn-outline-success">Buscar</button>
    </form>
</div>
