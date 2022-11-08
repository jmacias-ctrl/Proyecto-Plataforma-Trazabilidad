<?php
	include('conexion.php');
	if(isset($_POST['scorreo'])){
		$correo=$_POST['scorreo'];
		$contrasena=$_POST['scontrasena'];
		$id_organizacion=$_POST['id_organizacion'];
		$nombre=$_POST['snombre'];

		$query=$conexion->query("select * from usuarios where correo='$correo'");

		if ($query->num_rows>0){
			?>
  				<span>Usuario ya registrado.</span>
  			<?php 
		}

		
		else{
			$mcontrasena=md5($contrasena);
			$conexion->query("insert into usuarios (correo, contrasena, id_organizacion, nombre) values ('$correo', '$mcontrasena', '$id_organizacion','$nombre')");
			?>
  				<span>Registro exitoso.</span>
  			<?php 
		}
	}
?>