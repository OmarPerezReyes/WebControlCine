<div class="container mt-4">
    <h2>Editar Venta de Producto</h2>
    <form method="post" action="./index.php?controller=VentasController&action=editarVentaProducto">
    <input type="hidden" name="id" value="<?php echo $id_ticket_producto; ?>">

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

        <div class="form-group">
            <label>Productos:</label><br>
            <?php foreach ($productos as $producto): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="productos[]" id="producto_<?php echo $producto['id_producto']; ?>" value="<?php echo $producto['id_producto']; ?>" <?php echo (in_array($producto['id_producto'], $productosAsociados)) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="producto_<?php echo $producto['id_producto']; ?>">
                        <?php echo $producto['nombre']; ?> - $<?php echo $producto['precio']; ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="btn btn-outline-primary">Guardar Cambios</button>
    </form>
</div>
