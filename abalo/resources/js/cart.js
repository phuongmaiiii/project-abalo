document.addEventListener('DOMContentLoaded', () => {
    const cart = [];
    const cartContainer = document.getElementById('cart');
    const articleRows = document.querySelectorAll('#article-list .article');
    let shoppingcartid = 1;

    function renderCart() {
        cartContainer.innerHTML = '';
        cart.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.name + ' ';
            const removeBtn = document.createElement('button');
            removeBtn.textContent = '–';
            removeBtn.addEventListener('click', () => {
                removeFromCart(item.id, shoppingcartid);
            });
            li.appendChild(removeBtn);
            cartContainer.appendChild(li);
        });
    }

    function addToCart(id, name, rowElement) {
        if (!cart.find(item => item.id === id)) {
            cart.push({id, name, rowElement});
            rowElement.querySelector('.add-to-cart').disabled = true;
            renderCart();

            //POST
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/shoppingcart", true);
            xhr.setRequestHeader("Content-Type", 'application/json;charset=UTF-8');
            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const res = JSON.parse(xhr.responseText);
                        if (res.success) {
                            console.log("Artikel erfolgreich in den Warenkorb gelegt.");
                        } else {
                            console.error("Fehler beim Speichern des Artikels in den Warenkorb:", res.errors);
                        }
                    }
                }
            }
            var data = JSON.stringify({ab_article_id: id});
            xhr.send(data);
        }
    }

    function removeFromCart(id, shoppingcartid) {
        const index = cart.findIndex(item => item.id === id);
        if (index > -1) {
            const item = cart.splice(index, 1)[0];
            item.rowElement.querySelector('.add-to-cart').disabled = false;
            renderCart();

            //DELETE
            const articleid = id;
            var xhr = new XMLHttpRequest();
            xhr.open("DELETE", `/api/shoppingcart/${shoppingcartid}/articles/${articleid}`, true);
            xhr.setRequestHeader("Content-Type", 'application/json;charset=UTF-8');
            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const res = JSON.parse(xhr.responseText);
                        if (res.success) {
                            console.log('Artikel erfolgreich aus dem Warenkorb entfernt.');
                        } else {
                            console.error('Fehler beim Entfernen des Artikels aus dem Warenkorb:', res.errors);
                        }
                    }
                }
            }
            xhr.send();
        }
    }

    articleRows.forEach(row => {
        const btn = row.querySelector('.add-to-cart');
        const id = parseInt(row.dataset.id);
        const name = row.querySelector('strong').textContent;

        btn.addEventListener('click', () => {
            addToCart(id, name, row);
        });
    });

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/shoppingcart", true);
    xhr.setRequestHeader("Content-Type", 'application/json;charset=UTF-8');
    xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                shoppingcartid = data.shoppingcartid;
                data.items.forEach(item => {
                    const row = document.querySelector(`.article[data-id="${item.ab_article_id}"]`);
                    if (row) {
                        const name = row.querySelector('strong').textContent;
                        addToCart(item.ab_article_id, name, row);
                    }
                })
            }
        }
    }
    xhr.send();
});
