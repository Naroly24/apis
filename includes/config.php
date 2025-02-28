<?php
// Configuración general del portal
$site_name = "Portal de APIs";
$developer_name = "Tu Nombre Completo"; // Reemplazar con tu nombre
$developer_email = "tu.email@ejemplo.com";

// Claves de API (reemplazar con tus propias claves)
$openweather_api_key = "tu_clave_de_openweather";
$unsplash_api_key = "tu_clave_de_unsplash";
$exchange_api_key = "tu_clave_de_exchange";

// URLs de API
$gender_api_url = "https://api.genderize.io/";
$age_api_url = "https://api.agify.io/";
$universities_api_url = "http://universities.hipolabs.com/search";
$weather_api_url = "https://api.openweathermap.org/data/2.5/weather";
$pokemon_api_url = "https://pokeapi.co/api/v2/pokemon/";
$wordpress_api_url = "https://ejemplo-wordpress.com/wp-json/wp/v2/posts"; // Reemplazar
$exchange_api_url = "https://api.exchangerate-api.com/v4/latest/USD";
$images_api_url = "https://api.unsplash.com/search/photos";
$countries_api_url = "https://restcountries.com/v3.1/name/";
$jokes_api_url = "https://official-joke-api.appspot.com/random_joke";

// Función para manejar errores de API de forma amigable
function handleApiError($message = "Ha ocurrido un error al conectar con el servicio.") {
    echo '<div class="alert alert-danger mt-3" role="alert">';
    echo '<i class="bi bi-exclamation-triangle-fill me-2"></i> ' . $message;
    echo '</div>';
}

// Función para hacer peticiones a APIs de forma segura
function callAPI($url, $params = []) {
    $full_url = $url;
    
    // Añadir parámetros si existen
    if (!empty($params)) {
        $full_url .= '?' . http_build_query($params);
    }
    
    // Inicializar cURL
    $curl = curl_init($full_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    
    // Ejecutar la petición
    $response = curl_exec($curl);
    $error = curl_error($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    
    // Verificar si hubo errores
    if ($error || $http_code != 200) {
        return [
            'success' => false,
            'error' => $error ? $error : "Error HTTP: " . $http_code
        ];
    }
    
    // Decodificar respuesta JSON
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return [
            'success' => false,
            'error' => 'Error al decodificar respuesta JSON'
        ];
    }
    
    return [
        'success' => true,
        'data' => $data
    ];
}
?>