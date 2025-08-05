<?php
$allowed_origins = [
    "https://acilwifi.com.co",
    "https://www.acilwifi.com.co"
];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Content-Type: application/json");


// Token de la API
$apiToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImp0aSI6IjA3MTI5ZDRhLTFlMGEtNDM0MC04M2NiLThhOTAxMTc5MzY0ZCJ9.eyJpc3MiOiJtYWN2ZW5kb3JzIiwiYXVkIjoibWFjdmVuZG9ycyIsImp0aSI6IjA3MTI5ZDRhLTFlMGEtNDM0MC04M2NiLThhOTAxMTc5MzY0ZCIsImlhdCI6MTczNDI4NTg2NiwiZXhwIjoyMDQ4NzgxODY2LCJzdWIiOiIxNTI4NiIsInR5cCI6ImFjY2VzcyJ9.emnPQoXMyN5kDMJJWOHkc2Bfow0G_36Xb33xNucqJY9b8tzabWFQN8jzLvklDX7hO9RnLOSsk83Sl90zxG5sGg";

// Obtener prefijo MAC de la URL
if (isset($_GET['macPrefix'])) {
    $macPrefix = $_GET['macPrefix'];
    
    $apiUrl = "https://api.macvendors.com/v1/lookup/$macPrefix";

    // Llamada a la API usando cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $apiToken"
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Verificar respuesta
    if ($httpCode == 200) {
        echo $response;
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Error en la API"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Falta el parámetro 'macPrefix'"]);
}
?>
