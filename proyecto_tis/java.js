$(document).ready(function(){
	
	$(document).keypress(function(e){
    	if (e.which == 13){
    		if($('#loginform').is(":visible")){
    			$("#loginbutton").click();
    		}
        	else if($('#signupform').is(":visible")){
        		$("#signupbutton").click();
        	}
    	}
	});

	$('#signup').click(function(){
		$('#loginform').slideUp();
		$('#signupform').slideDown();
		$('#myalert').slideUp();
		$('#signform')[0].reset();
	});

	$('#login').click(function(){
		$('#loginform').slideDown();
		$('#signupform').slideUp();
		$('#myalert').slideUp();
		$('#logform')[0].reset();
	});

	$(document).on('click', '#signupbutton', function(){
		if($('#scorreo').val()!='' && $('#scontrasena').val()!=''){
			$('#signtext').text('Registrarse');
			$('#myalert').slideUp();
			var signform = $('#signform').serialize();
			$.ajax({
				method: 'POST',
				url: 'registrarse.php',
				data: signform,
				success:function(data){
					setTimeout(function(){
					$('#myalert').slideDown();
					$('#alerttext').html(data);
					$('#signtext').text('Registrarse');
					$('#signform')[0].reset();
					}, 2000);
				} 
			});
		}
		else{
			alert('Faltan datos');
		}
	});

	$(document).on('click', '#loginbutton', function(){
		if($('#correo').val()!='' && $('#contrasena').val()!=''){
			$('#logtext').text('Iniciando');
			$('#myalert').slideUp();
			var logform = $('#logform').serialize();
			setTimeout(function(){
				$.ajax({
					method: 'POST',
					url: 'inicio.php',
					data: logform,
					success:function(data){
						if(data!=-1){
							$('#myalert').slideDown();
							$('#alerttext').text('Sesion iniciada');
							$('#logtext').text('Iniciar');
							$('#logform')[0].reset();
							setTimeout(function(){
								window.location.reload(true);
							}, 1000);
						}
						else{
							$('#myalert').slideDown();
							$('#alerttext').html(data);
							$('#logtext').text('Iniciar');
							$('#logform')[0].reset();
						}
					} 
				});
			}, 2000);
		}
		else{
			alert('Faltan datos');
		}
	});
});