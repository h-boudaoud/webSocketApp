<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script>
        var conn = new WebSocket('ws://127.0.0.1:3001');
        conn.onopen = function(e) {
            console.log("Connection established!");
            conn.send('Hello World!');
        };

        conn.onmessage = function(e) {
            console.log(e.data);
        };
    </script>
</head>
<body>

</body>
</html>