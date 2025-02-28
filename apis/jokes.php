<?php
// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = "Generador de Chistes - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h2 class="mb-0"><i class="fas fa-laugh-beam"></i> Generador de Chistes</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Chistes aleatorios para alegrarte el día.</p>
                    
                    <div id="jokeContainer" class="mt-3 text-center">
                        <div class="spinner-border text-warning" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button id="newJokeBtn" class="btn btn-warning">
                            <i class="fas fa-random"></i> Otro chiste
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0"><i class="fas fa-info-circle"></i> Acerca de esta API</h3>
                </div>
                <div class="card-body">
                    <p>Esta API utiliza Official Joke API para generar chistes aleatorios en inglés.</p>
                    <p>URL de la API: <a href="https://official-joke-api.appspot.com/random_joke" target="_blank">https://official-joke-api.appspot.com/random_joke</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Función para obtener un nuevo chiste
    function getNewJoke() {
        $('#jokeContainer').html('<div class="spinner-border text-warning" role="status"><span class="visually-hidden">Cargando...</span></div>');
        
        $.ajax({
            url: 'https://official-joke-api.appspot.com/random_joke',
            method: 'GET',
            success: function(data) {
                const joke = data.setup + ' ' + data.punchline;
                $('#jokeContainer').html('<p class="lead">' + joke + '</p>');
            },
            error: function() {
                $('#jokeContainer').html('<p class="text-danger">Lo sentimos, no se pudo obtener un chiste en este momento.</p>');
            }
        });
    }

    // Cargar un chiste al cargar la página
    $(document).ready(function() {
        getNewJoke();
        
        // Al hacer clic en el botón, obtener un nuevo chiste
        $('#newJokeBtn').click(function() {
            getNewJoke();
        });
    });
</script>

<?php include '../includes/footer.php'; ?>
