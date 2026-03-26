<?php 
// 1. Activar errores para saber exactamente qué falla
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Incluir conexión
include 'php/conexion.php'; 

// 3. Consultar productos
$query = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $query);

// 4. Verificar si la consulta falló
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Impuestos - Pro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>TaxCalc 2026: Calculadora de Impuestos</h1>
    </header>

    <div class="contenedor-principal">
        <section class="card">
            <h2>Calcular Impuesto de Producto</h2>
            <form action="php/calcular.php" method="POST" id="form-impuestos">
                
                <label for="id_producto">Seleccionar Producto:</label>
                <select name="id_producto" id="id_producto" required>
                    <option value="" disabled selected>Escoge un producto...</option>
                    
                    <?php 
                    // 5. Verificar si hay filas antes de empezar el while
                    if (mysqli_num_rows($resultado) > 0): 
                        while($prod = mysqli_fetch_assoc($resultado)): 
                    ?>
                        <option value="<?= $prod['id']; ?>" 
                                data-precio="<?= $prod['precio_base']; ?>"
                                data-categoria="<?= $prod['categoria']; ?>">
                            <?= htmlspecialchars($prod['nombre']); ?> - $<?= number_format($prod['precio_base'], 2); ?>
                        </option>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <option value="" disabled>⚠️ No hay productos en la base de datos</option>
                    <?php endif; ?>

                </select>

                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

                <div class="desglose-vivo">
                    <p>Precio Unitario: <span id="view-precio">$0.00</span></p>
                    <p>Categoría: <span id="view-categoria">---</span></p>
                    <hr>
                    <div class="totales-previos">
                        <p>IVA (19%): <span id="view-iva">$0.00</span></p>
                        <p>Imp. Lujo (8%): <span id="view-lujo">$0.00</span></p>
                        <p>Descuento: <span id="view-descuento">$0.00</span></p>
                        <h3>Subtotal: <span id="view-subtotal">$0.00</span></h3>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Procesar y Guardar</button>
            </form>
        </section>

        <section class="card">
            <h2>Acciones de Reporte</h2>
            <div class="grid-botones">
                <a href="php/reporte.php" class="btn-secondary">📄 Generar Reporte de Hoy</a>
                <button type="button" onclick="window.print()" class="btn-export">📥 Exportar Vista a PDF</button>
            </div>
        </section>
    </div>

    <script src="js/calculos.js"></script>
</body>
</html>