<?php
// Test website scraping
require_once __DIR__ . '/config/knowledge-base.php';

echo "=== Testing Website Knowledge Base ===\n\n";

$url = 'https://disperindag.jatengprov.go.id/v3/publik/web';

echo "Fetching: $url\n\n";

$html = fetchWebsiteContent($url);

if ($html === false) {
    echo "❌ Failed to fetch website\n";
    exit;
}

echo "✓ Successfully fetched website\n";
echo "HTML Length: " . strlen($html) . " bytes\n\n";

$text = extractTextFromHTML($html);
echo "Extracted Text Length: " . strlen($text) . " bytes\n\n";

echo "First 500 characters:\n";
echo str_repeat("=", 50) . "\n";
echo substr($text, 0, 500) . "\n";
echo str_repeat("=", 50) . "\n\n";

// Test cache
echo "Testing cache...\n";
$cached = cacheWebsiteContent($url, 3600);
if ($cached !== false) {
    echo "✓ Cache working - Length: " . strlen($cached) . " bytes\n";
} else {
    echo "❌ Cache failed\n";
}

echo "\n=== Testing Full Knowledge Base ===\n";
$knowledge = getWebsiteKnowledge();
echo "Total Knowledge Length: " . strlen($knowledge) . " bytes\n";
echo "\nFirst 1000 characters of knowledge:\n";
echo str_repeat("=", 50) . "\n";
echo substr($knowledge, 0, 1000) . "\n";
echo str_repeat("=", 50) . "\n";
?>
