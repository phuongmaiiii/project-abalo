document.addEventListener("DOMContentLoaded", function(){
    // Prüfen, ob der Cookie gesetzt ist

    function getCookie(name){
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if(parts.length===2){
            return parts.pop().split(';').shift();
        }
    }
    function setCookie(name, value, days){
        const date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = `${name}=${value}; ${expires}; path=/`;
    }
    if(!getCookie("cookie_consent")){
        const banner = document.createElement("div");
        banner.id = "cookie-banner";
        banner.innerHTML = '<div id="cookie">Diese Website verwendet Cookies, um Ihnen das beste Erlebnis zu bieten.' +
            '<button id="accept-cookies">Einverstaden</button>' +
            '</div>';
        document.body.appendChild(banner);
        //Beim Klick Zustimmung speichern und Banner entfernen
        document.getElementById("accept-cookies").addEventListener("click", function (){
            setCookie("cookie_consent", "true", 365);
            document.getElementById("cookie-banner").remove();
        });
    }
    console.log(document.cookie);
})
