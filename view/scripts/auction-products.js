// de inlocuit cu ajax aici
// fetch("../scripts/auction-products.json")
//   .then(response => response.json())
//   .then(auctionProducts =>{
//     document.getElementById("auctionProd").innerHTML=`
//     ${auctionProducts.map(getProducts).join('')}
//    `
//   });
var auctionProductsResponse;
var auctionProducts;

function onLoadAuction() {
    console.log('aiaci');
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.onreadystatechange = function () {

        if (ajaxRequest.readyState == 4) {
            //the request is completed, now check its status
            if (ajaxRequest.status == 200) {
                auctionProductsResponse = ajaxRequest.responseText;
                // console.log(auctionProductsResponse);
                auctionProducts = JSON.parse(auctionProductsResponse);
                document.getElementById("auctionProd").innerHTML = `${auctionProducts.map(getProducts).join('')}
`
            } else {
                console.log("Status error: " + ajaxRequest.status);
            }
        } else {
            console.log("Ignored readyState: " + ajaxRequest.readyState);
        }


    }
    ajaxRequest.open('GET', 'http://localhost/GameChanger/controller/productIndex.php/product/auction');
    ajaxRequest.send();
}

function getProducts(product) {
    return `
    <article class="product" >
    <img src="${product.picture_path}" alt="${product.name}" />
  <h3 class="product-name">
      <a href="/#/product/1">${product.name}</a>
  </h3>
  <h2 class="${product.category}"></h2>
  <h4>Actual price: ${product.price}</h4>
  <input type="text" name="age" class="ageInput objecthide" value=${product.age_target}>
  <input type="text"  name="rating" class="ratingInput objecthide" value=${product.rating}>
  <button class="bid" onclick="redirect(${product.id})">Bid</button>
   
   </article>
   `
}
function redirect(param){
    if(param===1)
   location.href="grande.php";
}
function resetFilters() {
    var age = document.getElementById("ageSelector");
    var card = document.getElementById("typeSelector");
    var rating = document.getElementById("ratingSelector");
    age.options.selectedIndex = 0;
    card.options.selectedIndex = 0;
    rating.options.selectedIndex = 0;
    makeAllVisible();

}

function makeAllVisible() {
    const taskList = document.querySelectorAll(".product");
    taskList.forEach((value, index) => {
        value.classList.remove("objecthide");
    });
}

function myTypeFilter() {
    let card = document.getElementById("typeSelector");
    if (card.options[card.selectedIndex].value === 'strategy') {
        makeAllVisible();
        const productListStrategy = document.querySelectorAll(".cards");
        console.log(productListStrategy);
        //alert("Please select a card type");
        productListStrategy.forEach((product, index) => {
                //product.style.display = "none";
                product.parentElement.classList.add("objecthide");
                console.log(product.parentElement);
            }
            //return false;

        );
    }
    if (card.options[card.selectedIndex].value === 'type') {
        makeAllVisible();
        //return false;


    }
    if (card.options[card.selectedIndex].value === 'cards') {
        console.log('type filter');
        makeAllVisible();
        const productListStrategy = document.querySelectorAll(".strategy");
        console.log(productListStrategy);
        //alert("Please select a card type");

        productListStrategy.forEach((product, index) => {
                //product.style.display = "none";
                product.parentElement.classList.add("objecthide");
                console.log(product.parentElement);
            }
            //return false;

        );

    }

}

function myAgeFilter() {
    let age = document.getElementById("ageSelector");
    if (age.options[age.selectedIndex].value === 'age') {
        makeAllVisible();
    }
    let eight = document.querySelectorAll(".ageInput");
    if (age.options[age.selectedIndex].value === 'age8') {
        makeAllVisible();
        eight.forEach((product, index) => {
            //console.log(product.value);
            if (parseInt(product.value) < 8) {
                product.parentElement.classList.add("objecthide");
            }

        });

    }

    if (age.options[age.selectedIndex].value === 'age12') {
        makeAllVisible();
        eight.forEach((product, index) => {
            if (parseInt(product.value) < 12) {
                product.parentElement.classList.add("objecthide");
            }

        });

    }
    if (age.options[age.selectedIndex].value === 'age14') {
        makeAllVisible();
        eight.forEach((product, index) => {
            if (parseInt(product.value) < 14) {
                product.parentElement.classList.add("objecthide");
            }

        });

    }


}

function myRatingFilter() {
    var rating = document.getElementById("ratingSelector");
    if (rating.options[rating.selectedIndex].value === 'rating') {
        makeAllVisible();
    }
    let rat = document.querySelectorAll(".ratingInput");
    if (rating.options[rating.selectedIndex].value === 'rat7') {
        makeAllVisible();

        rat.forEach((product, index) => {
            //console.log(product.value);
            if (product.value > 6.5) {
                product.parentElement.classList.add("objecthide");
            }

        });
    }
    if (rating.options[rating.selectedIndex].value === 'rat8') {
        makeAllVisible();

        rat.forEach((product, index) => {
            //console.log(product.value);
            if (product.value >= 8.0) {
                product.parentElement.classList.add("objecthide");
            }

        });
    }
    if (rating.options[rating.selectedIndex].value === 'rat9') {
        makeAllVisible();

        rat.forEach((product, index) => {
            //console.log(product.value);
            if (product.value < 8.0) {
                product.parentElement.classList.add("objecthide");
            }

        });
    }
}