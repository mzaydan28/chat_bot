<?php
// config/koneksi.php
// ==================
// Supabase FINAL Configuration
// ==================

// Project Supabase
define('SUPABASE_PROJECT_ID', 'wbuwkgspuyoqibgsvswr');
define('SUPABASE_URL', 'https://wbuwkgspuyoqibgsvswr.supabase.co');

// Anon Public API Key (AMAN untuk frontend/backend ringan + RLS)
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6IndidXdrZ3NwdXlvcWliZ3N2c3dyIiwicm9sZSI6ImFub24iLCJpYXQiOjE3Njk5NzcwMDMsImV4cCI6MjA4NTU1MzAwM30.U9M-kCST-ZPFuZLi2uIUcQ4ncU75r3J4CqYkXuRfIFw');

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

    // FIX UNTUK XAMPP WINDOWS (LOCAL ONLY)
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,

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
