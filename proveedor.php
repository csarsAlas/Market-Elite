<?php
include_once 'php/connection.php';

if (isset($_POST['Guardar'])) {
    $insertar = $conn->prepare('INSERT INTO proveedores(nombre_prov, tel_prov, email) VALUES (:nombre, :telefono, :correo)');
    $insertar->bindParam(':nombre', $_POST['nombre']);
    $insertar->bindParam(':telefono', $_POST['telefono']);
    $insertar->bindParam(':correo', $_POST['correo']);
    $insertar->execute();
}

if (isset($_POST['Eliminar'])) {
    $eliminar = $conn->prepare('DELETE FROM `proveedores` WHERE ID_prov=:idProv');
    $eliminar->bindParam(':idProv', $_POST['idProv']);
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
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
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
                    <br><br>
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
                    <label for="tel">Teléfono:</label>
                    <input type="tel" id="tel" name="telefono" required pattern="[0-9]{10}"
                        title="Solo se admiten números de teléfono de 10 dígitos"> <br><br>
                    <label for="email">Correo Electrónico: </label>
                    <input type="email" id="email" name="correo" minlength="10" maxlength="100" required> <br><br>
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
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $fila): ?>
                    <tr>
                        <td><?php echo $fila['ID_prov']; ?></td>
                        <td><?php echo $fila['nombre_prov']; ?></td>
                        <td><?php echo $fila['tel_prov']; ?></td>
                        <td><?php echo $fila['email']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section name="Scripts_JS">
        <script src="js/script2.js"></script>
        <script src="js/jquery-3.6.1.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>

        <script>
            // Validación en tiempo real para el campo de nombre (solo letras y espacios)
            document.getElementById('nombre').addEventListener('input', function (e) {
                const valor = e.target.value;
                e.target.value = valor.replace(/[^A-Za-z\s]/g, ''); // Elimina números y caracteres especiales
            });

            // Validación en tiempo real para el campo de teléfono (solo números)
            document.getElementById('tel').addEventListener('input', function (e) {
                const valor = e.target.value;
                e.target.value = valor.replace(/\D/g, ''); // Elimina todo lo que no sea dígito
            });

            $(document).ready(function () {
                $('#consulta').DataTable({
                    language: {
                        processing: "Tratamiento en curso...",
                        search: "Buscar&nbsp;:",
                        lengthMenu: "&nbsp;",
                        info: "Mostrando del _START_ al _END_ de un total de _TOTAL_ elementos",
                        infoEmpty: "No existen datos",
                        infoFiltered: "(filtrado de _MAX_ elementos en total)",
                        loadingRecords: "Cargando...",
                        zeroRecords: "No se encontraron datos con tu búsqueda",
                        emptyTable: "No hay datos disponibles en la tabla.",
                        paginate: {
                            first: "Primero",
                            previous: "Anterior",
                            next: "Siguiente",
                            last: "Último"
                        },
                        aria: {
                            sortAscending: ": activar para ordenar la columna en orden ascendente",
                            sortDescending: ": activar para ordenar la columna en orden descendente"
                        }
                    },
                    scrollY: 400,
                    lengthMenu: [[10], [10]],
                });
            });
        </script>
    </section>
</body>

</html>
