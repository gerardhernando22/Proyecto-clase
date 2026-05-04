<?php
$conn = new mysqli("localhost", "admin", "1234", "concesionario");
$coches = [];
$error_bd = false;

if (!$conn->connect_error) {
    $sql = "SELECT * FROM coches ORDER BY precio ASC";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $coches[] = $row;
        }
    } else {
        $error_bd = true;
    }

    $conn->close();
} else {
    $error_bd = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo2 Motor | Concesionario</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
            line-height: 1.5;
        }

        a {
            text-decoration: none;
            color: inherit;.container {
            width: min(1200px, 92%);
            margin: 0 auto;
        }

        header {
            background: linear-gradient(135deg, #0f172a, #1d4ed8);
            color: white;
            padding-bottom: 80px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 24px 0;
        }
 .logo {
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .logo span {
            color: #fbbf24;
        }

        .nav-links {
            display: flex;
            gap: 22px;
            font-weight: 600;
        }

        .hero {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 40px;
            align-items: center;
            padding: 40px 0 0;
        }

        .hero h1 {
            font-size: 3rem;
            line-height: 1.1;
            margin-bottom: 18px;
        }

        .hero p {
            font-size: 1.05rem;
            max-width: 600px;
            color: #dbeafe;
            margin-bottom: 28px;
        }
display: inline-block;
            padding: 14px 22px;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.2s ease;
        }

        .btn-primary {
            background: #f59e0b;
            color: #111827;
        }

        .btn-primary:hover {
            background: #fbbf24;
        }

        .btn-secondary {
            border: 2px solid rgba(255,255,255,0.35);
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.1);
        }

        .hero-card {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 24px;
            padding: 28px;
            backdrop-filter: blur(6px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        }

        .hero-card h3 {
            margin-bottom: 14px; border-bottom: 1px solid rgba(255,255,255,0.15);
            color: #e5eefc;
        }

        .hero-card li:last-child {
            border-bottom: none;
        }

        section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 12px;
            color: #0f172a;
        }

        .section-subtitle {
            color: #64748b;
            margin-bottom: 36px;
            max-width: 700px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .feature-card, .car-card, .contact-box {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .feature-card h3 {    gap: 24px;
        }

        .car-card {
            overflow: hidden;
            padding: 0;
        }

        .car-image {
            height: 190px;
            background: linear-gradient(135deg, #dbeafe, #93c5fd);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .car-content {
            padding: 22px;
        }

        .car-title {
            font-size: 1.35rem;
            margin-bottom: 6px;
            color: #0f172a;
        }

        .car-price {
            font-size: 1.6rem;
            font-weight: 800;
            color: #1d4ed8;
            margin: 12px 0;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 0.9rem;
            font-weight: 700;
            background: #e0f2fe;
            color: #075985;
            margin-top: 8px;
        }
            margin-bottom: 10px;
            color: #111827;
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            font-size: 1.3rem;
        }

        .hero-card ul {
            list-style: none;
        }

        .hero-card li {
            padding: 10px 0;
        .hero-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn {
        }
 .empty-state,
        .error-state {
            background: white;
            border-radius: 18px;
            padding: 26px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            color: #334155;
        }

        .contact-layout {
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 24px;
        }

        .contact-box h3 {
            margin-bottom: 14px;
        }

        .contact-box p,
        .contact-box li {
            color: #475569;
        }

        .contact-list {
            list-style: none;
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        form {
            display: grid;
            gap: 14px;
        }

        input, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 1rem;
            outline: none;
        } input:focus, textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        button {
            border: none;
            cursor: pointer;
        }

        footer {
            background: #0f172a;
            color: #cbd5e1;
            text-align: center;
            padding: 26px 0;
        }

        @media (max-width: 980px) {
            .hero,
            .contact-layout,
            .features,
            .catalog-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.4rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
  <nav>
                <div class="logo">Grupo2 <span>Motor</span></div>
                <div class="nav-links">
                    <a href="#inicio">Inicio</a>
                    <a href="#ventajas">Ventajas</a>
                    <a href="#catalogo">Catálogo</a>
                    <a href="#contacto">Contacto</a>
                </div>
            </nav>

            <div class="hero" id="inicio">
                <div>
                    <h1>Encuentra tu próximo coche al mejor precio</h1>
                    <p>
                        En Grupo2 Motor te ofrecemos vehículos revisados, financiación personalizada
                        y atención directa para que compres con seguridad y confianza.
                    </p>
                    <div class="hero-buttons">
                        <a href="#catalogo" class="btn btn-primary">Ver catálogo</a>
                        <a href="#contacto" class="btn btn-secondary">Solicitar información</a>
                    </div>
                </div>

                <div class="hero-card">
                    <h3>Por qué elegirnos</h3>
                    <ul>
                        <li>Vehículos revisados y listos para entrega</li>
                        <li>Asesoramiento cercano y profesional</li>
                        <li>Financiación adaptada a cada cliente</li>
                        <li>Reserva de vehículos bajo consulta</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <section id="ventajas">
        <div class="container">
            <h2 class="section-title">Nuestro concesionario</h2>
            <p class="section-subtitle">
                Un diseño profesional para tu proyecto de clase, con catálogo dinámico conectado a MariaDB
                y formulario de contacto listo para guardar clientes potenciales.
            </p>

            <div class="features">
 <div class="feature-card">
                    <h3>Catálogo actualizado</h3>
                    <p>Los coches se cargan directamente desde la base de datos para que puedas añadir o modificar vehí>
                </div>
                <div class="feature-card">
                    <h3>Diseño moderno</h3>
                    <p>Interfaz limpia, visual y profesional para que el proyecto entre por los ojos nada más presentar>
                </div>
                <div class="feature-card">
                    <h3>Captación de clientes</h3>
                    <p>Formulario integrado para registrar solicitudes de información y mostrar un caso real de negocio>
                </div>
            </div>
        </div>
    </section>

    <section id="catalogo">
        <div class="container">
            <h2 class="section-title">Catálogo disponible</h2>
            <p class="section-subtitle">
                Estos vehículos se muestran en tiempo real a partir de los datos almacenados en tu base de datos.
            </p>

            <?php if ($error_bd): ?>
                <div class="error-state">
                    <strong>No se ha podido cargar la base de datos.</strong><br>
                    Revisa la conexión de MariaDB, el usuario <code>admin</code> y la base de datos <code>concesionario>
                </div>
            <?php elseif (count($coches) === 0): ?>
                <div class="empty-state">
                    <strong>No hay coches registrados todavía.</strong><br>
                    Inserta vehículos en la tabla <code>coches</code> desde phpMyAdmin o MariaDB para mostrarlos aquí.
                </div>
            <?php else: ?>
                <div class="catalog-grid">
                    <?php foreach ($coches as $coche): ?>
                        <article class="car-card">
                            <div class="car-image" style="padding:0; background:#e5e7eb;">
                                <?php if (!empty($coche['imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($coche['imagen']); ?>" alt="Coche" style="width:1>
                                <?php else: ?>
                                <div style="display:flex; align-items:center; justify-content:center; height:190px; fon>
                                 <?php endif; ?>
                            </div>
                            <div class="car-content">
 <h3 class="car-title"><?php echo htmlspecialchars($coche['marca']) . ' ' . htmlspecialc>
                                <p>Vehículo revisado y disponible para entrega.</p>
                                <div class="car-price"><?php echo number_format((float)$coche['precio'], 0, ',', '.'); >
                                <span class="badge">Stock: <?php echo htmlspecialchars($coche['stock']); ?> unidades</s>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section id="contacto">
        <div class="container">
            <h2 class="section-title">Solicita información</h2>
            <p class="section-subtitle">
                Si un cliente está interesado en un vehículo, puede dejar sus datos aquí y se guardarán en tu sistema.
            </p>

            <div class="contact-layout">
                <div class="contact-box">
                    <h3>Datos del concesionario</h3>
                    <p>Atendemos consultas sobre disponibilidad, financiación y pruebas de vehículo.</p>
                    <ul class="contact-list">
                        <li><strong>Dirección:</strong> Avenida Central, 25</li>
                        <li><strong>Teléfono:</strong> 600 123 456</li>
                        <li><strong>Email:</strong> ventas@corp.grupo2.com</li>
                        <li><strong>Horario:</strong> Lunes a Viernes, 9:00 - 19:00</li>
                    </ul>
                </div>

                <div class="contact-box">
                    <h3>Formulario de contacto</h3>
                    <form action="guardar.php" method="POST">
                        <input type="text" name="nombre" placeholder="Tu nombre" required>
                        <input type="email" name="email" placeholder="Tu correo electrónico" required>
                        <textarea name="mensaje" placeholder="Indica qué coche te interesa o qué información necesitas">
                        <button type="submit" class="btn btn-primary">Enviar solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
  <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Grupo2 Motor | Proyecto final de servidor Linux y concesionario web</p>
        </div>
    </footer>
</body>
</html>
