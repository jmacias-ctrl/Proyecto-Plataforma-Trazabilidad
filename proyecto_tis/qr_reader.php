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
                        <h3 class="panel-title">Leer código QR
                            <span class="pull-right"> <a style="text-decoration:none; cursor:pointer; color:white;" href="index.php">Volver</a></span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <input type="file" id="file">
                        <span id="content"></span>
                        <script type="text/javascript" src="qrReader.js"></script>
                    </div>
                </div>
            </div>
        </div>

        
    <script src="java.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
  
        var span= document.getElementById('content')
 
        span.addEventListener("DOMSubtreeModified", function(event) {
        var spantext= document.getElementById('content').innerHTML;
        console.log('testing '+ spantext);
        console.log('complete ');
        window.location.href='//'+spantext;
    })

</script>

</body>

</html>