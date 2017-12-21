<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>出勤退勤画面</title>
        <style>
            #app {
                width: 100vw;
                height: 100vh;
            }
        </style>
        <link rel="stylesheet" href="css/app.css"/>
    </head>
    <body>
        <div id="app">
            <admin></admin>
        </div>
        <script src="js/app.js"></script>
    </body>
</html>