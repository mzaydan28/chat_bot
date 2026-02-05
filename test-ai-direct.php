<?php
require_once __DIR__ . '/public/ai-handler.php';

$question = "apa tujuan utama disperindag untuk provinsi jateng";

echo "Testing AI with website knowledge...\n";
echo "Question: $question\n\n";

$result = askGemini($question);

echo "Result:\n";
print_r($result);

if (!$result['error']) {
    echo "\n\nAnswer:\n";
    echo $result['answer'];
}
?>
