<div class="container mt-4">
    <h2 class="mb-4">Ventas Diarias</h2>

    <div class="row">
        <div class="col-md-6">
            <h3>Snacks</h3>
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

                    // Mostrar los productos y sus totales de ventas en la tabla
                    foreach ($productos_totales as $nombre_producto => $producto):
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

        <div class="col-md-6">
    <h3>Boletos</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Película</th>
                <th>Cantidad Adultos</th>
                <th>Cantidad Niños o Adultos Mayores</th>
                <th>Total Ventas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Array para almacenar las ventas agrupadas por película
            $ventas_agrupadas = array();

            // Agrupar las ventas por película
            foreach ($ventas_boletos as $venta) {
                $nombre_pelicula = $venta['nombre_pelicula'];
                if (!array_key_exists($nombre_pelicula, $ventas_agrupadas)) {
                    $ventas_agrupadas[$nombre_pelicula] = array(
                        'cantidad_adultos' => 0,
                        'cantidad_ninos_o_adultos_mayores' => 0,
                        'total_ventas' => 0
                    );
                }

                // Contar boletos según la categoría
                if ($venta['categoria_boleto'] == 'Adulto') {
                    $ventas_agrupadas[$nombre_pelicula]['cantidad_adultos']++;
                } elseif ($venta['categoria_boleto'] == 'Menor o Adulto Mayor') {
                    $ventas_agrupadas[$nombre_pelicula]['cantidad_ninos_o_adultos_mayores']++;
                }

                // Sumar el total de ventas
                $ventas_agrupadas[$nombre_pelicula]['total_ventas'] += $venta['total'];
            }

            // Mostrar los resultados
            foreach ($ventas_agrupadas as $nombre_pelicula => $datos_pelicula) {
                echo '<tr>';
                echo '<td>' . $nombre_pelicula . '</td>';
                echo '<td>' . $datos_pelicula['cantidad_adultos'] . '</td>';
                echo '<td>' . $datos_pelicula['cantidad_ninos_o_adultos_mayores'] . '</td>';
                echo '<td>$' . number_format($datos_pelicula['total_ventas'], 2) . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

    </div>
</div>
