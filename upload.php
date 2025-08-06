<?php
// Configuración del token esperado y del directorio de carga
$expectedToken = getenv('UPLOAD_TOKEN');
if ($expectedToken === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Token no configurado']);
    exit;
}
$uploadDir = __DIR__ . '/galeria/';
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$maxFileSize = 2 * 1024 * 1024; // 2 MB

header('Content-Type: application/json');

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

// Validar token
if (!isset($_POST['token']) || $_POST['token'] !== $expectedToken) {
    http_response_code(401);
    echo json_encode(['error' => 'Token inválido']);
    exit;
}

// Verificar que se haya enviado un archivo
if (!isset($_FILES['imagen'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No se recibió ningún archivo']);
    exit;
}

$file = $_FILES['imagen'];

// Manejo de errores de PHP al subir archivos
if ($file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Error al subir el archivo', 'code' => $file['error']]);
    exit;
}

// Validación de tamaño
if ($file['size'] > $maxFileSize) {
    http_response_code(413);
    echo json_encode(['error' => 'El archivo excede el tamaño permitido']);
    exit;
}

// Validación de tipo MIME
$mimeType = mime_content_type($file['tmp_name']);
if (!in_array($mimeType, $allowedMimeTypes)) {
    http_response_code(415);
    echo json_encode(['error' => 'Tipo de archivo no permitido']);
    exit;
}

// Verificar directorio de carga
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        http_response_code(500);
        echo json_encode(['error' => 'No se pudo crear el directorio de carga']);
        exit;
    }
}

if (!is_writable($uploadDir)) {
    http_response_code(500);
    echo json_encode(['error' => 'El directorio de carga no es escribible']);
    exit;
}


// Normalizar nombre del archivo
$filename = basename($file['name']);
$filename = preg_replace('/[^A-Za-z0-9_\.\-]/', '_', $filename);

// Evitar sobrescribir archivos existentes
$destination = $uploadDir . $filename;
if (file_exists($destination)) {
    $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $destination = $uploadDir . $filenameWithoutExt . '_' . uniqid() . ($extension ? '.' . $extension : '');
}

// Mover archivo
if (!move_uploaded_file($file['tmp_name'], $destination)) {
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo guardar el archivo en el servidor']);
    exit;
}

// Éxito
http_response_code(200);
$publicPath = 'galeria/' . basename($destination);
echo json_encode(['mensaje' => 'Archivo subido correctamente', 'archivo' => $publicPath]);
