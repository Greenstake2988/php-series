<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');

$db = new Database($config['database']);

$errors = [];

if (! Validator::string($_POST["body"], 10, 255)) {
    $errors['body'] = "Error in body";
}

if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => "Create Note",
        'errors' => $errors
    ]);
}

if (empty($errors)) {
    $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
        "body" => $_POST["body"],
        "user_id" => 1
    ]);

    header('Location: /notes');

    exit();
}


