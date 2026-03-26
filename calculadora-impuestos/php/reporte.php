 <?php
include 'conexion.php';

$query = "SELECT * FROM historial_impuestos ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Impuestos</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="contenedor-principal" style="margin-top: 30px;">
        <a href="../index.php" class="btn-secondary" style="width: 150px; margin-bottom: 20px;">⬅ Volver</a>
        
        <div class="card">
            <h2>Reporte Histórico de Cálculos</h2>
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: #f1f5f9; text-align: left;">
                        <th style="padding: 10px;">Fecha</th>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>IVA</th>
                        <th>Lujo</th>
                        <th>Desc.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; font-size: 0.8rem;"><?php echo $row['fecha']; ?></td>
                        <td><?php echo $row['producto_nombre']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td>$<?php echo number_format($row['iva_total'], 2); ?></td>
                        <td>$<?php echo number_format($row['lujo_total'], 2); ?></td>
                        <td>-$<?php echo number_format($row['descuento_aplicado'], 2); ?></td>
                        <td><strong>$<?php echo number_format($row['total_final'], 2); ?></strong></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <br>
            <button onclick="window.print()" class="btn-export">📥 Descargar PDF (Imprimir)</button>
        </div>
    </div>
</body>
</html>
