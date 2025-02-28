<?php
$title = "Portal de APIs";
include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <img src="img/2X2.jpeg" alt="Naroly Tolentino" class="img-fluid rounded-circle mb-3" style="max-width: 200px; height: 200px; object-fit: cover;">
            <h1 class="display-4">Naroly Tolentino</h1>
            <p class="lead">Bienvenido a mi portal de APIs</p>
            <p class="lead">Este portal utiliza 10 APIs diferentes para mostrar información variada de forma dinámica y visualmente atractiva.</p>
        </div>
    </div>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de APIs</title>
    <link rel="stylesheet" href="style.css">  
</head>

    
    <div class="row mt-5">
        <h2 class="text-center mb-4">APIs Disponibles</h2>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Predicción de Género</h3>
                    <p class="card-text">Descubre si un nombre es masculino o femenino</p>
                    <a href="apis/gender.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Predicción de Edad</h3>
                    <p class="card-text">Estima la edad de una persona según su nombre</p>
                    <a href="apis/age.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Universidades por País</h3>
                    <p class="card-text">Encuentra universidades de cualquier país</p>
                    <a href="apis/universities.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <!-- Segunda fila -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Clima</h3>
                    <p class="card-text">Consulta el clima en República Dominicana</p>
                    <a href="apis/weather.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Pokémon</h3>
                    <p class="card-text">Información detallada de tus Pokémon favoritos</p>
                    <a href="apis/pokemon.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Noticias WordPress</h3>
                    <p class="card-text">Últimas noticias de sitios WordPress</p>
                    <a href="apis/wordpress.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <!-- Tercera fila -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Conversor de Monedas</h3>
                    <p class="card-text">Convierte USD a diferentes monedas</p>
                    <a href="apis/currency.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Generador de Imágenes</h3>
                    <p class="card-text">Encuentra imágenes basadas en palabras clave</p>
                    <a href="apis/images.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Datos de Países</h3>
                    <p class="card-text">Información de cualquier país del mundo</p>
                    <a href="apis/country.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
        
        <!-- Cuarta fila (solo un elemento) -->
        <div class="col-md-4 mb-4 mx-auto">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="card-title">Generador de Chistes</h3>
                    <p class="card-text">Chistes aleatorios para alegrarte el día</p>
                    <a href="apis/jokes.php" class="btn btn-primary">Explorar</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>
