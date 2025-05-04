document.addEventListener("DOMContentLoaded", function () {
    NavigationMenu.init();
});

const NavigationMenu = {
    menuData: [
        { title: "Home" },
        { title: "Kategorien", dynamic: true }, // wird dynamisch ersetzt
        { title: "Verkaufen" },
        {
            title: "Unternehmen",
            children: [
                { title: "Philosophie" },
                { title: "Karriere" }
            ]
        }
    ],

    init: function () {
        const nav = document.getElementById("navbar");
        if (!nav) return console.warn("Navbar-Element nicht gefunden.");

        this.injectDynamicCategories(() => {
            const menu = this.buildMenu(this.menuData);
            nav.appendChild(menu);
        });
    },

    injectDynamicCategories: function (callback) {
        fetch("/api/categories")
            .then(response => response.json())
            .then(categories => {
                const kategorien = this.menuData.find(item => item.title === "Kategorien");
                if (kategorien && Array.isArray(categories)) {
                    kategorien.children = categories.map(cat => ({
                        title: cat.ab_name
                    }));
                }
                callback(); // Gọi callback sau khi dữ liệu đã được inject
            })
            .catch(error => {
                console.error("Fehler beim Laden der Kategorien:", error);
                callback(); // Dù lỗi vẫn tiếp tục render menu cơ bản
            });
    },

    buildMenu: function (data) {
        const ul = document.createElement('ul');

        data.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.title;

            if (item.children) {
                const childUl = this.buildMenu(item.children);
                childUl.style.display = "none";
                childUl.classList.add('submenu');

                li.addEventListener('click', function (e) {
                    e.stopPropagation();
                    childUl.style.display = childUl.style.display === "none" ? "block" : "none";
                });

                li.appendChild(childUl);
            }

            ul.appendChild(li);
        });

        return ul;
    }
};
