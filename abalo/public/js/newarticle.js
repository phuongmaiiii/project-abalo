document.addEventListener("DOMContentLoaded", function (){
    //Formular erzeugen
    const form = document.createElement('form');
    form.method = "POST";
    form.action ="/articles";
    form.id = "aritcleForm";
    form.enctype = "multipart/form-data"; // upload file

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
    form.appendChild(nameLabel);
    form.appendChild(nameInput);

    form.appendChild(document.createElement("br"));

    //Price
    const priceLabel = document.createElement("label");
    priceLabel.textContent="Preis (€) *:";
    const priceInput=document.createElement("input");
    priceInput.type = "number";
    priceInput.name = "price";
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

    //Bild (Image Upload)
    const bildLabel = document.createElement("label");
    bildLabel.textContent = "Bild:";
    const bildInput = document.createElement("input");
    bildInput.type = "file";
    bildInput.name = "image";
    bildInput.accept = "image/*"
    form.appendChild(bildLabel);
    form.appendChild(bildInput);
    form.appendChild(document.createElement("br"));

    // Erstellt am
    const dateLabel = document.createElement("label");
    dateLabel.textContent = "Erstellt am:";
    const dateInput = document.createElement("input");
    dateInput.type = "datetime-local"; // HTML5 hỗ trợ nhập ngày & giờ
    dateInput.name = "created_at";
    form.appendChild(dateLabel);
    form.appendChild(dateInput);
    form.appendChild(document.createElement("br"));

    //Note: Pflichtfeld
    const note = document.createElement("p");
    note.style.fontStyle = "italic";
    note.style.fontSize = "0.9em";
    note.textContent = "(Note: * ist Pflichtfeld)";
    form.appendChild(note);


    // Speichern Button
    const saveBtn = document.createElement("button");
    saveBtn.textContent = "Speichern";
    saveBtn.type = "button";
    saveBtn.addEventListener("click", function () {
        const name = document.getElementById("name").value.trim();
        const price = parseFloat(document.getElementById("price").value);
        const errors = [];

        if (name === "") errors.push("Name darf nicht leer sein.");
        if (isNaN(price) || price <= 0) errors.push("Preis muss größer als 0 sein.");

        let errorDiv = document.getElementById("form-errors");
        if (!errorDiv) {
            errorDiv = document.createElement("div");
            errorDiv.id = "form-errors";
            errorDiv.style.color = "red";
            form.prepend(errorDiv);
        }

        if (errors.length > 0) {
            errorDiv.innerHTML = errors.join("<br>");
        } else {
            errorDiv.innerHTML = "";
            form.submit();
        }
    });

    form.appendChild(saveBtn);
    document.body.appendChild(form);
});
