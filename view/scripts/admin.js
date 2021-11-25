const removeUserButton = document.getElementById("removeUser").addEventListener("click", showForm);
const removeProductButton=document.getElementById("removeProd").addEventListener("click",showProdForm);
const modUserButton=document.getElementById("modUser").addEventListener("click",showModUserForm);
const modProductButton=document.getElementById("modProd").addEventListener("click",showModProdForm);
const addProductButton=document.getElementById("addProd").addEventListener("click",showAddProdForm);
//const addProductButton=document.getElementById("addProd").addEventListener("click",showAddProdForm);
//console.log("primul pas");

function showForm() {
    console.log("show form");
//if(param===1){
    const form = document.body.appendChild(showRemoveUserForm());
//}
//if(param===2){
    //const form = document.body.appendChild(showRemoveProdForm());
//}

    form.classList.add("show");
    const closeButton = form.querySelector(".close");
    const closeRemoveUserForm = () => {
        console.log("close succes");
        form.removeEventListener("submit", submitTask);
        closeButton.removeEventListener("click", closeRemoveUserForm);
        form.classList.remove("show");
    };
    const submitTask = (event) => {
        event.preventDefault();

        const { target } = event;
        var request = new XMLHttpRequest();
        const email = target.querySelector('[name="Useremail"]').value;
        var url = "http://localhost/GameChanger/controller/users/?email="+email;
        request.open("DELETE", url, true);
       // request.setRequestHeader("Content-Type", "application/json");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
               
              console.log('success');
            }
        };
       
        request.send();
    console.log('send was done with success');
     
        closeRemoveUserForm();
    };
    closeButton.addEventListener("click", closeRemoveUserForm);
    form.addEventListener("submit", submitTask);

}
function compileToNode(domString) {
    console.log("node");
    const div = document.createElement("div");
    div.innerHTML = domString;

    return div.firstElementChild;
}
function showRemoveUserForm() {
    const formString = `
    <div class="backdrop hide">
      <div class="modal">
        <h2 class="title">Remove user</h2>
      
        <img class="close image-close" src="../images/close_icon.png" alt="close">
       
     
        
        <form id="removeUserForm" action="" method="POST">
          <label for="title">Email of user</label>
          <input type="email" name="Useremail" id="username" required>
          <button class="btn-add" name="submit" type="submit">Find user and remove</button>
        </form>
      </div>
    </div>
    `.trim();
    return compileToNode(formString);
}
/*remove product*/
function showRemoveProdForm() {
    const formString = `
  <div class="backdrop hide">
    <div class="modal">
      <h2 class="title">Remove product</h2>
    
      <img class="close image-close" src="../images/close_icon.png">
     
   
      
      <form id="removeProdForm" action="" method="DELETE">
        <label for="title">Name of product</label>
        <input type="text" name="Productname" id="prodNameDelete" required>
        <button class="btn-add" name="submit" type="submit">Find product and remove</button>
      </form>
    </div>
  </div>
  `.trim();
    return compileToNode(formString);
}
////
function showProdForm() {
    console.log("show form");
    //if(param===1){
    const form = document.body.appendChild(showRemoveProdForm());
    //}
    //if(param===2){
    //const form = document.body.appendChild(showRemoveProdForm());
    //}
    form.classList.add("show");
    const closeButton = form.querySelector(".close");
    const closeRemoveProdForm = () => {
        console.log("close succes");
        form.removeEventListener("submit", submitTask);
        closeButton.removeEventListener("click", closeRemoveProdForm);
        form.classList.remove("show");
    };
    const submitTask = (event) => {
        event.preventDefault();

        const { target } = event;
        var request = new XMLHttpRequest();
        const title = target.querySelector('[name="Productname"]').value;
        var url = "http://localhost/GameChanger/controller/productIndex.php/product/"+title;
        request.open("DELETE", url, true);
       // request.setRequestHeader("Content-Type", "application/json");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
               
              console.log('success');
            }
        };
       
        request.send();
    console.log('send was done with success');
     
        closeRemoveProdForm();
    };
    closeButton.addEventListener("click", closeRemoveProdForm);
    form.addEventListener("submit", submitTask);

}

