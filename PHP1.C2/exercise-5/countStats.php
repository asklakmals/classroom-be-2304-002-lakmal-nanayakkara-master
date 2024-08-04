<?php
function countStats($filename) {
    // Read the contents of the file
    $content = file_get_contents($filename);

    // Initialize counters
    $wordCount = 0;
    $sentenceCount = 0;
    $nonEmptySymbolCount = 0;

    $length = strlen($content);
    $inWord = false;

    // Iterate over each character in the string
    for ($i = 0; $i < $length; $i++) {
        $char = $content[$i];

        // Check if the character is a letter or digit
        if (($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z') || ($char >= '0' && $char <= '9')) {
            $nonEmptySymbolCount++;
            $inWord = true;
        } elseif ($char == ' ' || $char == '\t' || $char == '\n' || $char == '\r') {
            // Check if the character is a space or whitespace
            if ($inWord) {
                $wordCount++;
                $inWord = false;
            }
        } elseif ($char == '.' || $char == '!' || $char == '?') {
            // Check if the character is a sentence-ending punctuation
            $sentenceCount++;
            $inWord = false;
        }
    }

    // Check if the last character was part of a word
    if ($inWord) {
        $wordCount++;
    }

    // Return the counts
    return [
        'word_count' => $wordCount,
        'sentence_count' => $sentenceCount,
        'non_empty_symbol_count' => $nonEmptySymbolCount
    ];
}

// Example usage
$filename = 'example.txt';
$result = countStats($filename);
echo "Words: " . $result['word_count'] . "\n";
echo "Sentences: " . $result['sentence_count'] . "\n";
echo "Non-empty symbols: " . $result['non_empty_symbol_count'] . "\n";
?>
