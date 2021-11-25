function getCookies() {
    let cookies = []
    cookies = document.cookie.split(";")
    let cookieNames = []
    let cookie = []
    for (let index = 0; index < cookies.length; index++) {
        cookie = cookies[index].split("=");
        cookieNames.push(cookie[0])
    }
    return cookieNames;
}

function getCookieUser(){
    let cookies = []
    cookies = document.cookie.split(";")
    let cookie = []
    for (let index = 0; index < cookies.length; index++) {
        cookie = cookies[index].split("=");
        if(cookie[0] === 'user_id' || cookie[0] === ' user_id'){
            return cookie[1];
        }
    }
    return false;
}

function redirectBasedOnCheck() {
    let cookieNames = getCookies();
    let it = 0;
    for (let index = 0; index < cookieNames.length; index++) {
        if (cookieNames[index] === 'user_id' || cookieNames[index] === ' user_id') {
            it++;
            break
        }
    }
    for (let index = 0; index < cookieNames.length; index++) {
        if (cookieNames[index] === ' serial' || cookieNames[index] === 'serial') {
            it++;
            break
        }
    }
    for (let index = 0; index < cookieNames.length; index++) {
        if (cookieNames[index] === ' token' || cookieNames[index] === 'token') {
            it++;
            break
        }
    }
    if (it === 3) {
        window.location.href = "../../view/pages/MyAccount.php";
    } else {
        window.location.href = "../../view/pages/SignIn.php";
    }
}

function logout() {
    let cookieNames = getCookies();
    for (let index = 0; index < cookieNames.length; index++) {
        console.log(cookieNames[index])
        if (cookieNames[index] === ('user_id') || cookieNames[index] === (' user_id')
            || cookieNames[index] === ('token') || cookieNames[index] === (' token')
            || cookieNames[index] === ('serial') || cookieNames[index] === (' serial')) {
            document.cookie = cookieNames[index] + "=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/GameChanger/view/pages"

            window.location.href = "../../view/pages/Home.php";
        }
    }
}

let response ;
function onLoad(){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){

        if(request.readyState === 4){
            if(request.status === 200){
               response=request.responseText;
                auctionProducts=JSON.parse(auctionProductsResponse);
                document.getElementById("gamesProd").innerHTML = `
${auctionProducts.map(getProducts).join('')}
`
            }
            else{
                console.log("Status error: " + request.status);
            }
        }
        else{
            console.log("Ignored readyState: " + request.readyState);
        }


    }
    request.open('GET', 'http://localhost/game/controller/sessions/');
    request.send();
}
