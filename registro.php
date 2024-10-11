<?php
include_once 'php/connection.php';

$total = 0;
$cantidad = 0;

$selecciona = $conn->prepare('SELECT * FROM ventas');
$selecciona->execute();
$query = $selecciona->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width=device-width, initial-scale=1.0">
        <title> Document</title>
        <link rel="stylesheet" href="css/estilos-registo.css">
    </head>
    <body>
        <header class="header">
            <h1>ABARROTES FIME</h1>
        </header>
        <aside class="aside">
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="productos.php">Agregar Producto</a></li>
                <li><a href="clientes.php">Agregar Cliente</a></li>
                <li><a href="proveedor.php">Agregar Proveedor</a></li>
                <li><a href="venta.php">Generar ticket</a></li>
                <li><a href="registro.php">Registro de ventas</a></li>
            </ul>
        </aside>

<div class="container-table">
    <table id="consulta" name="consulta">
        <thead>
            <tr>
                <th style="width: 25%;">ID venta </th>
                <th style="width: 25%;">Cantidad</th>
                <th style="width: 25%;">Total</th>
                <th style="width: 25%;">Fecha y hora </th>

            </tr>
        </thead>
    <tbody>
        <?php foreach ($query as $fila):

        $cantidad = $cantidad + $fila['cantidad'];
        $total=$total+$fila['total'];
        ?>
        <tr>
            <td style="text-align: center;">
            <?php echo $fila['id_venta']; ?>
        </td>
            <td style="text-align: center;">
            <?php echo $fila['cantidad']; ?>
        </td> 
            <td style="text-align: center;">
            <?php echo $fila['total']; ?>
        </td> 
            <td style="text-align: center;">
            <?php echo $fila['fechaHora']; ?>
        </td> 
    </tr>
        <?php endforeach;   ?>
    </tbody>
</table>
    <h1>Total: $<?php echo $total ?></h1>
    <h2>Cantidad de productos vendidos: <?php echo $cantidad ?></h2>
</body>
</html>