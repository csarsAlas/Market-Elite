<?php
//Conexion a la base de datos
include_once 'php/connection.php';

if(isset($_POST['Agregar'])){
    $agregar = $conn->prepare('INSERT INTO `producto` (nombre_pord, prec_prod, marc_prod, secc_prod, cant_prod) VALUES (:nombre, :precio, :marca, :secc, :cantidad)');
    $agregar->bindParam(':nombre',$_POST['iName']);
    $agregar->bindParam(':precio',$_POST['iPrice']);
    $agregar->bindParam(':marca',$_POST['iMarca']);
    $agregar->bindParam(':secc',$_POST['iSecc']);
    $agregar->bindParam(':cantidad',$_POST['iCantidad']);
    $agregar->execute();
}

if(isset($_POST['Actualizar'])){
    $Actualizar = $conn->prepare('SELECT cant_prod FROM producto WHERE ID_prod=:id');
    $Actualizar->bindParam(':id',$_POST['iProd']);
    $Actualizar->execute();
    $ac = $Actualizar->fetchAll(PDO::FETCH_ASSOC);

    foreach($ac as $iterar){
        $produc = $iterar['cant_prod'];
    }

    $form = $_POST['iNewQuan'];
    $cambiar = $form + $produc;

    $insertar = $conn->prepare('UPDATE producto SET cant_prod=:form WHERE ID_prod=:id');
    $insertar->bindParam(':id',$_POST['iProd']);
    $insertar->bindParam(':form',$cambiar);
    $insertar->execute();
}

if(isset($_POST['eliminar'])){
    $eliminar = $conn->prepare('DELETE FROM `producto` WHERE ID_prod=:id');
    $eliminar->bindParam(':id',$_POST['iElim']);
    $eliminar->execute();
}

$cantidad = 0;
$query = $conn->prepare('SELECT * FROM producto WHERE 1');
$query->execute();
$registros =$query->fetchALL(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARKET Elite</title>
    <link rel="stylesheet" type="text/css" href="css/estilos-productos.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
</head>

<body>
    <header class="header">
        <h1>Market Elite</h1>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="productos.php">Agregar Producto</a></li>
            <li><a href="clientes.php">Agregar Cliente</a></li>
            <li><a href="proveedor.php">Agregar Proveedor</a></li>
            <li><a href="venta.php">Generar venta</a></li>
        </ul>
    </nav>

    <section class="product-forms">
        <div class="form-box">
            <h2>Eliminar productos</h2>
            <form id="elim_prod" method="POST">
                <label>ID del producto a eliminar:</label>
                <input id="Elim" name="iElim" type="number" min="1" required>
                <button type="submit" name="eliminar">Eliminar</button>
            </form>
        </div>

        <div class="form-box">
            <h2>Agregar existencia de productos</h2>
            <form id="cant_prod" method="POST">
                <label>ID del producto:</label>
                <input id="iProd" name="iProd" type="number" min="1" required>
                <label>Cantidad a ingresar:</label>
                <input id="iNewQuan" name="iNewQuan" type="number" min="1" max="50" required>
                <button type="submit" name="Actualizar">Actualizar</button>
            </form>
        </div>

        <div class="form-box">
            <h2>Añadir productos nuevos</h2>
            <form id="reg_prod" action="productos.php" method="POST">
                <input id="iName" type="text" name="iName" minlength="3" maxlength="50" placeholder="Nombre" required>
                <input id="iPrice" type="number" name="iPrice" step="0.01" min="0.5" max="100" placeholder="Precio" required>
                <input id="iMarca" type="text" name="iMarca" minlength="3" maxlength="50" placeholder="Marca" required>
                <label>Sección:</label>
                <select id="iSecc" name="iSecc">
                    <option value="1">Sección 1</option>
                    <option value="2">Sección 2</option>
                    <option value="3">Sección 3</option>
                    <option value="4">Sección 4</option>
                    <option value="5">Sección 5</option>
                    <option value="6">Sección 6</option>
                    <option value="Refri_1">Refrigerador 1</option>
                    <option value="Refri_2">Refrigerador 2</option>
                    <option value="Refri_3">Refrigerador 3</option>
                </select>
                <input type="number" name="iCantidad" placeholder="Cantidad">
                <button type="submit" name="Agregar">Agregar</button>
            </form>
        </div>
    </section>

    <section class="consulta">
        <div class="container4">
            <table id="consulta" name="consulta">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Marca</th>
                        <th>Sección</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $fila): ?>
                    <tr>
                        <td><?php echo $fila['ID_prod']; ?></td>
                        <td><?php echo $fila['nombre_pord']; ?></td>
                        <td><?php echo number_format($fila['prec_prod'], 2); ?></td>
                        <td><?php echo $fila['marc_prod']; ?></td>
                        <td><?php echo $fila['secc_prod']; ?></td>
                        <td><?php echo $fila['cant_prod']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#consulta').DataTable({
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar:",
                    lengthMenu: "&nbsp;",
                    info: "Mostrando del _START_ al _END_ de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de _MAX_ elementos)",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos.",
                    emptyTable: "No hay datos disponibles.",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último"
                    }
                }
            });
        });
    </script>
</body>

</html>

