<?php
$title = "Conversión de Monedas - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="fas fa-money-bill-wave"></i> Conversión de Monedas</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Convierte USD a diferentes monedas del mundo.</p>
                    
                    <form id="currencyForm" class="mb-4">
                        <div class="mb-3">
                            <label for="amountInput" class="form-label">Cantidad en USD:</label>
                            <input type="number" class="form-control" id="amountInput" min="0" step="0.01" required placeholder="Ingresa la cantidad en dólares">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-exchange-alt"></i> Convertir
                        </button>
                    </form>
                    
                    <div id="result" class="mt-4"></div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-info-circle"></i> Acerca de esta API</h3>
                </div>
                <div class="card-body">
                    <p>Esta API utiliza ExchangeRate-API para conversión de monedas en tiempo real.</p>
                    <p>URL de la API: <a href="https://api.exchangerate-api.com" target="_blank">https://api.exchangerate-api.com</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('currencyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const amount = document.getElementById('amountInput').value.trim();
    const resultDiv = document.getElementById('result');
    
    if (amount === '' || isNaN(amount) || amount <= 0) {
        resultDiv.innerHTML = '<div class="alert alert-danger">Por favor ingresa una cantidad válida.</div>';
        return;
    }
    
    // Mostrar loader
    resultDiv.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div></div>';
    
    // Hacer la petición a la API
    fetch('https://api.exchangerate-api.com/v4/latest/USD')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }
            return response.json();
        })
        .then(data => {
            const rates = data.rates;
            const dop = rates.DOP;
            const eur = rates.EUR;
            const gbp = rates.GBP;
            const cad = rates.CAD;
            const jpy = rates.JPY;
            
            resultDiv.innerHTML = `
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-check-circle"></i> Resultados de la conversión</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">$${parseFloat(amount).toFixed(2)} USD equivale a:</h5>
                        <ul class="list-group mt-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-dollar-sign"></i> Pesos Dominicanos (DOP)</span>
                                <span class="badge bg-primary rounded-pill">RD$ ${(amount * dop).toFixed(2)}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-euro-sign"></i> Euros (EUR)</span>
                                <span class="badge bg-primary rounded-pill">€ ${(amount * eur).toFixed(2)}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-pound-sign"></i> Libras Esterlinas (GBP)</span>
                                <span class="badge bg-primary rounded-pill">£ ${(amount * gbp).toFixed(2)}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-dollar-sign"></i> Dólares Canadienses (CAD)</span>
                                <span class="badge bg-primary rounded-pill">C$ ${(amount * cad).toFixed(2)}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-yen-sign"></i> Yenes Japoneses (JPY)</span>
                                <span class="badge bg-primary rounded-pill">¥ ${(amount * jpy).toFixed(2)}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-muted">
                        <small>Tipo de cambio actualizado el: ${new Date(data.time_last_updated * 1000).toLocaleDateString()}</small>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            resultDiv.innerHTML = '<div class="alert alert-danger">Ocurrió un error al consultar la API. Por favor intenta nuevamente.</div>';
        });
});
</script>

<?php include '../includes/footer.php'; ?>