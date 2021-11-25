function getCookieUser() {
    let cookies = []
    cookies = document.cookie.split(";")
    let cookie = []
    for (let index = 0; index < cookies.length; index++) {
        cookie = cookies[index].split("=");
        if (cookie[0] === 'user_id' || cookie[0] === ' user_id') {
            return cookie[1];
        }
    }
    return false;
}

let totalCartPrice = 0;
document.getElementsByClassName('purchase-products')[0].addEventListener('click', onLoadFinalize)
let productIds = []

function onLoadFinalize() {
    console.log('finalize');
    var request = new XMLHttpRequest();
    var jsonData;

    var url = "http://localhost/GameChanger/controller/orders/";
    request.open("POST", url, true);
    request.setRequestHeader("Content-Type", "application/json");
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            jsonData = JSON.parse(request.response);
            console.log(jsonData);
            console.log(request.response)
            console.log(request.responseText)
        }
    };

    //place order
    const id = getCookieUser()
    var data = JSON.stringify(
        {
            "id_user": id,
            "payment": totalCartPrice
        });
    request.send(data);

    console.log(url)
    console.log(data)
    console.log(id)
    console.log(jsonData)
    //get order id by user id and not finalized

    url = "http://localhost/GameChanger/controller/orders/?id_user=" + id + '&finalized=no';
    var request = new XMLHttpRequest();
    console.log(url)

    var orderId;

    request.open("GET", url, true);
    request.setRequestHeader("Content-Type", "application/json");
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var jsonData = JSON.parse(request.response);
            console.log(jsonData);
            orderId = jsonData.id_order
            console.log("json data order id= " + jsonData.id_order)
        }
    };
    request.send();

    //add product content to orders


    let cartItemContainer = document.getElementsByClassName('cart-content')[0]
    let cartItems = cartItemContainer.getElementsByClassName('cart-item')
    for (let i = 0; i < cartItems.length; i++) {
        let cartItem = cartItems[i]
        let itemName = cartItem.getElementsByClassName('item-name')[0]
        let itemPrice = cartItem.getElementsByClassName('item-price')[0]
        let itemQuantity = cartItem.getElementsByClassName('item-amount')[0]
        let priceBack = itemPrice.textContent
        let price = parseFloat(priceBack.substring(1, priceBack.length))
        let quantity = itemQuantity.value
        let subTotal = quantity * price;


        var request = new XMLHttpRequest();
        url = "http://localhost/GameChanger/controller/orders/content/";
        for (let index = 0; index < productIds.length; index++) {
            request.open("POST", url, true);
            request.setRequestHeader("Content-Type", "application/json");
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    const jsonData = JSON.parse(request.response);
                    console.log(jsonData);
                }
            };

            console.log("orderid = " + orderId + ";   productId = " + productIds[index])
            data = JSON.stringify(
                {
                    "id_order": orderId,
                    "id_product": productIds[index]
                });
            request.send(data);
        }
        console.log('price: ', price, 'quantity: ', quantity)
    }
}

const removeCartItemBtn = document.getElementsByClassName('remove-item')
for (let i = 0; i < removeCartItemBtn.length; i++) {
    let remBtn = removeCartItemBtn[i]
    remBtn.addEventListener('click', removeCartItem)
}

const quantityInputs = document.getElementsByClassName('item-amount')
for (let i = 0; i < quantityInputs.length; i++) {
    let input = quantityInputs[i]
    input.addEventListener('change', quantityChanged)
}

function removeCartItem(event) {
    let remBtnClicked = event.target
    remBtnClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event) {
    let input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateCartTotal()
}

let addToCartButtons = document.getElementsByClassName('add-to-cart')
console.log(addToCartButtons);
for (let i = 0; i < addToCartButtons.length; i++) {
    let btn = addToCartButtons[i]
    btn.addEventListener('click', addToCartClicked)
}

document.getElementsByClassName('purchase-products')[0].addEventListener('click', purchaseClicked)

function purchaseClicked() {
    if (document.getElementsByClassName('cart-total')[0].innerText == 0) {
        alert('Cart empty, add items to cart to purchase!')
    } else {
        //alert('Thank you for your purchase!')
        let cartItems = document.getElementsByClassName('cart-content')[0]
        let cartItemNames = cartItems.getElementsByClassName('item-name')
        while (cartItems.hasChildNodes()) {
            cartItems.removeChild(cartItems.firstChild)
        }
        updateCartTotal()
    }

}

function FunctionRest(productId) {
    productIds.push(productId)
    addToCartClicked(productId);
}

function addToCartClicked(productId) {
    let product = document.getElementById(productId);
    console.log(product);
    let itemName = product.getElementsByClassName('item-name')[0].innerText;
    let price = product.getElementsByClassName('item-price')[0].innerText;
    let imageSrc = product.getElementsByClassName('product-image')[0].src
    addItemToCart(itemName, price, imageSrc);
    updateCartTotal();
}

function addItemToCart(itemName, price, imageSrc) {
    let item = document.createElement('div')
    item.classList.add('cart-item')
    let cartItems = document.getElementsByClassName('cart-content')[0]
    console.log(cartItems);
    let cartItemNames = cartItems.getElementsByClassName('item-name')
    for (let i = 0; i < cartItemNames.length; i++) {
        console.log('itemul din carrt este ' + cartItemNames[i].textContent);
        if (cartItemNames[i].textContent == itemName) {
            alert('Item already in cart')
            return
        }
    }

    let cartRowContent =
        `
                        <img src="${imageSrc}" alt="product image">
                        <div class="item-name-price-remove">
                            <h4 class="item-name">${itemName}</h4>
                            <h5 class="item-price">${price}</h5>
                            <span class="remove-item">Remove</span>
                        </div>
                        <div class="item-quantity-control">
                            <input type="number" value="1" class="item-amount">
                        </div>
    `
    item.innerHTML = cartRowContent
    cartItems.append(item)
    item.getElementsByClassName('remove-item')[0].addEventListener('click', removeCartItem)
    item.getElementsByClassName('item-quantity-control')[0].addEventListener('change', quantityChanged)
}

function updateCartTotal() {
    let cartItemContainer = document.getElementsByClassName('cart-content')[0]
    let cartItems = cartItemContainer.getElementsByClassName('cart-item')
    let total = 0
    let quantityTotal = 0
    for (let i = 0; i < cartItems.length; i++) {
        let cartItem = cartItems[i]
        let itemPrice = cartItem.getElementsByClassName('item-price')[0]
        let itemQuantity = cartItem.getElementsByClassName('item-amount')[0]
        let priceBack = itemPrice.textContent
        let price = parseFloat(priceBack.substring(1, priceBack.length))
        let quantity = itemQuantity.value
        quantityTotal = quantityTotal + parseFloat(quantity)
        console.log('price: ', price, 'quantity: ', quantity)
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    totalCartPrice = total;
    document.getElementsByClassName('cart-total')[0].innerText = total
    document.getElementsByClassName('cart-items')[0].innerText = quantityTotal
}