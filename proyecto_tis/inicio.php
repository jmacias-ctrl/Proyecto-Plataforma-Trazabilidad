<?php 
	include('conexion.php');
	session_start();
	if(isset($_POST['correo'])){
		$correo=$_POST['correo'];
		$contrasena=md5($_POST['contrasena']);

		$query=$conexion->query("select * from usuarios where correo='$correo' and contrasena='$contrasena'");

		if ($query->num_rows>0){
			$row=$query->fetch_array();
			$_SESSION['usuarios']=$row['id'];
			$_SESSION['id_organizacion']=$row['id_organizacion'];
		}
		else{
			echo -1;
		}
	}
?>