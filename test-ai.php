<?php
// Test Gemini AI Integration
require_once __DIR__ . '/public/ai-handler.php';

echo "=== Testing Gemini AI Integration ===\n\n";

// Test 1: Pertanyaan tentang Disperindag (relevant)
echo "Test 1: Pertanyaan Relevant\n";
echo "Q: Bagaimana cara mendaftar UMKM di Disperindag?\n";
$answer1 = handleAIQuery("Bagaimana cara mendaftar UMKM di Disperindag?");
echo "A: " . $answer1 . "\n\n";

// Test 2: Pertanyaan di luar topik
echo "Test 2: Pertanyaan Irrelevant\n";
echo "Q: Siapa presiden Indonesia?\n";
$answer2 = handleAIQuery("Siapa presiden Indonesia?");
echo "A: " . $answer2 . "\n\n";

// Test 3: Pertanyaan tentang jam operasional
echo "Test 3: Pertanyaan Jam Operasional\n";
echo "Q: Jam berapa kantor Disperindag buka?\n";
$answer3 = handleAIQuery("Jam berapa kantor Disperindag buka?");
echo "A: " . $answer3 . "\n\n";

echo "=== Test Complete ===\n";
?>
