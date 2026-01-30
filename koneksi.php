<?php
define('SUPABASE_URL', 'https://xdqcryxrecrlcsqpnawi.supabase.co');
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InhkcWNyeXhyZWNybGNzcXBuYXdpIiwicm9sZSI6ImFub24iLCJpYXQiOjE3Njk3NzU1NDIsImV4cCI6MjA4NTM1MTU0Mn0.THZpxxHK_IOyJE-aWu_OAJ9-n7hmCvpM_5nWp-2GFVc');

function supabase_request($method, $path, $data = null) {
    $url = SUPABASE_URL . "/rest/v1/" . $path;
    $ch = curl_init($url);
    
    $headers = [
        "apikey: " . SUPABASE_KEY,
        "Authorization: Bearer " . SUPABASE_KEY,
        "Content-Type: application/json",
        "Prefer: return=representation"
    ];

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    
    // Cek error tanpa perlu curl_close
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        // Kamu bisa log error ini jika perlu
        return ['error' => $error_msg];
    }

    return json_decode($response, true);
}
?>