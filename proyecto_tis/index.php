<?php
session_start();
if (isset($_SESSION['usuarios'])) {
    header("location: prueba.php");
}
?>

<?php include('header.php'); ?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div style="height:50px;">
        </div>
        <div class="row" id="loginform">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inicio de sesion
                            <span class="pull-right"> <a style="text-decoration:none; cursor:pointer; color:white;" id="signup">Registrarse</a></span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="logform">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Correo" name="correo" id="correo" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="contrasena" id="contrasena" type="password">
                                </div>
                                <button type="button" id="loginbutton" class="btn btn-lg btn-primary btn-block"><span id="logtext">Iniciar</span></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="signupform" style="display:none;">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Registrarse
                            <span class="pull-right"><a style="text-decoration:none; cursor:pointer; color:white;" id="login">Iniciar Sesion</a></span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="signform">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Correo" name="scorreo" id="scorreo" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nombre" name="snombre" id="snombre" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Id Organizacion" name="id_organizacion" id="id_organizacion" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="scontrasena" id="scontrasena" type="password">
                                </div>
                                <button type="button" id="signupbutton" class="btn btn-lg btn-primary btn-block"> <span id="signtext">Registrarse</span></button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="myalert" style="display:none;">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-info">

                </div>
            </div>
        </div>
    </div>
    <script src="java.js"></script>
</body>

</html>