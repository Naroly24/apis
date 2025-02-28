<?php
$title = "Predicción de Edad - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0"><i class="fas fa-birthday-cake"></i> Predicción de Edad por Nombre</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Esta herramienta estima la edad de una persona basado en su nombre.</p>
                    
                    <form id="ageForm" class="mb-4">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Ingresa un nombre:</label>
                            <input type="text" class="form-control" id="nameInput" placeholder="Ej: Juan, María, Alex..." required>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search"></i> Predecir edad
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
                    <p>La API de Agify.io estima la edad de una persona basado en su nombre utilizando un análisis estadístico de datos históricos.</p>
                    <p>URL de la API: <a href="https://api.agify.io/" target="_blank">https://api.agify.io/</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('ageForm').addEventListener('submit', function(e) {
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
    fetch(`https://api.agify.io/?name=${encodeURIComponent(name)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }
            return response.json();
        })
        .then(data => {
            resultDiv.innerHTML = '';
            
            if (data.age === null) {
                resultDiv.innerHTML = `
                    <div class="alert alert-warning">
                        <i class="fas fa-question-circle"></i> No se pudo determinar la edad para "${name}".
                    </div>
                `;
            } else {
                const age = data.age;
                let category, icon, description;
                
                if (age < 18) {
                    category = 'Joven';
                    icon = 'fa-child';
                    description = 'Esta persona probablemente es joven.';
                } else if (age < 60) {
                    category = 'Adulto';
                    icon = 'fa-user';
                    description = 'Esta persona probablemente es adulta.';
                } else {
                    category = 'Adulto mayor';
                    icon = 'fa-user-friends';
                    description = 'Esta persona probablemente es un adulto mayor.';
                }
                
                resultDiv.innerHTML = `
                    <div class="card">
                        <div class="card-body text-center">
                            <h3><i class="fas ${icon} fa-3x mb-3 text-success"></i></h3>
                            <h4>La edad estimada para "${name}" es de ${age} años</h4>
                            <p>Categoría: <strong>${category}</strong></p>
                            <p>${description}</p>
                            <img src="../img/${category.toLowerCase().replace(' ', '-')}.jpg" alt="${category}" class="img-fluid rounded mt-3" style="max-height: 200px;">
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