<?php
include('php/connection.php');

$deuda =(isset($_POST['deuda']))?$_POST['deuda']:0;
$check =(isset($_POST['check']))?$_POST['check']:0;
$descuento = 0;

if(isset($_POST['Guardar'])){
    $sentencia = $conn->prepare('INSERT INTO cliente(nombre_cli, cel_cli, fia_cli, cantf_cli) VALUES (:nombre,:cel,:fiado,:cantidad)');
    $sentencia->bindParam(':nombre', $_POST['nombre']);
    $sentencia->bindParam(':cel', $_POST['tel']);
    $sentencia->bindParam(':fiado',$check);
    $sentencia->bindParam('cantidad',$deuda);
    $sentencia->execute();
}

if(isset($_POST['Buscar'])){
    $sentencia = $conn->prepare('SELECT cantf_cli FROM cliente WHERE ID_cli=:iDclie');
    $sentencia->bindParam('iDclie',$POST['iDclie']);
    $sentencia->execute();
    $cliente = $sentencia->fetchALL(PDO::FETCH_ASSOC);

    foreach($cliente as $op){
        $descuento = $op['cantf_cli'];
    }
    $descuento2 =$_POST['mov'];
    $resta = $descuento2 + $descuento;
    $estatus = 0;
    $estatus2 =1;
    if($resta==0){
        $actualizar = $conn->prepare('UPDATE cliente SET fia_cli=:fia_cli, cant_cli=descuento WHERE ID_cli=:iDclie');
        $actualizar->bindParam(':iDclie',$_POST['iDclie']);
        $actualizar->bienParam('fia_cli', $estatus);
        $actualizar->bindParam(':descuento',$resta);
        $actualizar->execute();
    }else{
        $actualizar = $conn->prepare('UPDATE cliente SET fia_cli=:fia_cli, cantf_cli=:descuento WHERE ID_cli=:iDclie');
        $actualizar->bindParam(':iDclie',$_POST['iDclie']);
        $actualizar->bindParam('fia_cli', $estautus2);
        $actualizar->bindParam(':descuento',$resta);
        $actualizar->execute();
    }
}

if(isset($_POST['eliminar'])){
    $eliminar = $conn->prepare('DELETE FROM `cliente` WHERE ID_cli=:iDclie');
    $eliminar->bindParam('iDclie',$_POST['idclie']);
    $eliminar->execute();
}

$cantidad = 0;
$query =$conn->prepare('SELECT * FROM cliente WHERE 1');
$query->execute();
$registros = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Elite</title>
    <link rel="stylesheet" type="text/css" href="css/estilos-clientes.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <script type="text/javascript">
        function showContent(){
            element = document.getElementById("content");
            check = document.getElementById("check");
            if (check.checked) {
                element.style.display = 'block';
            }
            else {
                element.style.display = 'none';
            }
        }
        </script>
</head>

<body>
    <header class="header">
        <h1>Market Elite</h1>
    </header>

    <div class="container3">
        <h2>Eliminar cliente</h2>
        <div class="form-container">
            <form id="eli_cli" name="eli_cli" action="clientes.php" method="POST">
                <br><br>
                <label>ID del cliente: </label>
                <input id="idclie" name="idclie" type="number" min="1" requerid>
                <br><br>
                <input id="Boton" type="submit" name="eliminar" value="eliminar" value="eliminar"><br>
            </form>
        </div>
    </div>

    <div class="container2">
        <h2>Movimientos</h2>
        <div class="form-container">
            <form id="iDclie" name="mov_cli" action="clientes.php" method="POST">
                <br><br>
                <label>ID del cliente: </label>
                <input id="iDclie" name="iDclie" type="number" min="1"requerid>
                <br><br>
                <label>Abonar o Aumentar deuda 
                    <input type="number" name="mov" id="mov">
                </label>
                <br><br>
                <input id="Boton" type="submit" name="Buscar" value="Buscar"><br>
            </form>
        </div>
    </div>

    <div class="container">
        <h2>Clientes</h2> <br>
        <div class="form">
            <form id="cliente" name="cliente" action="clientes.php" method="POST">
                <label for="nombre">Nombre:</label>
                <<input type="text" name="nombre" id="nombre" minlength="4" maxlength="50" required><br><br>
                <label for="tel">Telefono:</label>
                <input type="tel" name="tel" id="tel"required="[0-9]{3}[0-9]{3}([0-9]){4}"
                     title="solo se admiten numeros de telefono de 10 digitos"><br><br>
                <label for="">Fiado</label>
                <input type="checkbox" name="check" id="check" value="1" onchange="javascript:showContent()"><br><br>
                <div id="content" style="display: none;">
                    <label for="">Cantidad de fiado: </label>
                    <input type="number" name="deuda" id="deuda" min="1"><br><br>
                </div>
                <input type="submit" name="Guardar" id="Boton" value="Guardar">
            </form>
        </div>
    </div>


    <aside class="aside">
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="productos.php">Agregar Producto</a></li>
            <li><a href="clientes.php">Agregar Clientes</a></li>
            <li><a href="proveedor.php">Agregar Proveedor</a></li>
            <li><a href="venta.php">Generar venta</a></li>
        </ul>
    </aside>

    <div class="container-tabla">
        <table id="consulta" name="consulta">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Fiado(1 es si, 0 es no)</th>
                    <th>Deuda</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $fila): ?>
                <?php $cantidad = $cantidad + 1 ?>
                <tr>
                    <td>
                        <?php echo $fila['ID_cli']; ?>
                    </td>
                    <td>
                        <?php echo $fila['nombre_cli']; ?>
                    </td>
                    <td>
                        <?php echo $fila['cel_cli']; ?>
                    </td>
                    <td>
                        <?php echo $fila['fia_cli']; ?>
                    </td>
                    <td>
                        <?php echo number_format($fila['cantf_cli'], 2); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <section name="Scripts_JS">

    <script src="js/script3.js"></script>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#consulta').DataTable({
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar&nbsp;:",
                    lengthMenu: "&nbsp;:",//Aqui esta el puesto el valor de Non-breaking space para que no se despliegue menu para modificar cuando //
                    info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos.",
                    infoFiltered: "(filtrado de MAX elementos en total)",
                    infoPostFix:"",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
                    emptyTable: "No hay datos disponibles en la tabla",
                    paginete: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo"
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
                scrollY: 400,
                lengthMenu:[[10],[10]],//Complementando el valor anterior, aqui esta configurado para que por defecto se
            });
        });
        </script>
    </section>
</body>

</html>