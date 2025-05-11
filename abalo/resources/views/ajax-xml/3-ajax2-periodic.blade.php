<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>AJAX Zyklisch</title>
</head>
<body>
<h1 id="output">Lade Nachricht...</h1>

<script>
    function fetchMessage() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '/static/message.json', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                document.getElementById('output').innerText = response.message;
            } else {
                document.getElementById('output').innerText = 'Fehler beim Laden der Nachricht';
            }
        };

        xhr.onerror = function() {
            document.getElementById('output').innerText = 'Netzwerkfehler';
        };

        xhr.send();
    }

    // Initialer Aufruf und dann alle 3 Sekunden wiederholen
    fetchMessage();
    setInterval(fetchMessage, 3000);
</script>
</body>
</html>
