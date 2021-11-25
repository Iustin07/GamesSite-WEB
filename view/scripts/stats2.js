
//auctionProducts.sort(dynamicSort("numberSelles"));
var auctionProductsResponse;
var auctionProducts;
var firstTenProducts;
function onLoadStats(){
    console.log('aiaci');
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.onreadystatechange = function(){

        if(ajaxRequest.readyState == 4){
            //the request is completed, now check its status
            if(ajaxRequest.status == 200){
                auctionProductsResponse=ajaxRequest.responseText;
               // console.log(auctionProductsResponse);
                auctionProducts=JSON.parse(auctionProductsResponse);
auctionProducts.sort((a, b) => parseInt(a.numberSelles) > parseInt(b.numberSelles) ? -1 : (parseInt(a.numberSelles) < parseInt(b.numberSelles) ? 1 : 0));
firstTenProducts=auctionProducts.slice(0,15);
document.getElementById("tableId").innerHTML='<tr><th>ID-uri</th><th>Name</th><th>Year</th><th>Number of sells</th></tr>';
                document.getElementById("tableId").innerHTML += `
     ${firstTenProducts.map(putLineTable).join('')}
     `
            }
            else{
                console.log("Status error: " + ajaxRequest.status);
            }
        }
        else{
            console.log("Ignored readyState: " + ajaxRequest.readyState);
        }


    }
    ajaxRequest.open('GET', 'http://localhost/GameChanger/controller/productIndex.php/product');
    ajaxRequest.send();
}



// fetch("../scripts/auction-products.json")
//   .then(response => response.json())
//   .then(products=>{
//      auctionProducts=products;
//      auctionProducts.sort((a, b) => parseInt(a.numberSelles) > parseInt(b.numberSelles) ? -1 : (parseInt(a.numberSelles) < parseInt(b.numberSelles) ? 1 : 0));
//      document.getElementById("tableId").innerHTML='<tr><th>ID-uri</th><th>Name</th><th>Year</th><th>Number of sells</th></tr>';
//      document.getElementById("tableId").innerHTML += `
//      ${auctionProducts.map(putLineTable).join('')}
//      `
//     });


    
function mostBought(){
 auctionProducts.sort((a, b) => parseInt(a.numberSelles) > parseInt(b.numberSelles) ? -1 : (parseInt(a.numberSelles) < parseInt(b.numberSelles) ? 1 : 0));
 firstTenProducts=auctionProducts.slice(0,15);
document.getElementById("tableId").innerHTML='<tr><th>ID-uri</th><th>Name</th><th>Year</th><th>Number of sells</th></tr>';
document.getElementById("tableId").innerHTML += `
${firstTenProducts.map(putLineTable).join('')}
`
}
function lessBought(){
    // var parent=document.getElementById("tableId");
    // while (parent.firstChild) {
    //     parent.removeChild(myNode.firstChild);
    // }
    auctionProducts.sort((a, b) => parseInt(a.numberSelles) < parseInt(b.numberSelles) ? -1 : (parseInt(a.numberSelles) > parseInt(b.numberSelles) ? 1 : 0));
    firstTenProducts=auctionProducts.slice(0,15);
    document.getElementById("tableId").innerHTML='<tr><th>ID-uri</th><th>Name</th><th>Year</th><th>Number of sells</th></tr>';
    document.getElementById("tableId").innerHTML += `
    ${firstTenProducts.map(putLineTable).join('')}
    `
    }
function putLineTable(product) {
    return `
    <tr>
    <td>${product.id}</td>
    <td>${product.name}</td>
    <td>${product.productYear}</td>
    <th>${product.numberSelles}</th>
  </tr>
   `
}

function dynamicSort(property) {
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        /* next line works with strings and numbers, 
         * and you may want to customize it to your needs
         */
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}
Array.prototype.sortBy = function(p) {
    return this.slice(0).sort(function(a,b) {
      return (a[p] > b[p]) ? 1 : (a[p] < b[p]) ? -1 : 0;
    });
  }
  function changFunc(){
    let card = document.getElementById("export-based-on");
    //const choice=card.options[card.selectedIndex].value;
    const choice=card.value; 
    if(card.options[card.selectedIndex].value==='stat1'){
 mostBought();
    }
  else{
      lessBought();
  }
  }