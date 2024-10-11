<?php
include_once 'php/connection.php';

$totalPrecio = 0;
$contador = 0;

if(isset($_POST['buscar'])){
	$buscar = $conn->prepare('SELECT * FROM `producto` WHERE ID_prod=:id_bus');
	$buscar->bindParam(':id_bus', $_POST['id_bus']);
	$buscar->execute();
	$query = $buscar->fetchAll(PDO::FETCH_ASSOC);


foreach($query as $reslt){
	$id_prod = $reslt['ID_prod'];
	$nombre = $reslt['nombre_pord'];
	$Precio = $reslt['prec_prod'];
	$marca = $reslt['marc_prod'];
}
}

if (isset($_POST['carrito'])) {
    // Verificación de datos
    if (empty($_POST['id_prod']) || empty($_POST['cantidad']) || empty($_POST['id_cliente']) || 
        empty($_POST['nombre']) || empty($_POST['precio'])) {
        die('Error: Todos los campos del formulario deben estar completos.');
    }

    $id_prod = $_POST['id_prod'];
    $cantidad = $_POST['cantidad'];
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];

    try {
        // Comienza una transacción
        $conn->beginTransaction();

        // Seleccionar producto del inventario
        $inventario = $conn->prepare('SELECT * FROM producto WHERE ID_prod = :id_prod');
        $inventario->bindParam(':id_prod', $id_prod, PDO::PARAM_INT);
        $inventario->execute();
        $traer = $inventario->fetch(PDO::FETCH_ASSOC);

        if ($traer) {
            $disminuir = $traer['cant_prod'] - $cantidad;

            // Actualizar cantidad de producto en inventario
            $actua = $conn->prepare('UPDATE producto SET cant_prod = :disminucion WHERE ID_prod = :id_prod');
            $actua->bindParam(':id_prod', $id_prod, PDO::PARAM_INT);
            $actua->bindParam(':disminucion', $disminuir, PDO::PARAM_INT);
            $actua->execute();

            // Insertar en carrito
            $insertar = $conn->prepare('INSERT INTO carrito (id_cliente, id_producto, nombre, cantidad, precio) VALUES (:id_cliente, :id_producto, :nombre, :cantidad, :precio)');
            $insertar->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $insertar->bindParam(':id_producto', $id_prod, PDO::PARAM_INT);
            $insertar->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $insertar->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $insertar->bindParam(':precio', $precio, PDO::PARAM_STR);
            $insertar->execute();

            // Confirma la transacción
            $conn->commit();
        } else {
            // En caso de que no se encuentre el producto
            $conn->rollBack();
            die('Error: Producto no encontrado.');
        }
    } catch (PDOException $e) {
        // Manejo de errores y reversión de la transacción
        $conn->rollBack();
        die('Error: ' . $e->getMessage());
    }
}

if (isset($_POST['eliminar'])) {
    $inventario = $conn->prepare('SELECT * FROM producto WHERE ID_prod=:id_prod');
    $inventario->bindParam(':id_prod', $_POST['id_producto']);
    $inventario->execute();
    $traer = $inventario->fetchAll(PDO::FETCH_ASSOC);

    foreach ($traer as $quitar) {
        $aumentar = $quitar['cant_prod'] + $_POST['cantidad'];
    }

    // Verificar si $aumentar tiene un valor válido
    if (isset($aumentar)) {
        $actua = $conn->prepare('UPDATE producto SET `cant_prod`=:aumento WHERE ID_prod=:id_prod');
        $actua->bindParam(':id_prod', $_POST['id_producto']);
        $actua->bindParam(':aumento', $aumentar);
        $actua->execute();
    }

    $eliminar = $conn->prepare('DELETE FROM `carrito` WHERE id_carrito=:id_carrito');
    $eliminar->bindParam(':id_carrito', $_POST['id_carrito']);
    $eliminar->execute();
}


if(isset($_POST['confirmar'])){
    date_default_timezone_set('America/Mexico_City');
    $fechaActual = date('Y/m/d H:i:s'); // Formato de fecha corregido
    if(isset($_POST['cantidad_confirmacion']) && isset($_POST['total_confirmacion'])) {
        $insertar = $conn->prepare('INSERT INTO `ventas` (cantidad, total, fechaHora) VALUES (:cantidad, :total, :fechaHora)');
        $insertar->bindParam(':cantidad', $_POST['cantidad_confirmacion']);
        $insertar->bindParam(':total', $_POST['total_confirmacion']);
        $insertar->bindParam(':fechaHora', $fechaActual);
        $insertar->execute();
        $mensaje = 'Compra exitosa';
        $contador = isset($contador) ? $contador + 1 : 1; // Incrementar correctamente el contador
    } else {
        $mensaje = 'Faltan datos de confirmación';
    }
}

