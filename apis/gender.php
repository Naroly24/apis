<?php
$title = "Predicción de Género - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="fas fa-venus-mars"></i> Predicción de Género por Nombre</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Esta herramienta predice el género de una persona basado en su nombre.</p>
                    
                    <form id="genderForm" class="mb-4">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Ingresa un nombre:</label>
                            <input type="text" class="form-control" id="nameInput" placeholder="Ej: Juan, María, Alex..." required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Predecir género
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
                    <p>La API de Genderize.io predice el género de una persona basado en su nombre utilizando un análisis estadístico de datos históricos.</p>
                    <p>URL de la API: <a href="https://api.genderize.io/" target="_blank">https://api.genderize.io/</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('genderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const name = document.getElementById('nameInput').value.trim();
    const resultDiv = document.getElementById('result');
    
    if (name === '') {
        showError(resultDiv, 'Por favor ingresa un nombre válido.');
        return;
    }
    
    // Mostrar loader
    showLoader(resultDiv);
    
    // Hacer la petición a la API
    fetch(`https://api.genderize.io/?name=${encodeURIComponent(name)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }
            return response.json();
        })
        .then(data => {
            resultDiv.innerHTML = '';
            
            if (data.gender === null) {
                resultDiv.innerHTML = `
                    <div class="alert alert-warning">
                        <i class="fas fa-question-circle"></i> No se pudo determinar el género para "${name}".
                    </div>
                `;
            } else {
                const gender = data.gender;
                const probability = Math.round(data.probability * 100);
                const bgColor = gender === 'male' ? 'bg-primary' : 'bg-danger';
                const icon = gender === 'male' ? 'fa-mars' : 'fa-venus';
                const genderText = gender === 'male' ? 'masculino' : 'femenino';
                
                resultDiv.innerHTML = `
                    <div class="card ${bgColor} text-white">
                        <div class="card-body text-center">
                            <h3><i class="fas ${icon} fa-2x mb-3"></i></h3>
                            <h4>El nombre "${name}" es probablemente ${genderText}</h4>
                            <p>Probabilidad: ${probability}%</p>
                        </div>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError(resultDiv, 'Ocurrió un error al consultar la API. Por favor intenta nuevamente.');
        });
});
</script>

<?php include '../includes/footer.php'; ?>