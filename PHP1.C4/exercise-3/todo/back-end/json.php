<?php

function readFromFileJSON(string $fileName): array
{
    $tasks = [];
    if (file_exists($fileName)) {
        $json = file_get_contents($fileName);
        $tasks = json_decode($json, true);
    }

    return $tasks;
}

function addDataToFileJSON(string $fileName, string $newTaskName): void
{
    if (is_writable($fileName)) {
        $tasks = json_decode(file_get_contents($fileName), true);
        $tasks[] = ["taskName" => $newTaskName, "status" => "not-done"];
        if (!file_put_contents($fileName, json_encode($tasks))) {
            echo "Cannot write to the file!";
        }
    }
}

function clearAndWriteTheFileJSON(string $fileName): void
{
    if (is_writable($fileName)) {
        if (!file_put_contents($fileName, json_encode([]))) {
            echo "Cannot write to the file!";
        }
    }
}

function updateFileJSON(string $fileName, array $tasks): void
{
    if (is_writable($fileName)) {
        if (!file_put_contents($fileName, json_encode($tasks))) {
            echo "Cannot write to the file!";
        }
    }
}