<?php 
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != ROL_ADMIN) {
    header("Location: index.php?accion=redireccion");
    exit();
} 

require_once("./Views/include/UH.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Categorias</title>
    <link rel="stylesheet" href="./Assets/css/inicio.css">
</head>
<body>
<p>Listado de todas las categorias</p>
<?php if (empty($resultados)): ?>
    <div class="alert alert-info">
        No hay categorias registradas. <a href="index.php?accion=crear">Crear la primera</a>
    </div>
<?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td>
                        <div class="btn-group-actions d-flex">
                            <a href="index.php?accion=editarC&id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-primary"><img src="Assets/imagenes/pen.png" alt="editar" width="50px"></a>
                            <?php if ($_SESSION['rol'] == ROL_ADMIN): ?>
                                <a href="index.php?accion=borrarC&id=<?= $c['id'] ?>" class="btn btn-danger"><img src="Assets/imagenes/trash.png" alt="eliminar" width="40px"></a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
 <div class="botones-container">
        <a href="index.php?accion=redireccion"><button class="btn btn-boton">Volver</button></a>
    </div>
    <script src="Assets/js/trancicion.js"></script>
</body>
</html>