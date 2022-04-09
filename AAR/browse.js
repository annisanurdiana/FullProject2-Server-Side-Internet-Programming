/* 
Untuk file browse.js ini bedanya hanya untuk menunjukkan semuanya dan bukan punya usernya saja 
*/

// Style javascript
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

hamburger.addEventListener("click", mobileMenu);

function mobileMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}

const navLink = document.querySelectorAll(".nav-link");

navLink.forEach(n => n.addEventListener("click", closeMenu));

function closeMenu() {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
}

let date = new Date();
let day = String(date.getDate()).padStart(2, '0');
let month = String(date.getMonth() + 1).padStart(2, '0');
let year = date.getFullYear();
date = month + '/' + day + '/' + year;
document.getElementById('date').text = date;

// Get the modal
let modal = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Get the modal_2 = new_recipecards.php >> new_getrecipe.php
let modal_2 = document.getElementById('id02');
// When the user clicks anywhere outside of the modal_2, close it
window.onclick = function(event) {
    if (event.target == modal_2) {
        modal_2.style.display = "none";

    }
}

// end style javascript
//-------------------------------------------------------------------------------//

// Deklarasikan beberapa variable yang dipanggil berdasarkan id masing-masing
//...
let username = document.getElementById("username").innerHTML.trim();
let dishName = document.getElementById("dish-name");
let dishDesc = document.getElementById("dish-desc");
let ingredients = document.getElementById("ingredient-post");
let instructions = document.getElementById("instruction-post");

// Kita buat function disableBt untuk merubah BACK TICK menjadi spasi
//...
function disableBt(element) {
    element.value = element.value.split("`").join(" ");
}

// Berikut kiga gunakan method addEventListener()
// Merupakan method yang berfungsi untuk membuat event (input) untuk keperluan manipulasi DOM.
//...
dishName.addEventListener("input", function() {
    disableBt(this);
});
dishDesc.addEventListener("input", function() {
    disableBt(this);
});
ingredients.addEventListener("input", function() {
    disableBt(this);
});
instructions.addEventListener("input", function() {
    disableBt(this);
});

//
let recipeCards = document.getElementById("recipe-cards");
function callCards() {
    let xmlhttp3 = new XMLHttpRequest();
    xmlhttp3.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            recipeCards.innerHTML = this.responseText;
            this.addEventListener("load", openDetails);
        }
    }
    xmlhttp3.open("GET", "../AAR/ajax/recipecards.php?username=" + username, true);
    xmlhttp3.send();
}
callCards();


// Recipe upload to database through AJAX
// Deklarasikan beberapa variable yang dipanggil berdasarkan id masing-masing
// ...
let prv = document.getElementById("img-preview");
let prvContainer = document.getElementById("previewCon");
let prvText = document.getElementById("preview-text");
let fileUpload = document.getElementById("recipe-photo");
let createDish = document.getElementById("create-dish");

// Berikut kiga gunakan method addEventListener() untuk createDish
// Merupakan method yang berfungsi untuk membuat event (input) untuk keperluan manipulasi DOM.
//...
createDish.addEventListener("click", function() {
    // Didalam method ini kita deklarasikan beberapa variable yang dipanggil berdasarkan id masing-masing
    //..
    let dishName = document.getElementById("dish-name");
    let dishDesc = document.getElementById("dish-desc");
    let dishIngr = document.getElementById("ingredient-post");
    let dishInst = document.getElementById("instruction-post");
    let photo = document.getElementById("recipe-photo").files[0];

    // Kita deklarasikan formData dengan function FormData
    let formData = new FormData();
    formData.append("dish-name", dishName.value);
    formData.append("dish-desc", dishDesc.value);
    formData.append("ingredient-post", dishIngr.value);
    formData.append("instruction-post", dishInst.value);
    formData.append("username", username);
    formData.append("photo", photo);
    
    // kita lakukan pengecekan jika semua telah diisi makan akan diteruskan
    // ...
    if (dishName.value.trim() != "" || dishDesc.value.trim() != "" || dishIngr.value.trim() != "" || dishInst.value.trim() != "") {
        // Deklarasikan ajax dengan nama xmlhttp2
        let xmlhttp2 = new XMLHttpRequest();
        //kita atur false, karena kita tidak ingin dia asynchonus
        xmlhttp2.open("POST", "../AAR/ajax/uploadpic.php", false);
        xmlhttp2.send(formData);
        // setelah itu panggil function callCards()
        callCards();
        prvText.innerHTML = "-";
        prv.style.display = "none";
        prvContainer.style.borderStyle = "dashed";
        dishName.value = "";
        dishDesc.value = "";
        dishIngr.value = "";
        dishInst.value = "";
        document.getElementById("id01").style.display = "none";
    }
});

