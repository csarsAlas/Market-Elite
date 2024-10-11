<?php
include_once 'php/connection.php';

if(isset($_POST['Guardar'])){
    $insertar = $conn->prepare('INSERT INTO proveedores(nombre_prov, tel_prov, email) VALUES (:nombre, :telefono, :correo)');
    $insertar->bindParam(':nombre', $_POST['nombre']);
    $insertar->bindParam(':telefono', $_POST['telefono']);
    $insertar->bindParam(':correo', $_POST['correo']);
    $insertar->execute();
}

if(isset($_POST['Eliminar'])){
    $eliminar = $conn->prepare('DELETE FROM `proveedores` WHERE ID_prov=:idProv');
    $eliminar->bindParam(':idProv' ,$_POST['idProv']);
    $eliminar->execute();    
}

$query = $conn->prepare('SELECT * FROM proveedores');
$query->execute();
$registros = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-devide-width, initial-scale=1.0">
    <title>Abarrotes "FIME"</title>
    <link rel="stylesheet" href="css/estilos-proveedor.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dateTables.min.css">
</head>

<body>
    <header class="header">
       <h1>Market Elite</h1>
    </header>

    <section name="Inputs">
        <div class="container2">
            <h2>Eliminar proveedores</h2>
            <div class="form-container">
                <form id="elim_prov" method="POST">
                    <br>><br>
                    <label>ID del proveedor a eliminar: </label>
                    <input id="ieliprov" name="idProv" type="number" min="1" required>
                    <br><br>
                    <input id="boton" type="submit" name="Eliminar" value="Eliminar"><br>
                </form>
            </div>
        </div>
        <div class="container">
            <h2>Proveedor</h2> <br>
            <div class="form-container">
            <form id="prov" method="POST">
                <label for="nombre">Nombre del proveedor:</label>
                <input type="text" id="nombre" name="nombre" minlength="10" maxlength="100" required><br><br>
                <label for="tel">Telefono:</label>
                <input type="tel" id="tel" name="telefono" required pattern="[0-9]{3}[0-9]{3}([0-9]){4}"
                title="Solo se admiten numeros de teleddono de 10 digitos"> <br> <br>
                <label for="email">Correo Electronico: </label>
                <input type="email" id="email" name="correo"minlength="10"maxlength="100" required> <br> <br>
                <input id="Boton" type="submit" name="Guardar" value="Guardar">
            </form>
        </div>
</div>
    </section>
<aside class="aside">
    <ul>
        <li><a href="index.html">Inicio</a></li>
        <li><a href="productos.php">Agregar Producto</a></li>
        <li><a href="clientes.php">Agregar Cliente</a></li>
        <li><a href="proveedores.php">Agregar Proveedor</a></li>
        <li><a href="venta.php">Generar venta</a></li>
    </ul>
</aside>
<section name="Consulta">
    <div class="container 3">
        <table id="consulta" name="consulta">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo Electronico</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $fila): ?>
                <tr>
                    <td>
                        <?php echo $fila['ID_prov']; ?>
                    </td>
                    <td>
                        <?php echo $fila['nombre_prov']; ?>
                    </td> 
                    <td>
                        <?php echo $fila['tel_prov']; ?>
                    </td>
                    <td>
                        <?php echo $fila['email']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<section name="Scripts_JS">
    <!--En esta sección estan los scripts de JavaScripts utilizados en la Interfaz de proveedores-->
    <script src="js/script2.js"></script>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#consulta').DataTablet({
                language: {
                    processing: "Tratamiento en curso...",
                    search: "Buscar&nbsp;:",
                    lengthMenu: "&nbsp;",//Aqui esta puesto el valor de Non-breaking space para que no se despliegue en menu para modificar cuentos valores se 
                    info: "Mostrando del item_START_ al _END_ de un total de _TOTAL_ items",
                    infoEmpty: "No existen datos",
                    infoFiltered: "(filtado de _MAX_ elementos en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando...",
                    zeroRecords: "No se encontraron datos con tu busqueda",
                    emptyTablel: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Ultimo"
                    },
                    aria: {
                        sortAscending: ": active para la columna en orden ascendente",
                        sortDescending: ": active para la columna en orden descendente"
                    }
                },
                scrollY: 400,
                lengthMenu: [[10], [10]],//Complementando el valor anterior, aqui esta configurando para que por defecto se nos muestren solamente 10 elementos 
            });
        });
        </script>
    </section>
</body>

</html>
