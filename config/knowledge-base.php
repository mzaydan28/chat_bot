<?php
/**
 * Knowledge Base dari Website Disperindag
 * File ini berisi informasi tambahan yang di-scrape dari website resmi
 */

// URL-URL website Disperindag yang dijadikan sumber
$DISPERINDAG_URLS = [
    'main' => 'https://disperindag.jatengprov.go.id/v3/publik/web',
    'visi_misi' => 'https://disperindag.jatengprov.go.id/v3/publik/web/profil/visi-misi',
    'profil' => 'https://disperindag.jatengprov.go.id/v3/publik/web/profil',
    'layanan' => 'https://disperindag.jatengprov.go.id/v3/publik/web/layanan',
    'berita' => 'https://disperindag.jatengprov.go.id/v3/publik/web/berita',
    'ppid_faq' => 'https://disperindag.jatengprov.go.id/v3/ppid/post_baca/Y2FhMzBmZWQyYTE1MTRjYzEzYWVhODgzNDFjZDRmZThhZmU1NWUyMDQ0OTNiNzYxNmNkM2Y3ZWU4M2NmNDRk',
    // Tambahkan URL lain di sini
];

/**
 * Fetch content dari website
 */
function fetchWebsiteContent($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DISCHA Bot/1.0');
    
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200) {
        return false;
    }
    
    return $html;
}

/**
 * Extract text dari HTML
 */
function extractTextFromHTML($html) {
    // Remove script dan style tags
    $html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html);
    $html = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $html);
    
    // Convert HTML entities
    $html = html_entity_decode($html);
    
    // Strip all HTML tags
    $text = strip_tags($html);
    
    // Clean up whitespace
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim($text);
    
    return $text;
}

/**
 * Cache website content
 */
function cacheWebsiteContent($url, $duration = 3600) {
    $cacheDir = __DIR__ . '/../cache';
    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }
    
    $cacheFile = $cacheDir . '/web_' . md5($url) . '.txt';
    
    // Check if cache exists and is still valid
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $duration)) {
        return file_get_contents($cacheFile);
    }
    
    // Fetch new content
    $html = fetchWebsiteContent($url);
    if ($html === false) {
        return false;
    }
    
    $text = extractTextFromHTML($html);
    
    // Save to cache
    file_put_contents($cacheFile, $text);
    
    return $text;
}

/**
 * Get all website knowledge
 */
function getWebsiteKnowledge() {
    global $DISPERINDAG_URLS;
    
    $knowledge = "\n\n=== INFORMASI TAMBAHAN DARI WEBSITE DISPERINDAG ===\n\n";
    
    foreach ($DISPERINDAG_URLS as $key => $url) {
        $content = cacheWebsiteContent($url, 3600); // Cache 1 jam
        
        if ($content !== false) {
            $knowledge .= "[Sumber: {$key}]\n";
            // Untuk PPID FAQ ambil lebih banyak konten (10000 karakter)
            $maxLength = ($key === 'ppid_faq') ? 10000 : 2000;
            $knowledge .= substr($content, 0, $maxLength) . "...\n\n";
        }
    }
    
    return $knowledge;
}

/**
 * Get website URL by key
 */
function getWebsiteURL($key) {
    global $DISPERINDAG_URLS;
    return $DISPERINDAG_URLS[$key] ?? null;
}
?>
