<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Portal de APIs'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? '../css/style.css' : 'css/style.css'; ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? '../index.php' : 'index.php'; ?>">
                <i class="fas fa-globe-americas"></i> Portal de APIs
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? '../index.php' : 'index.php'; ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? '../about.php' : 'about.php'; ?>">Acerca de</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            APIs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'gender.php' : 'apis/gender.php'; ?>">Predicción de Género</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'age.php' : 'apis/age.php'; ?>">Predicción de Edad</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'universities.php' : 'apis/universities.php'; ?>">Universidades</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'weather.php' : 'apis/weather.php'; ?>">Clima</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'pokemon.php' : 'apis/pokemon.php'; ?>">Pokémon</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'wordpress.php' : 'apis/wordpress.php'; ?>">Noticias WordPress</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'currency.php' : 'apis/currency.php'; ?>">Conversor de Monedas</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'images.php' : 'apis/image-generator.php'; ?>">Generador de Imágenes</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'country.php' : 'apis/country.php'; ?>">Datos de Países</a></li>
                            <li><a class="dropdown-item" href="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? 'jokes.php' : 'apis/jokes.php'; ?>">Generador de Chistes</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>