/**************mod user form***************/
function showModUserForm() {
    //console.log("show form");
    const form = document.body.appendChild(showModifyUserForm());

    form.classList.add("show");
    const closeButton = form.querySelector(".close");
    const closeshowModifyUserForm = () => {
        console.log("close succes");
        form.removeEventListener("submit", submitTask);
        closeButton.removeEventListener("click", closeshowModifyUserForm);
        form.classList.remove("show");
    };
    const submitTask = (event) => {
        event.preventDefault();

        const { target } = event;
        const email = target.querySelector('[name="Uemail"]').value;
        var url = "http://localhost/GameChanger/controller/users/?email="+email;
        request.open("PATCH", url, true);
        request.setRequestHeader("Content-Type", "application/json");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                // var jsonData = JSON.parse(request.response);
                // console.log(jsonData);
                console.log('put succes');
            }
        };
     
        var  fname= document.getElementById("fname").value;
        var sname = document.getElementById("sname").value;
        var money = document.getElementById("moneys").value;
        var data = JSON.stringify({"FNAME":fname,
        "SNAME":sname,
        "MONEY_SPENT":money
        });
        request.send(data);
    console.log('send was done with success');
        
        closeshowModifyUserForm();
    };
    closeButton.addEventListener("click", closeshowModifyUserForm);
    form.addEventListener("submit", submitTask);

}
function showModifyUserForm() {
    const formString = `
      <div class="backdrop hide">
        <div class="modal">
          <h2 class="title">Modify user data</h2>
        
          <img class="close image-close" src="../images/close_icon.png">
         
      
          <form id="modUserForm" action="" method="PATCH">

            <label for="email">Email of user</label>
            <input type="text" name="Uemail" id="username" required>
            <br>
            <label>data to modify</label>
            <br>
            <p><label for="Fname">First name</label>  </p>
             <input type="text" name="Fname" id="fname">
            <p><label for="Sname">Second name</label>  </p>
            <input type="text" name="Sname" id="sname">
            <p> <label for="Money">Money spent</label></p>
            <input type="text" name="money" id="moneys">
            <button class="btn-add" name="submit" type="submit">Find user and modify</button>
          </form>
        </div>
      </div>
      `.trim();
    return compileToNode(formString);
}
/****************mod prod form*************/
function showModProdForm() {
    console.log("show form");
    const form = document.body.appendChild(showModifyProdForm());

    form.classList.add("show");
    const closeButton = form.querySelector(".close");
    const closeshowModifyProdForm = () => {
        console.log("close succes");
        form.removeEventListener("submit", submitTask);
        closeButton.removeEventListener("click", closeshowModifyProdForm);
        form.classList.remove("show");
    };
    const submitTask = (event) => {
        event.preventDefault();

        const { target } = event;
        var request = new XMLHttpRequest();
        const title = target.querySelector('[name="prodName"]').value;
        var url = "http://localhost/GameChanger/controller/productIndex.php/product/"+title;
        request.open("PUT", url, true);
        request.setRequestHeader("Content-Type", "application/json");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                // var jsonData = JSON.parse(request.response);
                // console.log(jsonData);
                console.log('put succes');
            }
        };
       console.log(title);
        var price = document.getElementById("price").value;
        var category = document.getElementById("category").value;
        var stock = document.getElementById("stock").value;
        var numberSelles = document.getElementById("nselles").value;
        // console.log(price);
        // console.log(category);
        // console.log(stock);
        // console.log(numberSelles);

        var data = JSON.stringify({"price": price,
        "category":category,
        "inStock":stock,
        "numberSelles":numberSelles
        });
        request.send(data);
    console.log('send was done with success');
       
        closeshowModifyProdForm();
    };
    closeButton.addEventListener("click", closeshowModifyProdForm);
    form.addEventListener("submit", submitTask);

}
function showModifyProdForm() {
    const formString = `
        <div class="backdrop hide">
          <div class="modal">
            <h2 class="title">Modify prod data</h2>
          
            <img class="close image-close" src="../images/close_icon.png">
           
         
            
            <form id="modUserForm" action="" method="POST">
              <label for="title">Name of product</label>
              <input type="text" name="prodName" id="prodName" required>
              <br>
              <label>data to modify</label>
              <br>
              <p><label for="title">Price</label></p>
              <input type="text" name="price" id="price">
              <p> <label for="title">Category</label></p>
              <input type="text" name="category" id="category">
              <p> <label for="title">Stock</label></p>
              <input type="text" name="inStock" id="stock">
              <p> <label for="title">Number selles</label></p>
              <input type="text" name="selles" id="nselles">
              <button class="btn-add" name="submit" type="submit">Find prod and modify</button>
            </form>
          </div>
        </div>
        `.trim();
    return compileToNode(formString);
}







