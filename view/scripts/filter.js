function resetFiltersMobile(){
    var age= document.getElementById("ageSelectorMobile");
    var card = document.getElementById("typeSelectorMobile");
    var rating= document.getElementById("ratingSelectorMobile");
    age.options.selectedIndex=0;
    card.options.selectedIndex=0;
    rating.options.selectedIndex=0;
    makeAllVisibleMobile();

}
function makeAllVisibleMobile() {
    console.log("make all visible");
    const taskList = document.querySelectorAll(".product");
    console.log(taskList);
    taskList.forEach((value, index) => {
        value.classList.remove("objecthide");
    });
    console.log("final make all visible");
}

function myTypeFilterMobile() {
    console.log("type filter call");
    let card = document.getElementById("typeSelectorMobile");
    if (card.options[card.selectedIndex].value === 'strategy') {
        makeAllVisibleMobile();
        console.log("ce se intampla?");
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
    makeAllVisibleMobile();
            //return false;

        
    }
    if (card.options[card.selectedIndex].value === 'cards') {
        console.log('type filter');
        makeAllVisibleMobile();
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

function myAgeFilterMobile(){
    console.log("age filter call");
let age= document.getElementById("ageSelectorMobile");
//let age=document.getElementsByClassName('ageSelector')[0];
if (age.options[age.selectedIndex].value === 'age'){
    makeAllVisibleMobile();
}
let eight =document.querySelectorAll(".ageInput");
//console.log(eight);
if (age.options[age.selectedIndex].value === 'age8'){
   makeAllVisibleMobile();
   eight.forEach((product,index)=>{
 //console.log(product.value);
 if(product.value<8){
    product.parentElement.classList.add("objecthide");
 }

   });

   }

   if (age.options[age.selectedIndex].value === 'age12'){
    makeAllVisibleMobile();
    eight.forEach((product,index)=>{
 if(product.value<12){
    product.parentElement.classList.add("objecthide");
 }

   });

   }
   if (age.options[age.selectedIndex].value === 'age14'){
    makeAllVisibleMobile();
    eight.forEach((product,index)=>{
 if(product.value<14){
    product.parentElement.classList.add("objecthide");
 }

   });

   }


}

function myRatingFilterMobile(){
    console.log("rating");
    var rating= document.getElementById("ratingSelectorMobile");
    if (rating.options[rating.selectedIndex].value === 'rating'){
        makeAllVisibleMobile();
    }
    let rat  =document.querySelectorAll(".ratingInput");
if(rating.options[rating.selectedIndex].value === 'rat7'){
    makeAllVisibleMobile();
   
    rat.forEach((product,index)=>{
        //console.log(product.value);
        if(product.value>6.5){
           product.parentElement.classList.add("objecthide");
        }
       
          });
}
if(rating.options[rating.selectedIndex].value === 'rat8'){
    makeAllVisibleMobile();
   
    rat.forEach((product,index)=>{
        //console.log(product.value);
        if(product.value>=8.0){
           product.parentElement.classList.add("objecthide");
        }
       
          });
}
if(rating.options[rating.selectedIndex].value === 'rat9'){
    makeAllVisibleMobile();
   
    rat.forEach((product,index)=>{
        //console.log(product.value);
        if(product.value<8.0){
           product.parentElement.classList.add("objecthide");
        }
       
          });
}
}
function myFunction() {
    console.log("request");
      ///.drop-filter:hover 
      document.getElementsByClassName("hide-filters").style.display="none";
    }