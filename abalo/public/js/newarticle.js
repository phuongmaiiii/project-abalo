document.addEventListener("DOMContentLoaded", function (){
    //Formular erzeugen
    const form = document.createElement('form');
    form.method = "POST";
    //form.action ="/articles";
    form.id = "aritcleForm";

    //CSRF-Tocken - braucht für Sicherheit
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const csrfInput = document.createElement("input");
    csrfInput.type = "hidden";
    csrfInput.name = "_token";
    csrfInput.value = csrf;
    form.appendChild(csrfInput);

    //Name
    const nameLabel = document.createElement("label");
    nameLabel.textContent = "Artikelname *:";
    const nameInput = document.createElement("input");
    nameInput.type = "text";
    nameInput.name = "name";
    nameInput.id = "name";
    nameInput.required = true;
    form.appendChild(nameLabel);
    form.appendChild(nameInput);

    form.appendChild(document.createElement("br"));

    //Price
    const priceLabel = document.createElement("label");
    priceLabel.textContent="Preis (€) *:";
    const priceInput=document.createElement("input");
    priceInput.type = "number";
    priceInput.name = "price";
    priceInput.min = "0.01";
    priceInput.step = "0.01";
    priceInput.required = true;
    priceInput.id = "price";
    form.appendChild(priceLabel);
    form.appendChild(priceInput);

    form.appendChild(document.createElement("br"));

    //Description
    const descriptionLabel = document.createElement("label");
    descriptionLabel.textContent = "Beschreibung:";
    const descriptionInput = document.createElement("textarea");
    descriptionInput.name = "description";
    descriptionInput.id = "description";
    form.appendChild(descriptionLabel);
    form.appendChild(descriptionInput);

    form.appendChild(document.createElement("br"));



    // Speichern Button
    const saveBtn = document.createElement("button");
    saveBtn.textContent = "Speichern";
    saveBtn.type = "button";
    form.appendChild(saveBtn);



    document.body.appendChild(form);

    const resultDiv = document.getElementById("result");
    saveBtn.addEventListener("click", function (e) {
        e.preventDefault();

        const data = {
            name: document.getElementById("name").value.trim(),
            price: parseFloat(document.getElementById("price").value),
            description: document.getElementById("description").value.trim()
        };

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/api/articles", true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4){
                console.log("Status: ", xhr.status, " Response: ", xhr.responseText);
                if(xhr.status === 201){
                    const res = JSON.parse(xhr.responseText);
                    if(res.success){
                        resultDiv.innerHTML = `<p style="color: green; text-align: center;">Artikel erfolgreich gespeichert mit ID: ${res.data}</p>`;

                    } else {
                        resultDiv.innerHTML = `<p style="color: red; text-align: center;">Fehler: ${JSON.stringify(res.errors)}</p>`;
                    }
                } else {
                    resultDiv.innerHTML = `<p style="color: red; text-align: center;">Fehler beim Senden: (${xhr.status})</p>`;

                }
            }
        };
        xhr.send(JSON.stringify(data));
    });




    //Note: Pflichtfeld
    const note = document.createElement("p");
    note.style.fontStyle = "italic";
    note.style.fontSize = "0.9em";
    note.textContent = "(Note: * ist Pflichtfeld)";
    form.appendChild(note);
});
