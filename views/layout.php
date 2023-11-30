<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App MITO</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    
<div class="logo">
    <a href="/">
        <img src="../img/logo.jpg" alt="imagen">
    </a>
</div>
    <div class="contenedor-app">
        <div class="imagen"></div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>
    
            
</body>
<footer>
  <div class="footer-logo">
    <img src="../img/logo.jpg" alt="Logo">
  </div>
  <div class="footer-info">
    <div class="description">
      <p>Venta de cepillos, escobillones, palas y escobas plásticas<br>por mayor y menor.<br>Más de 45 años en el mercado.</p>
    </div>
    <div class="ubicacion">
      <img src="../img/ubicacionLogo.png" alt="Logo de Tiempo">
      <p>Dr. Eliseo Soaje 1285, Altos de Vélez Sarsfield, Córdoba Capital</p>
    </div>
    <div class="tiempo">
      <img src="../img/tiempoLogo.png" alt="Logo de Tiempo">
      <p>Lunes a Viernes de 9:00 a 13:00hs y de 15:30 a 19:00hs</p>
    </div>
  </div>
  <div class="whatsapp-button">
    <a href="https://api.whatsapp.com/send?phone=3515958890" target="_blank">Contactar por WhatsApp</a>
  </div>
</footer>
</html>