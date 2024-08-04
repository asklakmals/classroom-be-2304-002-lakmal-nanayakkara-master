<?php
function processFiles($directory) {
    // Get the list of text files in the directory
    $files = scandir($directory);
    $content = '';

    // Merge the contents of all text files
    foreach ($files as $file) {
        $filePath = realpath($directory . DIRECTORY_SEPARATOR . $file);
        if ($filePath && pathinfo($filePath, PATHINFO_EXTENSION) === 'txt') {
            $fileContent = file_get_contents($filePath);
            $content .= $fileContent ? $fileContent . PHP_EOL : '';
        }
    }

    // Split the content into lines and remove duplicates
    $lines = array_filter(array_map('trim', explode(PHP_EOL, $content)));
    $lines = array_unique($lines);

    // Sort lines in descending order
    arsort($lines);

    // Truncate lines and add suffix
    $index = 1;
    $lines = array_map(function($line) use (&$index) {
        $truncatedLine = substr($line, 0, 30);
        return $truncatedLine . '#' . $index++;
    }, $lines);

    // Prepare the new filename with current date and time
    $formattedDateTime = date('Y-m-d_H-i-s');
    $newFilename = "merged_output_{$formattedDateTime}.txt";
    $newFilePath = $directory . DIRECTORY_SEPARATOR . $newFilename;

    // Write the updated content to the new file
    file_put_contents($newFilePath, implode(PHP_EOL, $lines));
}

// Example usage
$directory = 'path_to_your_text_files_directory';
processFiles($directory);
echo "Processing completed. Check the directory for the merged output file.\n";
?>