<?php

if (!empty($_POST)) {
    $newTaskName = $_POST["title"] ?? "";

    if (isset($_POST["add-task"]) && $_POST["add-task"] == 1) {
        /* Add action */
        addTask($fileName, $newTaskName);
    } elseif (isset($_POST["clear-tasks"]) && $_POST["clear-tasks"] == 1) {
        /* Clear all tasks action */
        clearAndWriteTheFileJSON($fileName);
    } elseif (isset($_POST["remove-task"]) && !empty($_POST["remove-task"])) {
        /* Remove task action */
        removeTask($fileName);
    } elseif (isset($_POST["task-done"]) && !empty($_POST["task-done"])) {
        /* Change a status fot tast action */
        changeTaskStatus($fileName);
    }
}

$tasks = readFromFileJSON($fileName);