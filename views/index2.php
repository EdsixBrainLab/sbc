<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Maintenance</title>

        <style>
            body {
                width:500px;
                margin:0 auto;
                text-align: center;
                color:blue;
            }
        </style>
    </head>

    <body>

        <img src="http://schools.skillangels.com/assets/images/sklogo-web.png">

        <h1><p>We are upgrading new features... </p>
            <p>Please revisit shortly</p>
        </h1>
        <div></div>

        

    </body>
</html>
<?php
header('HTTP/1.1 503 Service Temporarily Unavailable');
header('Status: 503 Service Temporarily Unavailable');
header('Retry-After: 3600');
?>