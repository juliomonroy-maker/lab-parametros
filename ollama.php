<?php
header('Content-Type: text/html; charset=utf-8');
set_time_limit(300);

// 1. Datos de la petición
$datos = [
    'model'  => 'qwen3.5:4b',
    'prompt' => 'Escribe un eslogan para una taquería',
    'stream' => false,
    'think'  => false,
    'options' => [
        'temperature' => 0,
        'top_p'       => 0.9,
        'top_k'       => 40,
        'num_predict' => 200,
    ],
];

// 2. Enviar la petición a Ollama
$opciones = [
    'http' => [
        'method'        => 'POST',
        'header'        => "Content-Type: application/json\r\n",
        'content'       => json_encode($datos),
        'timeout'       => 300,
        'ignore_errors' => true,
    ],
];
$respuesta = file_get_contents(
    'http://localhost:11434/api/generate',
    false,
    stream_context_create($opciones)
);
if ($respuesta === false) {
    die('No se pudo conectar con Ollama');
}

// 3. Leer el resultado
$resultado = json_decode($respuesta, true);

if (!isset($resultado['response'])) {
    die('Ollama respondió algo inesperado: ' . htmlspecialchars($respuesta));
}

$texto  = $resultado['response'];
$tiempo = round($resultado['total_duration'] / 1000000000, 3);

// 4. Mostrar
echo '<p><strong>Respuesta:</strong><br>' . nl2br(htmlspecialchars($texto)) . '</p>';
echo "<p><strong>Tiempo:</strong> $tiempo s</p>";