<div class="container mt-4">
    <h2 class="mb-4 text-center"><?php echo $texto ?></h2>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <h3 class="text-center">Snacks</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Vendida</th>
                        <th>Total Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Array para almacenar los productos y sus totales de ventas
                    $productos_totales = array();

                    foreach ($ventas_productos as $venta):
                        foreach ($venta['productos_detalles'] as $producto):
                            // Verificar si el producto ya ha sido agregado a la lista de productos totales
                            $nombre_producto = $producto['nombre'];
                            if (array_key_exists($nombre_producto, $productos_totales)) {
                                // Incrementar la cantidad vendida y calcular el total de ventas
                                $productos_totales[$nombre_producto]['cantidad_vendida']++;
                                $productos_totales[$nombre_producto]['total_ventas'] += $producto['precio'];
                            } else {
                                // Agregar el producto a la lista de productos totales
                                $productos_totales[$nombre_producto] = array(
                                    'cantidad_vendida' => 1,
                                    'total_ventas' => $producto['precio']
                                );
                            }
                        endforeach;
                    endforeach;

                    // Ordenar el array por la cantidad vendida en orden descendente
                    arsort($productos_totales);

                    // Obtener solo los 5 productos más pedidos
                    $top_5_productos = array_slice($productos_totales, 0, 5);

                    // Mostrar los productos y sus totales de ventas en la tabla
                    foreach ($top_5_productos as $nombre_producto => $producto):
                    ?>
                        <tr>
                            <td><?php echo $nombre_producto; ?></td>
                            <td><?php echo $producto['cantidad_vendida']; ?></td>
                            <td>$<?php echo number_format($producto['total_ventas'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
