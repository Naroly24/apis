<?php
$title = "Acerca de - Portal de APIs";
include 'includes/header.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css"> <!-- Aquí llamas el archivo CSS -->
</head>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4 mb-4">Acerca de este proyecto</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h2>Framework CSS utilizado: Bootstrap 5</h2>
                    <p>Para este proyecto he utilizado <strong>Bootstrap 5</strong> como framework CSS por las siguientes razones:</p>
                    <ul>
                        <li>Proporciona un sistema de rejilla (grid) flexible y responsivo</li>
                        <li>Incluye componentes prediseñados como tarjetas, navegación, formularios, etc.</li>
                        <li>Tiene una excelente documentación y una comunidad activa</li>
                        <li>Facilita el desarrollo responsivo para diferentes dispositivos</li>
                        <li>Es compatible con la mayoría de navegadores modernos</li>
                    </ul>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h2>Objetivo del proyecto</h2>
                    <p>Este portal web ha sido desarrollado como parte de un proyecto para demostrar la integración de múltiples APIs en una aplicación PHP. El objetivo es mostrar cómo se pueden consumir diferentes servicios web y presentar la información de manera atractiva y funcional.</p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h2>Características técnicas</h2>
                    <ul>
                        <li>Desarrollado en PHP con Bootstrap 5</li>
                        <li>Implementación de 10 APIs diferentes</li>
                        <li>Manejo de errores para una experiencia de usuario fluida</li>
                        <li>Diseño responsivo adaptado a móviles, tablets y escritorio</li>
                        <li>Uso de AJAX para cargar contenido dinámicamente sin recargar la página</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
