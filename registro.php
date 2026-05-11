<?php include('db.php');
if (isset($_POST['registrar'])) {
    if ($_POST['p1'] === $_POST['p2']) {
        $sql = "INSERT INTO usuarios (nombre, segundo_nombre, apellido_paterno, apellido_materno, grado, grupo, correo, password) 
                VALUES ('{$_POST['n1']}', '{$_POST['n2']}', '{$_POST['ap']}', '{$_POST['am']}', '{$_POST['gr']}', '{$_POST['gp']}', '{$_POST['em']}', '{$_POST['p1']}')";
        $conexion->query($sql);
        header("Location: index.php");
    } else { echo "<script>alert('Las contraseñas no coinciden');</script>"; }
} ?>
<!DOCTYPE html>
<html lang="es">
<head><title>Registro - CECYTE</title><link rel="stylesheet" href="css/estilos.css"></head>
<body style="background-image: url('img/Portada.png'); background-size: cover; background-attachment: fixed;">
    <h2>Registro de Alumno</h2>
    <form method="POST">
        <input type="text" name="n1" placeholder="Primer Nombre" required>
        <input type="text" name="n2" placeholder="Segundo Nombre">
        <input type="text" name="ap" placeholder="Ap. Paterno" required>
        <input type="text" name="am" placeholder="Ap. Materno" required>
        <input type="text" name="gr" placeholder="Grado (Ej: 6)" required>
        <input type="text" name="gp" placeholder="Grupo (Ej: D)" required>
        <input type="email" name="em" placeholder="Correo" required>
        <input type="password" name="p1" placeholder="Contraseña" required>
        <input type="password" name="p2" placeholder="Repetir Contraseña" required>
        <button type="submit" name="registrar">Registrar Cuenta</button>
    </form>
</body>
</html>