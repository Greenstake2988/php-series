<?php

$config = require 'config.php';

$db = new Database($config['database']);

$heading = "Note";

$note = $db->query("SELECT * FROM notes where id = ?", [
    $_GET['id']
])->fetchOrAbort();

authorized($note['user_id'] === 1);

require "views/note.view.php";
