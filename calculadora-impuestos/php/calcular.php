 <?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = intval($_POST['id_producto']);
    $cantidad = intval($_POST['cantidad']);

    // 1. Obtener datos reales del producto desde la DB
    $stmt = $conexion->prepare("SELECT nombre, precio_base, categoria FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $resultado = $stmt->get_result()->fetch_assoc();

    if ($resultado) {
        $nombre = $resultado['nombre'];
        $precio = $resultado['precio_base'];
        $categoria = $resultado['categoria'];

        // 2. Lógica de Negocio
        $bruto = $precio * $cantidad;
        
        // Descuento por cantidad (>10 unidades = 10% desc)
        $porcentaje_desc = ($cantidad > 10) ? 0.10 : 0.0;
        $monto_descuento = $bruto * $porcentaje_desc;
        $base_imponible = $bruto - $monto_descuento;

        // Impuestos
        $iva = $base_imponible * 0.19;
        $lujo = ($categoria == 'Lujo') ? ($base_imponible * 0.08) : 0;
        
        $total_final = $base_imponible + $iva + $lujo;

        // 3. Guardar en el Historial
        $sql_insert = "INSERT INTO historial_impuestos 
                       (producto_nombre, cantidad, subtotal, iva_total, lujo_total, descuento_aplicado, total_final) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt_ins = $conexion->prepare($sql_insert);
        $stmt_ins->bind_param("siddddd", $nombre, $cantidad, $bruto, $iva, $lujo, $monto_descuento, $total_final);

        if ($stmt_ins->execute()) {
            echo "<html><head><link rel='stylesheet' href='../css/estilo.css'></head><body>";
            echo "<div class='contenedor-principal' style='margin-top: 50px;'>";
            echo "<div class='card' style='text-align:center;'>";
            echo "<h2>✅ Cálculo Procesado</h2>";
            echo "<p>El registro de <strong>$nombre</strong> se guardó con éxito.</p>";
            echo "<h3>Total: $" . number_format($total_final, 2) . "</h3>";
            echo "<br><a href='../index.php' class='btn-primary'>Realizar otro cálculo</a>";
            echo "</div></div></body></html>";
        }
    }
}
?>
