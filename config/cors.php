<?php
return [
    'paths' => ['api/*'], // Ensure CORS applies to API routes
    'allowed_methods' => ['*'], // Allow all methods (GET, POST, etc.)
    'allowed_origins' => ['http://localhost:5173'], // No trailing slash
    'allowed_origins_patterns' => [], // Can be left empty
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Set to true if using authentication
];

