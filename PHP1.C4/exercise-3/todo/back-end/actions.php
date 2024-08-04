<?php

function addTask(string $fileName, string $newTaskName): void
{
    if (!empty($newTaskName)) {
        addDataToFileJSON($fileName, $newTaskName);
    }
}

function removeTask(string $fileName): void
{
    $tasks = readFromFileJSON($fileName);
    $taskToRemove = $_POST["remove-task"];
    foreach ($tasks as $key => $task) {
        if ($task["taskName"] == $taskToRemove) {
            unset($tasks[$key]);
        }
    }
    updateFileJSON($fileName, $tasks);
}

function changeTaskStatus(string $fileName): void
{
    $tasks = readFromFileJSON($fileName);
    $taskToBeMarkedAsDone = $_POST["task-done"];
    foreach ($tasks as $key => $task) {
        if ($task["taskName"] == $taskToBeMarkedAsDone) {
            $tasks[$key]["status"] = "done";
        }
    }
    updateFileJSON($fileName, $tasks);
}