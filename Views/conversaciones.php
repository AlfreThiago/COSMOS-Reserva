<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversaciones</title>
</head>

<body>
    <h2>Mis conversaciones</h2>
    <a href="index.php?accion=redireccion">Volver al inicio</a>

    <?php if (!empty($conversaciones)): ?>
        <ul>
            <?php foreach ($conversaciones as $c): ?>
                <li>
                    <strong><?= htmlspecialchars($c['otro_usuario']) ?></strong><br>
                    <em><?= htmlspecialchars($c['ultimo_mensaje']) ?></em><br>
                    <small><?= $c['ultima_fecha'] ?></small><br>

                    <a href="index.php?accion=mostrarConversacion&usuario_id=<?= $c['otro_usuario_id'] ?>">
                        Ver conversacion
                    </a>

                    <form method="POST" action="index.php?accion=borrarConversacion" style="display:inline"
                        onsubmit="return confirm('¿Seguro que deseas borrar esta conversacion?')">
                        <input type="hidden" name="usuario_id" value="<?= $_SESSION['id'] ?>">
                        <input type="hidden" name="receptor_id" value="<?= $c['otro_usuario_id'] ?>">
                        <button type="submit">Borrar</button>
                    </form>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>

    <?php else: ?>
        <p>No tienes conversaciones aun.</p>
    <?php endif; ?>
</body>

</html>