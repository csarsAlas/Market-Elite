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
    <meta charset="ITF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <title>MARKET Elite</title>
    <link rel="stylesheet" type="text/css" href="css/estilos-productos.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
</head>

<body>
    <header class="header">
        <h1>Market Elite</h1>
    </header>
    <!--Aqui estan los formularios para modificar la tabla 'productos'-->
    <section name="Inputs">
        <div class="container">
            <h2 style="text-align: center;">Eliminar productos</h2>
            <div class="form-container">
                <!--Este formulario nos borra productos-->
                <form id="elim_prod" method="POST">
                    <br><br>
                    <label>ID del producto a eliminar:</label>
                    <input id="Elim" name="iElim" type="number" min="1" required>
                    
                    <br><br>
                    <input id="Boton" type="submit" name="eliminar" values="Eliminar"><br>
                </form>
            </div>
        </div>
        <div class="container3">
            <h2 style="text-align: center;">Agregar existencia de productos</h2>
            <div class="form-container">
                <!--Agrega las existencuas nuevas al producto del ID solicitada-->
                <form id="cant_prod"method="POST">

                <label>ID del producto a actualizar existencia: </label>
                <input id="iProd" name="iProd" type="number"
                min="1" required>
                <br><br>
                <label>Cantidad a ingresar: </label>
                <input id="iNewQuan" name="iNewQuan" type="number" min="1"
                max="50"required><br><br>
                <input id="Boton" type="submit" name="Actualizar" value="Actualizar"><br>
            </form>
        </div>
    </div>
      <div class="container2">
        <h2 style="text-align: center;">Añadir productos nuevos</h2>
        <div class="form-container">
            <form id="reg_prod" action="productos.php"method="POST">
                <input id="iName" type="text" name="iName" minlength="3" maxlength="50" placeholder="Nombre"
                required>
                <br><br>
                <input id="iPrice" type="number" name="iPrice" step="0.01" min="0.5" max="100" lang="en"
                placeholder="Precio"required>
                <br><br>
                <input id="iMarca" type="text" name="iMarca" minlength="3" maxlength="50" placeholder="Marca"
                required>
                <br><br>
                <h5 class="Sec"
                    <label>Seccion:</label>
                    <select id="iSecc" name="iSecc">
                        <option value="1">Seccion 1</option>
                        <option value="2">Seccion 2</option>
                        <option value="3">Seccion 3</option>
                        <option value="4">Seccion 4</option>
                        <option value="5">Seccion 5</option>
                        <option value="6">Seccion 6</option>
                        <option value="Refri_1">Refrigerador 1</option>
                        <option value="Refri_2">Refrigerador 2</option>
                        <option value="Refri_3">Refrigerador 3</option>
                    </select>
                </h5><br>
                <input type="number" name="iCantidad" placeholder="Cantidad">
                <input id="Boton" type="submit" name="Agregar" value="Agregar"><br>
            </form> 
        </div>
      </div>
    </section>
    <aside class="aside">
       <ul>
        <li><a href="index.html">Inicio</a></li>
        <li><a href="productos.php">Agregar Producto</a></li>
        <li><a href="clientes.php">Agregar Cliente</a></li>
        <li><a href="proveedor.php">Agregar Proveedor</a></li>
        <li><a href="venta.php">Generar venta</a></li>
    </ul> 
    </aside>
    <!--Tabla configura e imprimiendo los datos de la tabla 'productos'-->
    <section name="Consulta">
        <div class="container4">
            <table id="consulta" name="consulta">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Marca</th>
                        <th>Seccion</th>
                        <th>Cantidad</th>
                    </tr>
                </thead> 
                    <tbody>
                        <?php foreach ($registros as $fila): ?>
                        <?php $cantidad =$cantidad + 1 ?>
                        <tr>
                           <td>
                            <?php echo $fila['ID_prod']; ?>
                           </td> 
                          <td>
                           <?php echo $fila['nombre_pord']; ?>
                          </td>
                          <td> 
                            <?php echo number_format($fila['prec_prod'], 2); ?>
                          </td>
                          <td>
                          <?php echo $fila['marc_prod']; ?>
                          </td>
                          <td>
                          <?php echo $fila['secc_prod']; ?>
                          </td>
                          <td>
                          <?php echo $fila['cant_prod']; ?>
                        </td>
                          </tr>
                          <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
    </section>
    <section name="Scripts_JS"> 
        <!--En esta seccion estan los scripts de JavaScripts utilizados en la interfaz de productos-->
        <script scr="js/script1.js"></script>
        <script scr="js/jquery-3.6.1.min.js"></script>
        <script scr="js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#consulta').DataTable({
                    language: {
                        processing: "Tratamiento en curso...",
                        search: "Buscar&nbsp;:",
                        lengthMenu: "&nbsp;",//Aqui esta puesto el valor de Non-breaking space para que no se despliegue un menu para modificar cuantos
                        info: "Mostrando del item_START_ al _END_ de un total de _TOTAL_ items",
                        infoEmpty: "No existen datos.",
                        infoFiltered: "(filtrado de _MAX_ elementos en total)",
                        infoPostFix: "",
                        loadingRecords: "Cargando...",
                        zeroRecords: "No se encontraron datos con tu busqueda",
                        emptyTable: "No hay datos disponibles en la table.",
                        paginate: {
                            first: "Primero",
                            previous: "Anterior",
                            next: "Siguiente",
                            last: "Ultimo"
                        },
                        aria: {
                            sortAscemding: ":active para ordenar la columna en orden ascendente",
                            sortDescending: ":active para ordenar la columna en orden descendente",
                        }
                    },
                    scrollY: 400,
                    lengthMenu: [[10]], [[10]],//Complementando el valor anterior, aqui esta configurado para que por defecto se nos muestren solamente 10 elementos
                });
            });
            </script>
            </section>
</body>

</html>

