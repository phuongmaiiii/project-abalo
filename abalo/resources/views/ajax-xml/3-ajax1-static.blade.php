<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajax 1</title>

</head>
<body>
    <h1 id="output">Lade Nachricht...</h1>
    <script>
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "/static/message.json", true);
        xhr.onload = function () {
            if(xhr.status === 200){
                const response = JSON.parse(xhr.responseText);
                document.getElementById("output").textContent = response.message;
            } else {
                document.getElementById("output").textContent = "Fehler beim Laden der Nachricht";
            }
        };
        xhr.onerror = function () {
            document.getElementById("output").textContent = "Netzwerkfehler";
        }

        xhr.send();
    </script>
</body>
</html>
