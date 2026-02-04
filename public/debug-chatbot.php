<?php
require_once '../config/koneksi.php';

echo "=== Debug Tabel Chatbot ===\n\n";

// Test 1: Ambil dengan berbagai cara
echo "1. Query tanpa limit:\n";
$result1 = supabase_request('GET', 'chatbot');
echo "Jumlah: " . (is_array($result1) ? count($result1) : 'Error') . "\n";
echo '<pre>' . json_encode($result1, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</pre>';

// Test 2: Dengan select spesifik
echo "\n2. Query dengan select *:\n";
$result2 = supabase_request('GET', 'chatbot?select=*');
echo "Jumlah: " . (is_array($result2) ? count($result2) : 'Error') . "\n";
echo '<pre>' . json_encode($result2, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</pre>';

// Test 3: Dengan limit
echo "\n3. Query dengan limit 100:\n";
$result3 = supabase_request('GET', 'chatbot?limit=100');
echo "Jumlah: " . (is_array($result3) ? count($result3) : 'Error') . "\n";
echo '<pre>' . json_encode($result3, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</pre>';

// Test 4: Cek informasi koneksi
echo "\n4. Informasi Koneksi:\n";
echo "Project ID: " . SUPABASE_PROJECT_ID . "\n";
echo "URL: " . SUPABASE_URL . "\n";
echo "API Key (first 30 chars): " . substr(SUPABASE_KEY, 0, 30) . "...\n";
?>
