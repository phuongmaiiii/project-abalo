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
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "/api/categories", true);

        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    const categories = JSON.parse(xhr.responseText);
                    const kategorien = this.menuData.find(item => item.title === "Kategorien");
                    if (kategorien && Array.isArray(categories)) {
                        kategorien.children = categories.map(cat => ({
                            title: cat.ab_name
                        }));
                    }
                    console.log("Kategorien:", categories);
                } catch (e) {
                    console.error("Fehler beim Parsen der Antwort:", e);
                }
            } else {
                console.error("Fehler beim Laden der Kategorien:", xhr.statusText);
            }
            callback(); // Luôn gọi callback
        };

        xhr.onerror = () => {
            console.error("Netzwerkfehler beim Laden der Kategorien");
            callback();
        };

        xhr.send();
    },

    buildMenu: function (data) {
        const ul = document.createElement('ul');

        data.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item.title;

            if (item.children) {
                const childUl = this.buildMenu(item.children);
                childUl.style.display = "none";

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
