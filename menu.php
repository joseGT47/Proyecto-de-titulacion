<?php include('db.php'); session_start();
if(!isset($_SESSION['user_id'])) header("Location: index.php");

$productos = [
    ['id' => 1, 'cat' => 'comida', 'nom' => 'Torta de Pollo', 'pre' => 35, 'img' => 'torta.jpg'],
    ['id' => 2, 'cat' => 'comida', 'nom' => 'Tacos al Pastor', 'pre' => 45, 'img' => 'tacos.jpg'],
    ['id' => 3, 'cat' => 'bebida', 'nom' => 'Agua Natural', 'pre' => 15, 'img' => 'agua.jpg'],
    ['id' => 4, 'cat' => 'bebida', 'nom' => 'Jugo de Naranja', 'pre' => 20, 'img' => 'jugo.jpg'],
    ['id' => 5, 'cat' => 'botana', 'nom' => 'Papas con Chile', 'pre' => 25, 'img' => 'papas.jpg'],
    ['id' => 6, 'cat' => 'comida', 'nom' => 'Sincronizadas', 'pre' => 30, 'img' => 'sincro.jpg'],
    ['id' => 7, 'cat' => 'botana', 'nom' => 'Fruta de Temporada', 'pre' => 20, 'img' => 'fruta.jpg']
]; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Menú - CECYTE</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script>
        function filtrar(c) {
            document.querySelectorAll('.producto-card').forEach(p => p.style.display = (c=='todo'||p.dataset.cat==c)?'flex':'none');
            document.querySelectorAll('.btn-filtro').forEach(b => b.classList.remove('btn-active'));
            event.target.classList.add('btn-active');
        }
        function calcular() {
            let t = 0; const pr = [35,45,15,20,25,30,20];
            document.querySelectorAll('.cant').forEach((inp, i) => t += inp.value * pr[i]);
            document.getElementById('tdisplay').innerText = t.toFixed(2);
            document.getElementById('thidden').value = t.toFixed(2);
        }
    </script>
</head>
<body style="background-image: url('img/Portada.png'); background-size: cover; background-attachment: fixed;">
    <h2>Menú CECYTE 06</h2>
    <div class="filtros">
        <button class="btn-filtro btn-active" onclick="filtrar('todo')">Todo</button>
        <button class="btn-filtro" onclick="filtrar('comida')">Comida</button>
        <button class="btn-filtro" onclick="filtrar('botana')">Botanas</button>
        <button class="btn-filtro" onclick="filtrar('bebida')">Bebidas</button>
    </div>
    <form action="finalizar_pedido.php" method="POST">
        <?php foreach($productos as $p): ?>
        <div class="producto-card" data-cat="<?php echo $p['cat']; ?>">
            <img src="img/<?php echo $p['img']; ?>" width="60" height="60">
            <div style="flex-grow:1; margin-left:15px;"><strong><?php echo $p['nom']; ?></strong><br>$<?php echo $p['pre']; ?></div>
            <input type="number" name="cants[]" value="0" min="0" class="cant" onchange="calcular()" style="width:50px;">
            <input type="hidden" name="noms[]" value="<?php echo $p['nom']; ?>">
        </div>
        <?php endforeach; ?>
        <div style="text-align:center;">
            <h3>Total: $<span id="tdisplay">0.00</span></h3>
            <input type="hidden" name="total" id="thidden" value="0.00">
            <textarea name="nota" placeholder="Notas especiales..."></textarea>
            <button type="submit" name="finalizar">Confirmar y Ver QR</button>
        </div>
    </form>
</body>
</html>