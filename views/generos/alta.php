<div class="container mt-4">
    <h2>Alta de Género Cinematográfico</h2>

    <form method="post" action="./index.php?controller=VentasController&action=ventasPorRango">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="Ingresa un nombre válido (solo letras y espacios)">
        </div>
        <button type="submit" class="btn btn-outline-success">Guardar</button>
    </form>
</div>
