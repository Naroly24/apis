<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = "Generador de Imágenes - Portal de APIs";
include '../includes/header.php';

$api_key = "3ZzD9v-tYPSJgUgNIXvDLMnyItsenp5n-ewRrvUUQuw";

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$images = [];

if ($query) {
    $url = "https://api.unsplash.com/search/photos?query=" . urlencode($query) . "&per_page=6";

    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "Authorization: Client-ID $api_key\r\n"
        ]
    ];

    $context = stream_context_create($opts);
    $response = @file_get_contents($url, false, $context);

    if ($response !== false) {
        $data = json_decode($response, true);
        $images = $data['results'] ?? [];
    } else {
        $error_message = "Error al consultar la API. Por favor, intenta de nuevo más tarde.";
    }
}
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h2 class="mb-0"><i class="fas fa-images"></i> Generador de Imágenes</h2>
                </div>
                <div class="card-body">
                    <p class="lead">Busca imágenes basadas en palabras clave.</p>
                    
                    <form method="GET" action="" class="mb-4">
                        <div class="mb-3">
                            <label for="queryInput" class="form-label">Palabra clave:</label>
                            <input type="text" class="form-control" id="queryInput" name="query" required value="<?= htmlspecialchars($query) ?>" placeholder="Ejemplo: montañas, océano, ciudad, etc.">
                        </div>
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-search"></i> Buscar imágenes
                        </button>
                    </form>

                    <?php if ($query && empty($images)): ?>
                        <div class="alert alert-info">No se encontraron imágenes para la búsqueda "<?= htmlspecialchars($query) ?>". Intenta con otra palabra clave.</div>
                    <?php elseif ($query && isset($error_message)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                    <?php elseif (!empty($images)): ?>
                        <div class="row">
                            <?php foreach ($images as $index => $image): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <img src="<?= $image['urls']['small'] ?>" class="card-img-top" alt="<?= htmlspecialchars($image['alt_description'] ?? 'Imagen') ?>" style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($query) ?> <?= $index+1 ?></h5>
                                            <p class="card-text">Por: <?= htmlspecialchars($image['user']['name']) ?></p>
                                            <a href="<?= $image['links']['html'] ?>" class="btn btn-sm btn-primary" target="_blank">Ver en Unsplash</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0"><i class="fas fa-info-circle"></i> Acerca de esta API</h3>
                </div>
                <div class="card-body">
                    <p>Esta API utiliza Unsplash para buscar imágenes de alta calidad basadas en palabras clave.</p>
                    <p>URL de la API: <a href="https://unsplash.com/developers" target="_blank">https://unsplash.com/developers</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>