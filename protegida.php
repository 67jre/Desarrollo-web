<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';
$stmt = $conexion->prepare("SELECT nombre, correo, telefono, fecha_nacimiento, ciudad FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $_SESSION['usuario_id']);
$stmt->execute();
$stmt->bind_result($nombre, $correo, $telefono, $fecha_nac, $ciudad);
$stmt->fetch();
$stmt->close();
$conexion->close();

/* Formateo seguro de fecha */
$fecha_formateada = $fecha_nac ? date('d/m/Y', strtotime($fecha_nac)) : 'N/D';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Privada</title>
    <link rel="stylesheet" href="estylos.css">
</head>
<body>
     <div class="container">

    <div class="protegida-header">
      <h1>Contenido de la Página</h1>
      <p>Bienvenido, <strong><?php echo htmlspecialchars($nombre); ?></strong></p>
    </div>

    <div class="panel">

      <section class="datos-usuario">
        <h2>Tus datos</h2>
        <ul class="lista-datos">
          <li><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></li>
          <li><strong>Teléfono:</strong> <?php echo htmlspecialchars($telefono); ?></li>
          <li><strong>Fecha de nacimiento:</strong> <?php echo htmlspecialchars($fecha_formateada); ?></li>
          <li><strong>Ciudad:</strong> <?php echo htmlspecialchars($ciudad); ?></li>
        </ul>
      </section>

      <section class="galeria-deportes">
    <h2>Artistas Musicales</h2>

    <div class="deportes-grid">

        <!-- BAD BUNNY -->
        <article class="deporte-card">
            <img src= "fotos\BAD BUNNY.jpeg" alt="Bad Bunny" class="deporte-img">
            <div class="deporte-info">
                <h3>Bad Bunny</h3>
                <p>
                    Cantante puertorriqueño reconocido mundialmente por su estilo urbano,
                    reguetón y trap latino. Ha revolucionado la música con creatividad,
                    personalidad y mensajes sociales.
                </p>
            </div>
        </article>

        <!-- KAROL G -->
        <article class="deporte-card">
            <img src="fotos\KAROL G.jpeg" alt="Karol G" class="deporte-img">
            <div class="deporte-info">
                <h3>Karol G</h3>
                <p>
                    Artista colombiana del género urbano y pop latino. Ganadora de múltiples
                    premios internacionales y símbolo de empoderamiento femenino.
                </p>
            </div>
        </article>

        <!-- GERARDO MORÁN -->
        <article class="deporte-card">
            <img src="fotos\GERARDO MORÁN.jpeg" alt="Gerardo Morán" class="deporte-img">
            <div class="deporte-info">
                <h3>Gerardo Morán</h3>
                <p>
                    Cantante ecuatoriano de tecnocumbia conocido como “El Más Querido”.
                    Famoso por su estilo alegre y letras llenas de sentimiento.
                </p>
            </div>
        </article>

    </div>
</section>
  </div>
</body>
</html>