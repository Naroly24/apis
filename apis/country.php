<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = "Datos de Países - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0"><i class="fas fa-globe-americas"></i> Datos de Países</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Consulta información detallada sobre cualquier país del mundo.</p>
                    
                    <form id="countryForm" class="mb-4">
                        <div class="mb-3">
                            <label for="countryInput" class="form-label">Nombre del país (en inglés o español):</label>
                            <input type="text" class="form-control" id="countryInput" required placeholder="Ejemplo: República Dominicana, Spain, Mexico, etc.">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search"></i> Buscar país
                        </button>
                    </form>
                    
                    <div id="result" class="mt-4"></div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0"><i class="fas fa-info-circle"></i> Acerca de esta API</h3>
                </div>
                <div class="card-body">
                    <p>Esta API utiliza RestCountries para proporcionar información detallada sobre países.</p>
                    <p>URL de la API: <a href="https://restcountries.com" target="_blank">https://restcountries.com</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Diccionario de traducción (español -> inglés)
const countryTranslations = {
    "república dominicana": "Dominican Republic",
    "españa": "Spain",
    "méxico": "Mexico",
    "estados unidos": "United States",
    "alemania": "Germany",
    "francia": "France",
    "canadá": "Canada",
    "italia": "Italy",
    "japón": "Japan",
    "corea del sur": "South Korea",
    "china": "China",
    "brasil": "Brazil",
    "argentina": "Argentina",
    "colombia": "Colombia",
    "perú": "Peru",
    "chile": "Chile",
    "rusia": "Russia",
    "portugal": "Portugal",
    "haití": "Haiti"
};

// Función para traducir el nombre del país (si es necesario)
function translateCountryName(name) {
    const lowerName = name.toLowerCase().trim();
    return countryTranslations[lowerName] || name; // Si no está, devuelve el nombre original
}

document.getElementById('countryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let country = document.getElementById('countryInput').value.trim();
    const resultDiv = document.getElementById('result');
    
    if (country === '') {
        resultDiv.innerHTML = '<div class="alert alert-danger">Por favor ingresa el nombre de un país.</div>';
        return;
    }
    
    // Traducir al inglés si es necesario
    country = translateCountryName(country);

    // Mostrar loader
    resultDiv.innerHTML = '<div class="text-center"><div class="spinner-border text-success" role="status"><span class="visually-hidden">Cargando...</span></div></div>';
    
    // Llamar a la API RestCountries
    fetch(`https://restcountries.com/v3.1/name/${encodeURIComponent(country)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }
            return response.json();
        })
        .then(data => {
            if (!data || data.length === 0) {
                resultDiv.innerHTML = '<div class="alert alert-info">No se encontró información para el país ingresado.</div>';
                return;
            }

            const countryData = data[0];

            let currencies = 'No disponible';
            if (countryData.currencies) {
                currencies = Object.entries(countryData.currencies).map(([code, currency]) => {
                    return `${currency.name} (${currency.symbol || code})`;
                }).join(', ');
            }

            let languages = 'No disponible';
            if (countryData.languages) {
                languages = Object.values(countryData.languages).join(', ');
            }

            const capital = countryData.capital?.[0] || 'No disponible';
            const population = countryData.population?.toLocaleString('es-ES') || 'No disponible';

            resultDiv.innerHTML = `
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 text-center d-flex align-items-center justify-content-center p-3">
                            <img src="${countryData.flags.png}" alt="Bandera de ${countryData.name.common}" class="img-fluid" style="max-height: 180px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">${countryData.name.common} (${countryData.cca3})</h3>
                                <p class="card-text"><strong>Nombre oficial:</strong> ${countryData.name.official}</p>
                                <p class="card-text"><i class="fas fa-map-marker-alt"></i> <strong>Capital:</strong> ${capital}</p>
                                <p class="card-text"><i class="fas fa-users"></i> <strong>Población:</strong> ${population} habitantes</p>
                                <p class="card-text"><i class="fas fa-globe"></i> <strong>Región:</strong> ${countryData.region} (${countryData.subregion || 'Sin subregión'})</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0"><i class="fas fa-money-bill-wave"></i> Moneda</h4>
                            </div>
                            <div class="card-body">
                                <p>${currencies}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">
                                <h4 class="mb-0"><i class="fas fa-language"></i> Idiomas</h4>
                            </div>
                            <div class="card-body">
                                <p>${languages}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <small class="text-muted">Para más información: <a href="https://en.wikipedia.org/wiki/${countryData.name.common}" target="_blank">Wikipedia</a></small>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            resultDiv.innerHTML = '<div class="alert alert-danger">No se encontró el país o ocurrió un error. Verifica el nombre e intenta nuevamente.</div>';
        });
});
</script>

<?php include '../includes/footer.php'; ?>
