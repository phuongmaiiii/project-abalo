<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajax 1</title>
</head>
<body>
    <h1 id="output">Nachricht wird geladen...</h1>
    <script>
        fetch('/api/message')
            .then(response => {
                if(!response.ok) throw new Error("Fehler beim Laden.");
                return response.json();
            })
            .then(data => {
                document.getElementById("output").textContent = data.message;
            })
            .catch(error => {
                document.getElementById("output").textContent = "Fehler: " + error.message;
            })
    </script>
</body>
</html>
