<div class="container mt-4">
    <h2>Editar Producto</h2>

    <form method="post" action="./index.php?controller=ProductosController&action=editar">
        <input type="hidden" name="id" value="<?php echo $producto['id_producto']; ?>">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Nombre del Producto" value="<?php echo $producto['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Precio del Producto" value="<?php echo $producto['precio']; ?>" required min="0" pattern="^[0-9]+(\.[0-9]{1,2})?$" title="Ingresa un precio válido (mayor que 0)">
        </div>
        <div class="form-group">
            <label for="cantidad_inventario">Cantidad en Inventario:</label>
            <input type="number" name="cantidad_inventario" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Cantidad en Inventario" value="<?php echo $producto['cantidad_inventario']; ?>" required step="1" pattern="[0-9]+" title="Ingresa una cantidad válida (número entero)">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" class="form-control border-0 border-bottom border-primary mb-3" placeholder="Descripción del Producto" rows="3" required><?php echo $producto['descripcion']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-outline-success">Guardar Cambios</button>
    </form>
</div>
