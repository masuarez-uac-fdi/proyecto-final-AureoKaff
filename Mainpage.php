<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <script src = "//code.jquery.com/jquery-1.12.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Cisco Networking Academy - login</title>
    <style>
        * {
            font-family: 'Cisco Sans'; 
        }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin: 0px; border: 0%; padding: 0%;">Cisco</h2>
        <h3 style="margin: 0px; border: 0%; padding: 0%;">Networking Academy Builds IT Skills & Education for future Careers</h3>
    </div>
    <section>
        <div style="display: flexbox; flex-direction: row;" id="login-singupINFO">
            <h1>¿Quién desea usar Cisco?</h1>
            <div>
                <button id="Docente" name="doclog.txt" class="Button">Docente</button>
                <button id="Alumno" name="alumlog.txt" class="Button">Alumno</button>
            </div>
        </div>
        
    </section>
    <script type="text/javascript">
        var n ="";
        $("#login-singupINFO").on('click', ".Button",function(){
        n = $(this).attr('name');
        ajaxRequest(n);
        });
        function ajaxRequest(n){
            var refresh =n;
            var ajaxrq = new XMLHttpRequest();
            ajaxrq.onreadystatechange = function(){
                if(ajaxrq.readyState == 4 && ajaxrq.status == 200){
                    document.getElementById("login-singupINFO").innerHTML = ajaxrq.responseText;
                }
            }
            ajaxrq.open("GET",refresh,true);
            ajaxrq.send();
        }
    </script>
</body>
</html>