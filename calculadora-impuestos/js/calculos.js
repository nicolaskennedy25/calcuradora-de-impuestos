/**
 * Lógica de impuestos en tiempo real - TaxCalc 2026
 */

document.addEventListener('DOMContentLoaded', () => {
    // Referencias al DOM
    const selectProducto = document.getElementById('id_producto');
    const inputCantidad = document.getElementById('cantidad');
    
    // Spans de visualización
    const viewPrecio = document.getElementById('view-precio');
    const viewCategoria = document.getElementById('view-categoria');
    const viewIva = document.getElementById('view-iva');
    const viewLujo = document.getElementById('view-lujo');
    const viewDescuento = document.getElementById('view-descuento');
    const viewSubtotal = document.getElementById('view-subtotal');

    // Formateador de moneda
    const money = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

    const actualizarCalculos = () => {
        // 1. Obtener datos del producto seleccionado
        const opcion = selectProducto.options[selectProducto.selectedIndex];
        if (!opcion.value) return;

        const precioUnitario = parseFloat(opcion.dataset.precio);
        const categoria = opcion.dataset.categoria; // 'Normal' o 'Lujo'
        const cantidad = parseInt(inputCantidad.value) || 0;

        // 2. Cálculos base
        let bruto = precioUnitario * cantidad;
        
        // 3. Aplicar Descuento por Cantidad (Regla: > 10 unidades = 10% desc)
        let porcentajeDesc = 0;
        if (cantidad > 10) {
            porcentajeDesc = 0.10;
        }
        const montoDescuento = bruto * porcentajeDesc;
        const baseImponible = bruto - montoDescuento;

        // 4. Calcular Impuestos
        const montoIva = baseImponible * 0.19;
        let montoLujo = 0;
        if (categoria === 'Lujo') {
            montoLujo = baseImponible * 0.08;
        }

        const totalFinal = baseImponible + montoIva + montoLujo;

        // 5. Actualizar la interfaz (UI)
        viewPrecio.textContent = money.format(precioUnitario);
        viewCategoria.textContent = categoria;
        viewIva.textContent = money.format(montoIva);
        viewLujo.textContent = money.format(montoLujo);
        viewDescuento.textContent = money.format(montoDescuento) + ` (${porcentajeDesc * 100}%)`;
        viewSubtotal.textContent = money.format(totalFinal);

        // Feedback visual de actualización
        viewSubtotal.style.color = "#2563eb";
        setTimeout(() => viewSubtotal.style.color = "inherit", 200);
    };

    // Eventos
    selectProducto.addEventListener('change', actualizarCalculos);
    inputCantidad.addEventListener('input', actualizarCalculos);
});
