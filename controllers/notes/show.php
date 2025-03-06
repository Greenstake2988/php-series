<?php
use Core\Database;

$config = require base_path('config.php');

$db = new Database($config['database']);

$note = $db->query("SELECT * FROM notes where id = ?", [
    $_GET['id']
])->fetchOrAbort();

authorized($note['user_id'] === 1);

view("notes/show.view.php", [
    'heading' => "Note",
    'note' => $note
]);
