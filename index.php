<?php
// Set the content type header
header('Content-Type: text/html');

// Serve Swagger UI
echo file_get_contents('/xampp/htdocs/public/swagger/index.html');