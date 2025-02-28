<footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Naroly Tolentino - Portal de APIs</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS personalizado -->
    <script src="<?php echo str_starts_with($_SERVER['REQUEST_URI'], '/apis/') ? '../js/script.js' : 'js/script.js'; ?>"></script>
</body>
</html>