<?php
	session_start();
	include('conexion.php');

	$query=$conexion->query("select * from usuarios where id='".$_SESSION['usuarios']."'");
	$row=$query->fetch_array();

	$usuarios=$row['correo'];
?>