<?php
// config/koneksi.php
// ==================
// Supabase FINAL Configuration
// ==================

// Load environment variables from .env
function loadEnvIfNotLoaded($path) {
    static $loaded = false;
    if ($loaded) return true;
    
    if (!file_exists($path)) {
        return false;
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!array_key_exists($name, $_ENV)) {
            $_ENV[$name] = $value;
        }
    }
    $loaded = true;
    return true;
}

// Load .env file
loadEnvIfNotLoaded(__DIR__ . '/../.env');

// Project Supabase
define('SUPABASE_PROJECT_ID', $_ENV['SUPABASE_PROJECT_ID'] ?? 'wbuwkgspuyoqibgsvswr');
define('SUPABASE_URL', $_ENV['SUPABASE_URL'] ?? 'https://wbuwkgspuyoqibgsvswr.supabase.co');

// Anon Public API Key (AMAN untuk frontend/backend ringan + RLS)
define('SUPABASE_KEY', $_ENV['SUPABASE_KEY'] ?? 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6IndidXdrZ3NwdXlvcWliZ3N2c3dyIiwicm9sZSI6ImFub24iLCJpYXQiOjE3Njk5NzcwMDMsImV4cCI6MjA4NTU1MzAwM30.U9M-kCST-ZPFuZLi2uIUcQ4ncU75r3J4CqYkXuRfIFw');

// Environment settings
define('ENVIRONMENT', $_ENV['ENVIRONMENT'] ?? 'development');
define('ENABLE_SSL_VERIFY', ($_ENV['ENABLE_SSL_VERIFY'] ?? 'false') === 'true');

/**
 * Supabase REST Request Helper
 *
 * @param string $method  GET | POST | PATCH | DELETE
 * @param string $path    contoh: 'questions?select=*'
 * @param array|null $data data body (untuk POST/PATCH)
 *
 * @return array
 */
function supabase_request($method, $path, $data = null)
{
    $url = SUPABASE_URL . '/rest/v1/' . ltrim($path, '/');
    $ch  = curl_init($url);

    $headers = [
        'apikey: ' . SUPABASE_KEY,
        'Authorization: Bearer ' . SUPABASE_KEY,
        'Content-Type: application/json',
        'Prefer: return=representation'
    ];

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => strtoupper($method),
        CURLOPT_HTTPHEADER     => $headers,

        // SSL Verification (automatically adjusted based on environment)
        CURLOPT_SSL_VERIFYPEER => ENABLE_SSL_VERIFY,
        CURLOPT_SSL_VERIFYHOST => ENABLE_SSL_VERIFY ? 2 : 0,

        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT        => 30
    ]);


    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response  = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'error' => true,
            'message' => 'cURL Error: ' . $error
        ];
    }

    curl_close($ch);

    $decoded = json_decode($response, true);

    if ($http_code >= 400) {
        return [
            'error' => true,
            'status' => $http_code,
            'response' => $decoded
        ];
    }

    return $decoded ?? [];
}
