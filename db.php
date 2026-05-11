<?php
$conexion = new mysqli("localhost", "root", "", "cooperativa_escuela");
if ($conexion->connect_error) { die("Error: " . $conexion->connect_error); }
?>