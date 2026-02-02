<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/koneksi.php';

$template_keywords = ['halo','jam','alamat','umkm','perizinan'];

if (empty($template_keywords)) {
    echo json_encode([]);
    exit;
}

// Supabase filter: keyword=in.(...)
$in = '(' . implode(',', array_map(fn($k) => '"' . $k . '"', $template_keywords)) . ')';

$data = supabase_request(
    'GET',
    "chatbot?select=keyword&keyword=in.$in"
);

if (isset($data['error'])) {
    http_response_code(500);
    echo json_encode(['error' => 'Supabase error']);
    exit;
}

$questions = [
    'halo' => 'Halo! Apa kabar?',
    'jam' => 'Jam berapa kantor Disperindag buka?',
    'alamat' => 'Dimana lokasi kantor Disperindag?',
    'umkm' => 'Apa itu UMKM?',
    'perizinan' => 'Bagaimana cara mengurus perizinan?',
];

$templates = [];

foreach ($data as $row) {
    $key = $row['keyword'];
    $templates[] = [
        'keyword' => $key,
        'question' => $questions[$key] ?? ucfirst($key) . '?'
    ];
}

shuffle($templates);
$templates = array_slice($templates, 0, 5);

echo json_encode($templates, JSON_UNESCAPED_UNICODE);
