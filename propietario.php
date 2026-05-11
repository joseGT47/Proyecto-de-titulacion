<?php include('db.php'); session_start();
if($_SESSION['rol'] != 'propietario') header("Location: index.php");
if(isset($_GET['e'])) { $id = $_GET['e']; $conexion->query("UPDATE pedidos SET estatus='entregado' WHERE id=$id"); }
$res = $conexion->query("SELECT p.*, u.nombre, u.grado, u.grupo FROM pedidos p JOIN usuarios u ON p.usuario_id = u.id WHERE p.estatus='pendiente'");
?>
<!DOCTYPE html>
<html lang="es">
<head><title>Dueño - CECYTE</title><link rel="stylesheet" href="estilos.css"></head>
<body style="background-image: url('Portada.png'); background-size: cover; background-attachment: fixed;">
    <h2>Pedidos Recibidos - Tepeyanco</h2>
    <table border="1" style="width:100%; max-width:800px; background:white; border-collapse:collapse;">
        <tr style="background:var(--guinda); color:white;">
            <th>Código</th><th>Alumno</th><th>G/G</th><th>Pedido/Nota</th><th>Acción</th>
        </tr>
        <?php while($p = $res->fetch_assoc()){ ?>
        <tr>
            <td style="padding:10px;"><strong><?php echo $p['codigo_pedido']; ?></strong></td>
            <td><?php echo $p['nombre']; ?></td>
            <td><?php echo $p['grado'].$p['grupo']; ?></td>
            <td><?php echo $p['comentario']; ?></td>
            <td><a href="?e=<?php echo $p['id']; ?>" style="color:green; font-weight:bold;">ENTREGAR</a></td>
        </tr>
        <?php } ?>
    </table>
    <br><a href="index.php">Cerrar Sesión</a>
</body>
</html>
