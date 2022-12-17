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

        <div style="height:50px;"></div>

        <center>
            <img style="width:300px" src="view\public\images\heritech\ht_logo.png" alt="a">
            <h1>Ingreso sistema gestor de equipos</h1>
            <hr>
            <br>
        </center>

        <div class="row" id="loginform">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inicio de sesión </h3>
                        <br>
                        <span class="pull-right"> <a class="btn btn-light" id="signup">Registrarse</a></span>
                        <span class="pull-center"> <a class="btn btn-light" href="qr_reader.php">Leer QR</a></span>
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
                        <h3 class="panel-title"> Registrarse </h3>
                        <br>
                        <span class="pull-center"> <a class="btn btn-light" style="visibility:hidden" href="qr_reader.php">Leer QR</a></span>
                        <span class="pull-right"><a class="btn btn-light" id="login">Iniciar Sesión</a></span>
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
                                    <input class="form-control" placeholder="Id Organización" name="id_organizacion" id="id_organizacion" type="text" autofocus>
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

        <p class="text-center">© 2022 HT. Todos los derechos reservados</p>

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