<?php

// Function to prompt the user for input and return the entered value
function prompt($message) {
    echo $message . ": ";
    return trim(fgets(STDIN));
}

// Function to scan a directory recursively for .txt files
function scanDirectory($dir) {
    $files = [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            $files = array_merge($files, scanDirectory($path));
        } elseif (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === 'txt') {
            $files[] = $path;
        }
    }
    return $files;
}

// Function to create a backup of .txt files
function createBackup($files, $backupDir) {
    $report = [];
    foreach ($files as $file) {
        $basename = pathinfo($file, PATHINFO_BASENAME);
        $timestamp = date('Ymd_His');
        $backupFile = $backupDir . DIRECTORY_SEPARATOR . $basename . '_' . $timestamp;
        if (copy($file, $backupFile)) {
            $report[] = [
                'original' => $file,
                'backup' => $backupFile,
                'timestamp' => date('Y-m-d H:i:s')
            ];
        }
    }
    return $report;
}

// Function to generate a backup report
function generateReport($report, $backupDir) {
    $reportFile = $backupDir . DIRECTORY_SEPARATOR . 'backup_report.txt';
    $reportContent = '';
    foreach ($report as $entry) {
        $reportContent .= "Original: {$entry['original']}\n";
        $reportContent .= "Backup: {$entry['backup']}\n";
        $reportContent .= "Timestamp: {$entry['timestamp']}\n\n";
    }
    file_put_contents($reportFile, $reportContent);
}

// Function to delete a directory and its contents
function deleteDirectory($dir) {
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            deleteDirectory($path);
        } else {
            unlink($path);
        }
    }
    rmdir($dir);
}

// Main script execution
$dir = prompt("Enter the directory path to scan");

if (!is_dir($dir)) {
    echo "Invalid directory path.\n";
    exit(1);
}

$backupDir = $dir . DIRECTORY_SEPARATOR . 'backup';

if (!mkdir($backupDir) && !is_dir($backupDir)) {
    echo "Failed to create backup directory.\n";
    exit(1);
}

$files = scanDirectory($dir);

if (empty($files)) {
    echo "No .txt files found in the directory.\n";
    rmdir($backupDir);
    exit(1);
}

$report = createBackup($files, $backupDir);
generateReport($report, $backupDir);

echo "Backup and report generation complete.\n";
echo "Deleting backup directory and its contents...\n";

deleteDirectory($backupDir);

echo "Backup directory deleted.\n";

?>
