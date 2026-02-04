<?php
require_once '../config/koneksi.php';

echo "=== Test Koneksi Supabase ===\n\n";

// Test 1: Cek konfigurasi
echo "1. Cek Konfigurasi:\n";
echo "SUPABASE_URL: " . (defined('SUPABASE_URL') ? SUPABASE_URL : 'TIDAK DIDEFINISIKAN') . "\n";
echo "SUPABASE_KEY: " . (defined('SUPABASE_KEY') ? substr(SUPABASE_KEY, 0, 20) . '...' : 'TIDAK DIDEFINISIKAN') . "\n\n";

// Test 2: Ambil semua data
echo "2. Mengambil Data dari Tabel 'chatbot':\n";
$data = supabase_request('GET', 'chatbot?select=*');

echo '<pre>';
print_r($data);
echo '</pre>';

// Test 3: Cek error
if (isset($data['error'])) {
    echo "\n❌ ERROR: " . json_encode($data['error']) . "\n";
} else if (is_array($data) && count($data) == 0) {
    echo "\n⚠️ Tabel kosong atau tidak ada data\n";
} else if (is_array($data) && count($data) > 0) {
    echo "\n✓ Koneksi berhasil! Data ditemukan: " . count($data) . " baris\n";
}
