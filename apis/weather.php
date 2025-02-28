<?php
$title = "Clima en República Dominicana - Portal de APIs";
include '../includes/header.php';

// Aquí deberías colocar tu API key de OpenWeather
$api_key = "af0e021ec97f6de447fcb496801fe9fd";
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2 class="mb-0"><i class="fas fa-cloud-sun"></i> Clima en República Dominicana</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Consulta el clima actual en diferentes ciudades de República Dominicana.</p>
                    
                    <form id="weatherForm" class="mb-4">
                        <div class="mb-3">
                            <label for="cityInput" class="form-label">Selecciona una ciudad:</label>
                            <select class="form-select" id="cityInput" required>
                                <option value="">Selecciona una ciudad</option>
                                <option value="Santo Domingo">Santo Domingo</option>
                                <option value="Santiago">Santiago</option>
                                <option value="Puerto Plata">Puerto Plata</option>
                                <option value="Punta Cana">Punta Cana</option>
                                <option value="La Romana">La Romana</option>
                                <option value="San Pedro de Macorís">San Pedro de Macorís</option>
                                <option value="La Vega">La Vega</option>
                                <option value="San Francisco de Macorís">San Francisco de Macorís</option>
                                <option value="Barahona">Barahona</option>
                                <option value="Higüey">Higüey</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info text-white">
                            <i class="fas fa-search"></i> Consultar clima
                        </button>
                    </form>
                    
                    <div id="result" class="mt-4"></div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0"><i class="fas fa-info-circle"></i> Acerca de esta API</h3>
                </div>
                <div class="card-body">
                    <p>Esta API utiliza OpenWeather para proporcionar información meteorológica actualizada.</p>
                    <p>URL de la API: <a href="https://openweathermap.org/api" target="_blank">https://openweathermap.org/api</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('weatherForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const city = document.getElementById('cityInput').value.trim();
    const resultDiv = document.getElementById('result');
    const apiKey = '<?php echo $api_key; ?>';
    
    if (city === '') {
        showError(resultDiv, 'Por favor selecciona una ciudad.');
        return;
    }
    
    // Mostrar loader
    showLoader(resultDiv);
    
    // Hacer la petición a la API
    fetch(`https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(city)},do&units=metric&appid=${apiKey}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }
            return response.json();
        })
        .then(data => {
            resultDiv.innerHTML = '';
            
            // Determinar el icono y el fondo según el clima
            let bgClass, textClass;
            const weatherMain = data.weather[0].main.toLowerCase();
            
            if (weatherMain.includes('clear')) {
                bgClass = 'bg-warning';
                textClass = 'text-dark';
            } else if (weatherMain.includes('cloud')) {
                bgClass = 'bg-secondary';
                textClass = 'text-white';
            } else if (weatherMain.includes('rain') || weatherMain.includes('drizzle')) {
                bgClass = 'bg-primary';
                textClass = 'text-white';
            } else if (weatherMain.includes('thunderstorm')) {
                bgClass = 'bg-dark';
                textClass = 'text-white';
            } else if (weatherMain.includes('snow')) {
                bgClass = 'bg-light';
                textClass = 'text-dark';
            } else {
                bgClass = 'bg-info';
                textClass = 'text-white';
            }
            
            // Convertir timestamp a hora local
            const sunriseTime = new Date(data.sys.sunrise * 1000).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'});
            const sunsetTime = new Date(data.sys.sunset * 1000).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'});
            
            resultDiv.innerHTML = `
                <div class="card ${bgClass} ${textClass}">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center">
                                <h3>${city}</h3>
                                <img src="https://openweathermap.org/img/wn/${data.weather[0].icon}@4x.png" alt="${data.weather[0].description}">
                                <h4>${data.weather[0].description.charAt(0).toUpperCase() + data.weather[0].description.slice(1)}</h4>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush ${bgClass}">
                                    <li class="list-group-item ${bgClass} ${textClass}">
                                        <i class="fas fa-temperature-high"></i> Temperatura: ${Math.round(data.main.temp)}°C
                                    </li>
                                    <li class="list-group-item ${bgClass} ${textClass}">
                                        <i class="fas fa-tint"></i> Humedad: ${data.main.humidity}%
                                    </li>
                                    <li class="list-group-item ${bgClass} ${textClass}">
                                        <i class="fas fa-wind"></i> Viento: ${Math.round(data.wind.speed * 3.6)} km/h
                                    </li>
                                    <li class="list-group-item ${bgClass} ${textClass}">
                                        <i class="fas fa-compress-alt"></i> Presión: ${data.main.pressure} hPa
                                    </li>
                                    <li class="list-group-item ${bgClass} ${textClass}">
                                        <i class="fas fa-sun"></i> Amanecer: ${sunriseTime}
                                    </li>
                                    <li class="list-group-item ${bgClass} ${textClass}">
                                        <i class="fas fa-moon"></i> Atardecer: ${sunsetTime}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            showError(resultDiv, 'Ocurrió un error al consultar la API. Por favor intenta nuevamente.');
        });
});
</script>

<?php include '../includes/footer.php'; ?>