document.addEventListener('DOMContentLoaded', () => {
    const cart = [];
    const cartContainer = document.getElementById('cart');
    const articleRows = document.querySelectorAll('#article-list .article');

    function renderCart() {
        cartContainer.innerHTML = '';
        cart.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.name + ' ';
            const removeBtn = document.createElement('button');
            removeBtn.textContent = '–';
            removeBtn.addEventListener('click', () => {
                removeFromCart(item.id);
            });
            li.appendChild(removeBtn);
            cartContainer.appendChild(li);
        });
    }

    function addToCart(id, name, rowElement) {
        if (!cart.find(item => item.id === id)) {
            cart.push({ id, name, rowElement });
            rowElement.querySelector('.add-to-cart').disabled = true;
            renderCart();
        }
    }

    function removeFromCart(id) {
        const index = cart.findIndex(item => item.id === id);
        if (index > -1) {
            const item = cart.splice(index, 1)[0];
            item.rowElement.querySelector('.add-to-cart').disabled = false;
            renderCart();
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
});