//add form

function showAddProdForm() {
    console.log("show form");
    const form = document.body.appendChild(showAddingProdForm());

    form.classList.add("show");
    const closeButton = form.querySelector(".close");
    const closeshowAddingProdForm = () => {
        console.log("close succes");
        form.removeEventListener("submit", submitTask);
        closeButton.removeEventListener("click", closeshowAddingProdForm);
        form.classList.remove("show");
    };
    const submitTask = (event) => {
        event.preventDefault();

        const { target } = event;
        event.preventDefault();

        var request = new XMLHttpRequest();
        var url = "http://localhost/GameChanger/controller/productIndex.php/product";
        request.open("POST", url, true);
        request.setRequestHeader("Content-Type", "application/json");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                var jsonData = JSON.parse(request.response);
                console.log(jsonData);
            }
        };
        var name =  document.getElementById("productName").value;
        var type = document.getElementById("typ").value;
        var picture = document.getElementById("pict").value;
        var price = document.getElementById("price").value;
        var category = document.getElementById("category").value;
        var age = document.getElementById("aget").value;
        var nrplayers=document.getElementById("nrplayers").value;
        var rating = document.getElementById("rat").value;
        var stock = document.getElementById("stock").value;
        var year = document.getElementById("year").value;
        var colectional = document.getElementById("colect").value;
        var data = JSON.stringify({"name": name, 
        "type": type, 
        "picture_name": picture,
         "price": price,
        "category":category,
        "age_target":age,
        "number_of_players":nrplayers,
        "rating":rating,
        "productYear":year,
        "inStock":stock,
        "colectional":colectional
        });
        request.send(data);
    console.log('send was done with success');
        // const title = target.querySelector('[name="Pname"]').value;
        // console.log(title);
        closeshowAddingProdForm();
    };
    closeButton.addEventListener("click", closeshowAddingProdForm);
    form.addEventListener("submit", submitTask);

}
function showAddingProdForm() {
    const formString = `
        <div class="backdrop hide">
          <div class="modal">
            <h2 class="title">Add product</h2>
            <img class="close image-close" src="../images/close_icon.png">  
            <form id="addProdForm" action="" method="POST">
            <div class="form-group">
            <p><label for="title">Name of product</label></p>
            <input type="text" name="Pname" id="productName" required>
            </div>
            <div class="form-group">
            <p><label for="title">Type</label></p>
            <input type="text" name="type" id="typ">
            </div>
            <p><label for="title">Name picture</label></p>
            <input type="text" name="picture" id="pict">
            <p><label for="title">Price</label></p>
            <input type="text" name="price" id="price">
            <p><label for="title">Category</label></p>
            <input type="text" name="category" id="category">
            <p><label for="title">Age</label></p>
            <input type="text" name="aget" id="aget">
            <p><label for="title">Number of players</label></p>
            <input type="text" name="nbplayers" id="nrplayers">
            <p><label for="title">Rating</label></p>
            <input type="text" name="rating" id="rat">
            <br>
            <p> <label for="title">Stock</label></p>
            <input type="text" name="stock" id="stock">
            <br>
            <p><label for="title">Year</label></p>
            <input type="text" name="year" id="year">
            <p><label for="title">Colectional</label></p>
            <input type="text" name="colection" id="colect">
            <br>
              <button class="btn-add" name="submit" type="submit">Add product</button>
            </form>
          </div>
        </div>
        `.trim();
    return compileToNode(formString);
}