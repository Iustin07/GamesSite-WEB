
let usersResponse;

function onLoad() {

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState === 4) {
            if (request.status === 200) {
                usersResponse = request.responseText;

                //TO remove in the future
                console.log(usersResponse);

                auctionProducts = JSON.parse(usersResponse);

                //dom man for admin

            } else {
                console.log("Status error: " + request.status);
            }
        } else {
            console.log("Ignored readyState: " + request.readyState);
        }


    }

    //get all users
    request.open('GET', 'http://localhost/GameChanger/controller/users');
    request.send();
}