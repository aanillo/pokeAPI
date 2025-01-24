<?php

function loadEventsFromJson()
{
    $file = 'usuarios.json';
    if (file_exists($file)) {
        $content = file_get_contents($file);
        return json_decode($content, true) ?? [];
    }
    return []; 
}

function saveEventsToJson($events)
{
    // Nombre del archivo JSON
    $file = 'usuarios.json';
    file_put_contents($file, json_encode($events, JSON_PRETTY_PRINT));
}

?>