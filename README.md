📊 TaxCalc 2026: Calculadora de Impuestos y Descuentos
Sistema web desarrollado en PHP, JS y MySQL para el cálculo automatizado de impuestos sobre productos, gestión de categorías de lujo y generación de reportes históricos exportables a PDF.

🚀 Funcionalidades Principales
Cálculo en Tiempo Real: Interfaz dinámica que actualiza el IVA, Impuesto de Lujo y Descuentos mientras el usuario interactúa (JavaScript ES6).

Reglas de Negocio Automatizadas:

IVA General: Aplicación del 19% sobre la base imponible.

Impuesto de Lujo: Recargo adicional del 8% para productos categorizados como "Lujo".

Descuento por Volumen: 10% de descuento automático si la cantidad supera las 10 unidades.

Persistencia de Datos: Registro detallado de cada operación en la base de datos para auditoría.

Exportación a PDF: Función de reporte optimizada para impresión nativa del navegador mediante CSS @media print.

🛠️ Tecnologías Utilizadas
Backend: PHP 8.x (Uso de MySQLi con Prepared Statements).

Frontend: HTML5, CSS3 y JavaScript Vainilla.

Base de Datos: MySQL / MariaDB.

📂 Estructura del Proyecto
/calculadora-impuestos
│
├── index.php (Interfaz principal y formulario dinámico)
│
├── /css
│   └── estilo.css (Estilos modernos y reglas de impresión)
│
├── /js
│   └── calculos.js (Lógica de cálculo en el cliente)
│
├── /php
│   ├── conexion.php (Configuración de conexión a la DB)
│   ├── calcular.php (Procesamiento y guardado de impuestos)
│   └── reporte.php (Historial de cálculos y visor de reporte)
│
└── /sql
└── estructura.sql (Script de base de datos y semillas)

⚙️ Configuración e Instalación
Servidor Local: Mueve la carpeta del proyecto a tu directorio de servidor (ej. C:/xampp/htdocs/calculadora-impuestos).

Base de Datos: Accede a phpMyAdmin, crea una base de datos llamada "impuestos_db" e importa el archivo ubicado en /sql/estructura.sql.

Conexión: Revisa php/conexion.php y ajusta las credenciales de tu servidor si es necesario.

Uso: Abre tu navegador en http://localhost/calculadora-impuestos/, selecciona un producto y ajusta la cantidad para ver los cálculos en vivo.

📋 Reglas de Cálculo Aplicadas
IVA: 19% aplicado a todos los productos de forma general.

Impuesto de Lujo: 8% adicional solo si el producto está marcado como 'Lujo' en la base de datos.

Descuento por Cantidad: 10% de rebaja sobre el bruto si el usuario compra más de 10 unidades.

👤 Autor
Nicolas Castaño - Desarrollador
