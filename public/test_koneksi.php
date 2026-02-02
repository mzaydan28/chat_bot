<?php
require_once '../config/koneksi.php';

$data = supabase_request('GET', 'chatbot?select=*');

echo '<pre>';
print_r($data);
