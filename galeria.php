<?php
$dir = __DIR__ . '/galeria';
$imagenes = [];
if (is_dir($dir)) {
    $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'];
    foreach (scandir($dir) as $archivo) {
        if ($archivo[0] === '.') {
            continue;
        }
        $extension = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        if (in_array($extension, $permitidas)) {
            $imagenes[] = $archivo;
        }
    }
}

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    $paths = array_map(fn($img) => 'galeria/' . $img, $imagenes);
    echo json_encode($paths);
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .galeria { display:flex; flex-wrap:wrap; gap:10px; }
        .galeria figure { margin:0; }
        .galeria img { max-width:200px; height:auto; display:block; }
    </style>
</head>
<body>
    <div class="galeria">
        <?php foreach ($imagenes as $img): ?>
            <figure>
                <img src="<?php echo 'galeria/' . htmlspecialchars($img, ENT_QUOTES, 'UTF-8'); ?>" alt="">
            </figure>
        <?php endforeach; ?>
        <?php if (empty($imagenes)): ?>
            <p>No se encontraron imágenes en la galería.</p>
        <?php endif; ?>
    </div>
      <script>
        async function refrescarGaleria() {
            try {
                const respuesta = await fetch('galeria.php?ajax=1', { cache: 'no-cache' });
                if (!respuesta.ok) {
                    throw new Error('Error al cargar la galería');
                }
                const imagenes = await respuesta.json();
                const contenedor = document.querySelector('.galeria');
                if (!contenedor) return;
                contenedor.innerHTML = '';
                if (imagenes.length === 0) {
                    contenedor.innerHTML = '<p>No se encontraron imágenes en la galería.</p>';
                    return;
                }
                imagenes.forEach(src => {
                    const figure = document.createElement('figure');
                    const img = document.createElement('img');
                    img.src = src;
                    figure.appendChild(img);
                    contenedor.appendChild(figure);
                });
            } catch (e) {
                console.error(e);
            }
        }
        document.addEventListener('DOMContentLoaded', refrescarGaleria);
        document.addEventListener('galeria-actualizada', refrescarGaleria);
    </script>
</body>
</html>