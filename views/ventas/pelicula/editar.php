<div class="container mt-4">
    <h2>Editar Venta de Boleto</h2>
    <form method="post" action="./index.php?controller=VentasController&action=editarVentaPelicula">
    <input type="hidden" name="id_ticket_pelicula" value="<?php echo $id_ticket_pelicula; ?>">

        <div class="form-group">
            <label for="id_pelicula">Película:</label>
            <select name="id_pelicula" class="form-control" required>
                <?php foreach ($peliculas as $pelicula): ?>
                    <option value="<?php echo $pelicula['id_pelicula']; ?>" <?php echo ($venta['id_pelicula'] == $pelicula['id_pelicula']) ? 'selected' : ''; ?>>
                        <?php echo $pelicula['nombre'] . ' - ' . $pelicula['fecha_inicio_cartelera'] . ' a ' . $pelicula['fecha_fin_cartelera']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_cliente">Cliente:</label>
            <select name="id_cliente" class="form-control" required>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo ($venta['id_cliente'] == $cliente['id_cliente']) ? 'selected' : ''; ?>><?php echo $cliente['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_empleado">Empleado:</label>
            <select name="id_empleado" class="form-control" required>
                <?php foreach ($empleados as $empleado): ?>
                    <option value="<?php echo $empleado['id_empleado']; ?>" <?php echo ($venta['id_empleado'] == $empleado['id_empleado']) ? 'selected' : ''; ?>><?php echo $empleado['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" class="form-control border-0 border-bottom border-primary mb-3" value="<?php echo $venta['fecha']; ?>" required min="2024-01-01" max="2025-12-31">
        </div>

        <button type="submit" class="btn btn-outline-primary">Guardar Cambios</button>
    </form>
</div>
