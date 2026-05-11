<?php include('db.php'); session_start();
if (isset($_POST['finalizar'])) {
    $id_u = $_SESSION['user_id']; $tot = $_POST['total']; $nota = $_POST['nota'];
    if($tot <= 0) { header("Location: menu.php"); exit(); }

    $res_u = $conexion->query("SELECT nombre FROM usuarios WHERE id = '$id_u'");
    $u = $res_u->fetch_assoc();
    $prefix = strtoupper(substr($u['nombre'], 0, 3)); // Prefijo nombre

    $det = ""; $cants = $_POST['cants']; $noms = $_POST['noms'];
    for($i=0; $i<count($noms); $i++) { if($cants[$i]>0) $det .= $cants[$i]."x".$noms[$i]." "; }

    $cod = $prefix . "-" . strtoupper(substr(md5(time()), 0, 4));
    $conexion->query("INSERT INTO pedidos (usuario_id, codigo_pedido, comentario, total) VALUES ('$id_u', '$cod', '$det | $nota', '$tot')");
    $qr = "https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=$cod";
} ?>
<!DOCTYPE html>
<html lang="es">
<head><title>Ticket - CECYTE</title><link rel="stylesheet" href="estilos.css"></head>
<body style="background-image: url('Portada.png'); background-size: cover; background-attachment: fixed;">
    <div class="ticket">
        <h2 style="margin:0;">Comprobante de Pedido</h2>
        <div class="codigo-texto"><?php echo $cod; ?></div>
        <img src="<?php echo $qr; ?>">
        <p><strong>Total Pagado: $<?php echo $tot; ?></strong></p>
        <p><small><?php echo $det; ?></small></p>
        <button onclick="window.print()">Imprimir Ticket</button>
        <br><br><a href="menu.php" style="color:var(--guinda);">Volver al Menú</a>
    </div>
</body>
</html>
