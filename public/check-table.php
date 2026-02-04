<?php
require_once '../config/koneksi.php';

echo "=== Cek Tabel Supabase ===\n\n";

// Cek informasi tabel dari information_schema
$table_info = supabase_request('GET', 'information_schema.tables?table_schema=eq.public');

echo "1. Daftar Tabel:\n";
echo '<pre>';
print_r($table_info);
echo '</pre>';

// Cek data dari tabel chatbot
echo "\n2. Data di Tabel 'chatbot':\n";
$chatbot_data = supabase_request('GET', 'chatbot?select=*&limit=100');

echo '<pre>';
print_r($chatbot_data);
echo '</pre>';

// Cek jumlah total
if (is_array($chatbot_data) && !isset($chatbot_data['error'])) {
    echo "\n✓ Total data di tabel chatbot: " . count($chatbot_data) . " baris\n";
} else {
    echo "\n❌ Error atau tabel tidak ditemukan\n";
}
?>