// Image Preview
// kita deklarasikan fileUpload sesuai dengan id "recipe-photo"
//...
let fileUpload = document.getElementById("recipe-photo");
fileUpload.addEventListener("change", function(e) {
    prvText.innerHTML = fileUpload.value;
    // 
    prv.src = URL.createObjectURL(e.target.files[0]);
    prv.style.display = "block";
    prvContainer.style.borderStyle = "none";
});
//-------------------------------------------------------------------------------//


function changetoInput () {
    document.getElementById("editbtn").addEventListener("click", function() {

        let preName = document.getElementById("name-con").innerHTML.trim();
        let preDesc = document.getElementById("description-con").innerHTML.trim();
        let preIngr = document.getElementById("ingredient-con").innerHTML.trim();
        let preInst = document.getElementById("instruction-con").innerHTML.trim();
        
        
        document.getElementById("name-con").innerHTML = '<input id="update-name" name="update-name" type="text" style="width: 400px">';
        let nameUpdate = document.getElementById("update-name");
        nameUpdate.value = preName;
        
        document.getElementById("description-con").innerHTML = '<textarea name="update-desc" id="update-desc" cols="80" rows="3" class="update-ta"></textarea>';
        let descUpdate = document.getElementById("update-desc");
        descUpdate.value = preDesc.split("<br>").join("");
        
        document.getElementById("ingredient-con").innerHTML = '<textarea name="update-ingr" id="update-ingr" cols="80" rows="5" class="update-ta"></textarea>';
        let ingrUpdate = document.getElementById("update-ingr");
        ingrUpdate.value = preIngr.split("<br>").join("");
        
        document.getElementById("instruction-con").innerHTML = '<textarea name="update-inst" id="update-inst" cols="80" rows="5" class="update-ta"></textarea>';
        let instUpdate = document.getElementById("update-inst");
        instUpdate.value = preInst.split("<br>").join("");
        
        nameUpdate.addEventListener("input", function() {
            disableBt(this);
        });
        descUpdate.addEventListener("input", function() {
            disableBt(this);
        });
        ingrUpdate.addEventListener("input", function() {
            disableBt(this);
        });
        instUpdate.addEventListener("input", function() {
            disableBt(this);
        });

        let recipeID = this.getAttribute("value");
        document.getElementById("edit-container").innerHTML = '<button id="editbtn" value=' + recipeID + ' name="update" type="submit" class="editbtn" style="padding-bottom:7px;">Save</button>'

    })
}

// Function to assign event listener to all recipe cards
function openDetails() {
    let cards = document.getElementsByClassName("openDetails");
    for(let i = 0; i < cards.length; i++) {
        cards[i].addEventListener("click", function() {
            let recipeID = this.getAttribute("value");
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let container = document.getElementById("id02");
                    container.innerHTML = "Fetching data...";
                    let response = this.responseText;
                    container.innerHTML = response;

                    this.addEventListener("load", changetoInput);
                }
            }
            xmlhttp.open("GET", "../AAR/ajax/getrecipe.php?keyword=" + recipeID + "&browse=true", true);
            xmlhttp.send();
        });
    }
}

// 
let search = document.getElementById("search-input");
search.addEventListener("input", () => {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            recipeCards.innerHTML = this.responseText;
            this.addEventListener("load", openDetails);
        }
    }
    xmlhttp.open("GET", "../AAR/ajax/recipecards.php?keyword=" + search.value, true);
    xmlhttp.send();
});
