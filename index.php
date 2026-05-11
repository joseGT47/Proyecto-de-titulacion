<?php include('db.php'); session_start();
if (isset($_POST['login'])) {
    $em = $_POST['correo']; $ps = $_POST['pass'];
    $res = $conexion->query("SELECT * FROM usuarios WHERE correo='$em' AND password='$ps'");
    if ($f = $res->fetch_assoc()) {
        $_SESSION['user_id'] = $f['id']; $_SESSION['rol'] = $f['rol'];
        header($f['rol'] == 'propietario' ? "Location: propietario.php" : "Location: menu.php");
    } else { echo "<script>alert('Datos incorrectos');</script>"; }
} ?>
<!DOCTYPE html>
<html lang="es">
<head><title>CECYTE 06 - Login</title><link rel="stylesheet" href="css/estilos.css"></head>
<body style="background-image: url('img/Portada.png'); background-size: cover; background-attachment: fixed;">
    <div class="logo-ovalo"><img src="img/Cecyte.jpg" alt="Logo"></div>
    <h2>Acceso Cooperativa Tepeyanco</h2>
    <form method="POST">
        <input type="email" name="correo" placeholder="Correo Institucional" required>
        <input type="password" name="pass" placeholder="Contraseña" required>
        <button type="submit" name="login">Iniciar Sesión</button>
        <p style="text-align:center;"><a href="registro.php" style="color:var(--guinda);">¿Eres nuevo? Regístrate</a></p>
    </form>
</body>
</html>