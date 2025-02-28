<?php
$title = "Noticias desde WordPress - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h2 class="mb-0"><i class="fab fa-wordpress"></i> Noticias desde WordPress</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Consulta las últimas noticias de sitios WordPress populares.</p>
                    
                    <form id="wordpressForm" class="mb-4">
                        <div class="mb-3">
                            <label for="siteSelect" class="form-label">Selecciona un sitio de noticias:</label>
                            <select class="form-select" id="siteSelect" required>
                                <option value="">Selecciona un sitio</option>
                                <option value="https://techcrunch.com">TechCrunch</option>
                                <option value="https://www.wired.com">Wired</option>
                                <option value="https://time.com">Time</option>
                                <option value="https://www.theverge.com">The Verge</option>
                                <option value="https://www.bbc.com">BBC</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-newspaper"></i> Obtener noticias
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
                    <p>Esta funcionalidad utiliza la API REST de WordPress para obtener las últimas publicaciones de diferentes sitios de noticias.</p>
                    <p>Documentación de la API: <a href="https://developer.wordpress.org/rest-api/" target="_blank">https://developer.wordpress.org/rest-api/</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('wordpressForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const site = document.getElementById('siteSelect').value.trim();
    const resultDiv = document.getElementById('result');
    
    if (site === '') {
        showError(resultDiv, 'Por favor selecciona un sitio de noticias.');
        return;
    }
    
    // Mostrar loader
    showLoader(resultDiv);
    
    // Hacer la petición a la API de WordPress
    fetch(`${site}/wp-json/wp/v2/posts?_embed&per_page=3`)
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
                        <i class="fas fa-exclamation-triangle"></i> No se encontraron noticias recientes en este sitio.
                    </div>
                `;
                return;
            }
            
            // Obtener el nombre del sitio
            const siteName = new URL(site).hostname.replace('www.', '');
            
            // Crear el contenedor para las noticias
            resultDiv.innerHTML = `
                <div class="mb-4 text-center">
                    <h3>Últimas noticias de ${siteName}</h3>
                    <img src="../img/wordpress-logo.png" alt="WordPress Logo" class="img-fluid my-3" style="max-width: 200px;">
                </div>
                <div class="row" id="newsContainer"></div>
            `;
            
            const newsContainer = document.getElementById('newsContainer');
            
            // Mostrar cada noticia
            data.forEach(post => {
                // Formatear la fecha
                const date = new Date(post.date);
                const formattedDate = date.toLocaleDateString('es-ES', { 
                    day: '2-digit', 
                    month: 'long', 
                    year: 'numeric'
                });
                
                // Obtener la imagen destacada (si existe)
                let featuredImage = '../img/news-placeholder.jpg';
                if (post._embedded && post._embedded['wp:featuredmedia'] && post._embedded['wp:featuredmedia'][0].source_url) {
                    featuredImage = post._embedded['wp:featuredmedia'][0].source_url;
                }
                
                // Crear la tarjeta de noticia
                const newsCard = document.createElement('div');
                newsCard.className = 'col-md-4 mb-4';
                newsCard.innerHTML = `
                    <div class="card h-100">
                        <img src="${featuredImage}" class="card-img-top" alt="${post.title.rendered}" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">${post.title.rendered}</h5>
                            <p class="card-text small text-muted">${formattedDate}</p>
                            <div class="card-text mb-3">${post.excerpt.rendered}</div>
                            <a href="${post.link}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt"></i> Leer más
                            </a>
                        </div>
                    </div>
                `;
                
                newsContainer.appendChild(newsCard);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            showError(resultDiv, 'Ocurrió un error al consultar la API. Es posible que el sitio seleccionado no tenga la API REST de WordPress habilitada o no permita acceso CORS. Por favor intenta con otro sitio.');
        });
});
</script>

<?php include '../includes/footer.php'; ?>