if(isset($_POST['vaciar'])){
    if(isset($contador) && $contador > 0){
        $eliminar = $conn->prepare('DELETE FROM carrito');
        $eliminar->execute();
    } else {
        $mensajeVaciar = 'Concreta la venta o elimina uno por uno';
    }
}

$query = $conn->prepare('SELECT * FROM carrito WHERE 1');
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Abarrotes FIME</title>
	<link rel="stylesheet" href="css/estilos-ticket.css">	
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
			<li><a href="registro.php">Registro de ventas</a></li>
		</ul>
	</aside>
	    <h3>Datos de la compra</h3>
	<div class="container">
		<div>
			<form method="POST" action="venta.php" id="frmVentasProductos">
			<label>ID del producto </label>
			<input type="number" min="1" name="id_bus" value="id_bus"></input>
			<button type="submit" name="buscar" value="buscar" >Buscar</button>
			</form>
		</div>
	    <h1>Producto:</h1>
		<p>Nombre: <?php error_reporting (0); echo $nombre; ?></p>
        <p>Precio: $<?php error_reporting(0); echo number_format($Precio,0); ?></p>
		<p>Marca: <?php error_reporting(0); echo $marca; ?></p>
		<form action="venta.php" method="POST">
			<label for="">Ingrese ID del cliente</label>
			<input type="number" placeholder="Id del cliente" name="id_cliente" required>

			<input type="hidden" name="id_prod" value="<?php echo $id_prod ?>">

			<input type="hidden" name="nombre" value="<?php echo $nombre; ?>">

			<label for="">Cantidad</label>
			<input type="number" value="" name="cantidad">

			<input type="hidden" name="precio" value="<?php echo $Precio; ?>">

			<button type="submit" name="carrito" value="carrito" >Agregar Al carrito</button>
		</form>
	</div>

	<div class="container_table">
		<table id="consulta" name="consulta">
			<thead>
				<tr>
					<th width=16%>#</th>
					<th width=16%>ID cliente</th>
					<th width=16%>ID producto</th>
					<th width=16%>Producto</th>
					<th width=16%>Cantidad</th>
					<th width=16%>Precio</th>
				</tr>
</thead>
<tbody>
	<?php foreach ($res as $fila):
	           
	    $cantidad = $cantidad + $fila['cantidad'];
	$totalPre=$fila['precio']*$fila['cantidad'];
	$total = $total + $totalPre;
	?>
	<tr>
		<td style="text-align: center;">
	        <?php echo $fila['id_carrito']; ?>
		</td>
		<td style="text-align: center;">
		    <?php echo $fila['id_cliente']; ?>
		</td>
		<td style="text-align: center;">
		    <?php echo $fila['id_producto']; ?>
		</td>
		<td style="text-align: center;">
		    <?php echo $fila['nombre']; ?>
		</td>
		<td style="text-align: center;">
		    <?php echo $fila['cantidad']; ?>
		</td>
		<td style="text-align: center;">
		    <?php echo number_format($fila['precio']); ?>
		</td>
		<form method="POST" action="venta.php">
            <input type="hidden" name="id_carrito" value="<?php echo $fila['id_carrito']; ?>" >
			<input type="hidden" name="id_producto" value="<?php echo $fila['id_producto']; ?>" >
            <input type="hidden" name="id_cantidad" value="<?php echo $fila['cantidad']; ?>" >
			<td><button type="submit" name="eliminar" >Eliminar</button></td>
		</form>
	</tr>
	<?php endforeach; ?>
    </tbody>
		</table>
		<h3 style="text-align: right;">Total de productos: <?php echo $cantidad; ?></h3>
		<h3 style="text-align: right;">Total del carrito: <?php echo $total; ?></h3>
		<form action="venta.php" method="POST">
		<input type="hidden" name="cantidad_confirmacion" value="<?php echo $cantidad; ?>" >
		<input type="hidden" name="total_confirmacion" value="<?php echo $total; ?>" >
		<button type="submit" name="confirmar" value="confirmar" >Confirmar compra</button>
		</form>
		<h1><?php echo $mensaje; ?></h1>
		<h1><?php echo $mensajeVaciar; ?></h1>
		<form action="venta.php" method="post">
		<button type="submit" name="vaciar"  >Vaciar carrito</button>
		</form>

		</div>
	<script src="js/script4.js"></script>
	<script src="js/jquery-3.6.1.min.js"></script>


</body>
</html>




