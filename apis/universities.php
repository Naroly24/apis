<?php
$title = "Universidades por País - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h2 class="mb-0"><i class="fas fa-university"></i> Universidades por País</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Encuentra universidades de cualquier país del mundo.</p>
                    
                    <form id="universitiesForm" class="mb-4">
                        <div class="mb-3">
                            <label for="countryInput" class="form-label">Ingresa el nombre del país (en inglés):</label>
                            <input type="text" class="form-control" id="countryInput" placeholder="Ej: Dominican Republic, Spain, Mexico..." required>
                        </div>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-search"></i> Buscar universidades
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
                    <p>Esta API proporciona información sobre universidades en diferentes países del mundo.</p>
                    <p>URL de la API: <a href="http://universities.hipolabs.com/" target="_blank">http://universities.hipolabs.com/</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('universitiesForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const country = document.getElementById('countryInput').value.trim();
    const resultDiv = document.getElementById('result');
    
    if (country === '') {
        showError(resultDiv, 'Por favor ingresa el nombre de un país.');
        return;
    }
    
    // Mostrar loader
    showLoader(resultDiv);
    
    // Hacer la petición a la API
    fetch(`http://universities.hipolabs.com/search?country=${encodeURIComponent(country)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }
            return response.json();
        })
        .then(data => {
            resultDiv.innerHTML = '';
            
            if (data.length === 0) {
                resultDiv.innerHTML = `
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> No se encontraron universidades para "${country}". Verifica el nombre del país e inténtalo nuevamente (recuerda escribirlo en inglés).
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <h3 class="mb-3">Universidades en ${country} (${data.length} encontradas)</h3>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dominio</th>
                                    <th>Página web</th>
                                </tr>
                            </thead>
                            <tbody id="universitiesList">
                            </tbody>
                        </table>
                    </div>
                `;
                
                const tbody = document.getElementById('universitiesList');
                
                data.forEach(university => {
                    const tr = document.createElement('tr');
                    
                    tr.innerHTML = `
                        <td>${university.name}</td>
                        <td>${university.domains[0] || 'N/A'}</td>
                        <td>
                            ${university.web_pages && university.web_pages.length > 0 
                              ? `<a href="${university.web_pages[0]}" target="_blank" class="btn btn-sm btn-outline-primary">
                                   <i class="fas fa-external-link-alt"></i> Visitar
                                 </a>`
                              : 'N/A'}
                        </td>
                    `;
                    
                    tbody.appendChild(tr);
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError(resultDiv, 'Ocurrió un error al consultar la API. Por favor intenta nuevamente.');
        });
});
</script>

<?php include '../includes/footer.php'; ?>