
document.addEventListener("DOMContentLoaded", function (){
    console.log("Categories:", window.articleCategories);
    const menuData=[
        {title: "Home", url:"/abalo"},
        {title: "Kategorien",
            children: (window.articleCategories).map(category => ({
                    title: category.ab_name
                })
            )},
        {title: "Verkaufen"},
        {title: "Unternehmen",
            children:[
                {title: "Philosophie"},
                {title: "Karriere"}
            ]}
    ];

    function buildMenu(data) {
        const ul = document.createElement('ul');

        data.forEach(item => {
            const li = document.createElement('li');
            if(item.url){
                const a = document.createElement('a');
                a.href = item.url;
                a.textContent = item.title;
                li.appendChild(a);
            } else {
                li.textContent = item.title;
            }

            if (item.children && item.children.length >0) {
                const childUl = buildMenu(item.children);
                li.appendChild(childUl);
            }

            ul.appendChild(li);
        });
        return ul;
    }

    const nav = document.getElementById("navbar");
    if (nav) {
        nav.appendChild(buildMenu(menuData));
    } else console.warn("Can't find element #navbar");

});


