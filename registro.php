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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilos-registo.css">
</head>
<body>
    <header class="header">
        <h1>Market Elite</h1>
    </header>
    <aside class="aside">
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="productos.php">Agregar Producto</a></li>
            <li><a href="clientes.php">Agregar Cliente</a></li>
            <li><a href="proveedor.php">Agregar Proveedor</a></li>
            <li><a href="venta.php">Generar Ticket</a></li>
            <li><a href="registro.php">Registro de Ventas</a></li>
        </ul>
    </aside>

    <div class="container-table">
        <table id="consulta" name="consulta">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $cantidad = 0; // Inicializar variables
                $total = 0; 
                foreach ($query as $fila): 
                    $cantidad += $fila['cantidad'];
                    $total += $fila['total'];
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $fila['id_venta']; ?></td>
                    <td style="text-align: center;"><?php echo $fila['cantidad']; ?></td>
                    <td style="text-align: center;"><?php echo $fila['total']; ?></td>
                    <td style="text-align: center;"><?php echo $fila['fechaHora']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="totals">
            <h1>Total: $<?php echo number_format($total, 2); ?></h1>
            <h2>Cantidad de Productos Vendidos: <?php echo $cantidad; ?></h2>
        </div>
    </div>
</body>
</html>
