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
			//feedback correo
			$header = "From: noreply@example.com" . "\r\n";
			$header .= "Reply-To: noreply@example.com" . "\r\n";
			$header .= "X-Mailer: PHP/" . phpversion();
			
			$mail = mail($correo, "|Registro de nuevo usuario|", "Se registro correctamente al usuario: '.$nombre.' '.$correo.' ", $header);
			//feedback correo FIN
		}
	}
?>