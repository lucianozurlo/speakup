<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $organizacion = $_POST['organizacion'] ?? '';
    $cargo = $_POST['cargo'] ?? '';

    $data = [
        'nombre' => $nombre,
        'email' => $email,
        'organizacion' => $organizacion,
        'cargo' => $cargo,
        'fecha' => date('Y-m-d H:i:s')
    ];

    $file = 'datos_usuarios.json';

    // Si no existe, lo crea
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([$data], JSON_PRETTY_PRINT));
    } else {
        $existing = json_decode(file_get_contents($file), true);
        $existing[] = $data;
        file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));
    }

    echo "OK";
} else {
    http_response_code(405);
    echo "Método no permitido";
}
