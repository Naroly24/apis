// Función para mostrar mensajes de error
function showError(element, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-danger mt-3';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
    element.appendChild(errorDiv);
    
    // Auto eliminar después de 5 segundos
    setTimeout(() => {
        errorDiv.remove();
    }, 5000);
}

// Función para mostrar mensajes de éxito
function showSuccess(element, message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'alert alert-success mt-3';
    successDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    element.appendChild(successDiv);
    
    // Auto eliminar después de 5 segundos
    setTimeout(() => {
        successDiv.remove();
    }, 5000);
}

// Función para mostrar loader
function showLoader(element) {
    const loaderDiv = document.createElement('div');
    loaderDiv.className = 'text-center my-4';
    loaderDiv.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
        <p class="mt-2">Cargando datos...</p>
    `;
    element.innerHTML = '';
    element.appendChild(loaderDiv);
}

// Inicializar tooltips de Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});