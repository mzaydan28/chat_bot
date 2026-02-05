<?php
require_once __DIR__ . '/config/ai-config.php';
require_once __DIR__ . '/public/ai-handler.php';

echo "=== GROQ API DEBUG ===\n\n";

// Check environment
echo "1. Check API Key:\n";
echo "   GROQ_API_KEY: " . (defined('GROQ_API_KEY') ? (empty(GROQ_API_KEY) ? 'EMPTY!' : substr(GROQ_API_KEY, 0, 20) . '...') : 'NOT DEFINED!') . "\n";
echo "   GROQ_MODEL: " . (defined('GROQ_MODEL') ? GROQ_MODEL : 'NOT DEFINED!') . "\n";
echo "   GROQ_API_URL: " . (defined('GROQ_API_URL') ? GROQ_API_URL : 'NOT DEFINED!') . "\n\n";

// Check .env file
echo "2. Check .env file:\n";
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    echo "   .env EXISTS\n";
    $envContent = file_get_contents($envPath);
    echo "   Content preview:\n";
    $lines = explode("\n", $envContent);
    foreach ($lines as $line) {
        if (strpos($line, 'GROQ') !== false) {
            echo "   " . $line . "\n";
        }
    }
} else {
    echo "   .env NOT FOUND!\n";
}
echo "\n";

// Test simple question
echo "3. Test AI Query:\n";
$question = "apa itu disperindag?";
echo "   Question: $question\n\n";

$result = askGroq($question);

echo "   Result:\n";
print_r($result);
echo "\n";

if ($result['error']) {
    echo "   ERROR DETECTED!\n";
    echo "   Message: " . $result['message'] . "\n";
    if (isset($result['response'])) {
        echo "   API Response:\n";
        echo "   " . $result['response'] . "\n";
    }
}

echo "\n=== END DEBUG ===\n";
?>
