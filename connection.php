<?php
    $nombreServidor = "localhost";
	$usuario = "root";
	$contraseña = "";
	$nombreBaseDatos = "Abfime";
	try{
		$conn = new PDO ("mysql:hosto=$nombreServidor;dbname=$nombreBaseDatos", $usuario,$contraseña);
		echo "<script>console.log('Conexion exitosa en el servidor $nombreServidor')</script>";
	}catch (Exception $e){
		echo"<script>console.log('Error en la conexion $e')</script>";
	}
?>