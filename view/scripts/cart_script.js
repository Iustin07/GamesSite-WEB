
const cartButton = document.querySelector('.cart');
const closeCartButton = document.querySelector('.close-cart');
const clearCartButton = document.querySelector('.clear-cart');
const myCart = document.querySelector('.my-cart');
const cartInfo = document.querySelector('.cart-info');
const cartItems = document.querySelector('cart-items');
const cartTotal = document.querySelector('.cart-total');
const cartContent = document.querySelector('.cart-content');
const productsDM = document.querySelector('.products');

let cart = [];

class Products{
    async getProducts(){
        try{
            let res = await fetch('products.json');
            return res;
        }
        catch(ex){
            console.log(ex)
        }
    }
}

class Display{

}

class Storage{

}

document.addEventListener("DOMContentLoaded", ()=>{
    const display = new Display();
    const products = new Products();

    products.getProducts().then(data => console.log(data))
})