// Global Declaration
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
let username = document.getElementById("username").innerHTML.trim();
let dishName = document.getElementById("dish-name");
let dishDesc = document.getElementById("dish-desc");
let ingredients = document.getElementById("ingredient-post");
let instructions = document.getElementById("instruction-post");
let recipeCards = document.getElementById("recipe-cards");
let prv = document.getElementById("img-preview");
let prvContainer = document.getElementById("previewCon");
let prvText = document.getElementById("preview-text");
let fileUpload = document.getElementById("recipe-photo");
let createDish = document.getElementById("create-dish");
let search = document.getElementById("search-input");
let xmlhttp = new XMLHttpRequest();

// Style javascript
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

// end style javascript
//--------------------------------------------------------------------------------------//

// ----------- DISABLE BACKTICK -----------
// Useful for anticipating if the user enters input with BACKTICK
// then the BACKTICK will turn into a space
function disableBt(element) {
    element.value = element.value.split("`").join(" ");
}
// INPUT = is our file input element
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

// ----------- CALL RECIPE CARDS -----------
// every callCards() function is called it will display the recipecards page according to the username
function callCards() {
    // and then the function will execute when the response is ready (xmlhttp.onreadystatechange )
    xmlhttp.onreadystatechange = function() {
        // and when request finished and response is ready and the status is "OK"
        if (this.readyState == 4 && this.status == 200) {
            // it will Returns the response data as a string from resipeCards
            recipeCards.innerHTML = this.responseText;
            // so the data will display with coll openDetails function after 'load'
            this.addEventListener("load", openDetails);
        }
    }
    // we use xmlhttp.open to Specifies the request to the file location 
    // We set true this means that the server requests should be sent asynchronously.
    xmlhttp.open("GET", "../AAR/ajax/recipecards.php?username=" + username, true);
    xmlhttp.send();
}
callCards();

// ---------- RECIPE UPLOAD ---------- 
// Recipe upload to database through AJAX
createDish.addEventListener("click", function() {
    let dishName = document.getElementById("dish-name");
    let dishDesc = document.getElementById("dish-desc");
    let dishIngr = document.getElementById("ingredient-post");
    let dishInst = document.getElementById("instruction-post");
    // why we use .files[0]?
    // because each upload can send multiple files
    // so we limit this to .files[0] because we only want to upload one file/photo
    let photo = document.getElementById("recipe-photo").files[0];

    // FormData() will be used to send data and images to the server
    let formData = new FormData();

    // append() is used to add an element, 
    // with contents like the parameters that the function will indicate
    formData.append("dish-name", dishName.value);
    formData.append("dish-desc", dishDesc.value);
    formData.append("ingredient-post", dishIngr.value);
    formData.append("instruction-post", dishInst.value);
    formData.append("username", username);
    formData.append("photo", photo);
    
    // We check if each variable is not equal to empty then we run AJAX
    if (dishName.value.trim() != "" || dishDesc.value.trim() != "" || dishIngr.value.trim() != "" || dishInst.value.trim() != "") {
        let xmlhttp = new XMLHttpRequest();
        // we use xmlhttp.open to Specifies the request to the file location 
        // We set false this means that the server requests should be sent synchronously.
        xmlhttp.open("POST", "../AAR/ajax/uploadpic.php", false);
        // and Sends the request to the server
        xmlhttp.send(formData);
        // and then we call callCards() function
        callCards();
        // if no files are input then the preview will revert back to '-'
        prvText.innerHTML = "-";
        prv.style.display = "none";
        // and dashed here is to give a dotted line effect
        prvContainer.style.borderStyle = "dashed";
        // variable value becomes empty
        dishName.value = "";
        dishDesc.value = "";
        dishIngr.value = "";
        dishInst.value = "";
        // and with this method returns the element that has the ID "id01"
        //  with the specified value and display "none".
        document.getElementById("id01").style.display = "none";
    }
});


// -------- IMAGE PREVIEW ----------- //
// When the image starts to be uploaded it will always experience changes and perform the following functions
fileUpload.addEventListener("change", function(e) {
    prvText.innerHTML = fileUpload.value;
    prv.src = URL.createObjectURL(e.target.files[0]);
    prv.style.display = "block";
    prvContainer.style.borderStyle = "none";
});



////////////////////////////////////////////////////////////////////////////////////////////////////
// ---------------------------- UPDATE DETAILS DATA -------------------------------------------//

// Change the recipe detail layout into input boxes and textarea
function changetoInput () {
    // every time the editbutton is clicked it will run the following function
    document.getElementById("editbtn").addEventListener("click", function() {
        // First of all we declare the variable by calling it based on the id of each from input
        // and we add a trim() method here to remove the whitespace from the left and right
        let preName = document.getElementById("name-con").innerHTML.trim();
        let preDesc = document.getElementById("description-con").innerHTML.trim();
        let preIngr = document.getElementById("ingredient-con").innerHTML.trim();
        let preInst = document.getElementById("instruction-con").innerHTML.trim();
        
        // after that display the contents of the input with an 'id' of type text with their respective 'id'
        document.getElementById("name-con").innerHTML = '<input id="update-name" name="update-name" type="text" style="width: 400px">';
        // After the input changes, it will be saved by declaring a new variable
        let nameUpdate = document.getElementById("update-name");
        // the name that has been updated then the value will be saved as a new variable
        nameUpdate.value = preName;
        
        // furthermore, below we also do the same thing
        // The difference is we added a trim() method to remove the whitespace
        // and add <br> to give enter 
        document.getElementById("description-con").innerHTML = '<textarea name="update-desc" id="update-desc" cols="80" rows="3" class="update-ta"></textarea>';
        let descUpdate = document.getElementById("update-desc");
        descUpdate.value = preDesc.trim().split("<br>").join("");
        
        document.getElementById("ingredient-con").innerHTML = '<textarea name="update-ingr" id="update-ingr" cols="80" rows="5" class="update-ta"></textarea>';
        let ingrUpdate = document.getElementById("update-ingr");
        ingrUpdate.value = preIngr.split("<br>").join("");
        
        document.getElementById("instruction-con").innerHTML = '<textarea name="update-inst" id="update-inst" cols="80" rows="5" class="update-ta"></textarea>';
        let instUpdate = document.getElementById("update-inst");
        instUpdate.value = preInst.split("<br>").join("");

        // After all the inputs have changed, and the variable we use is the Update variable
        // every update input we give function()disableBt to prevent backtick in every input
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

        // after that each input value will be stored in the recipeID variable
        let recipeID = this.getAttribute("value");
        // and finally the updated input inside 'id=edit-container' it will be saved 
        // with a save button whose type is submit with the same id that is 'editbtn'
        document.getElementById("edit-container").innerHTML = '<button id="editbtn" value=' + recipeID + ' name="update" type="submit" class="editbtn" style="padding-bottom:7px;">Save</button>'

    })
}



// -------- OPEN RECIPE DETAILS --------
// Assign ajax called elements with a function to open recipe details
function openDetails() {
    let cards = document.getElementsByClassName("openDetails");
    for(let i = 0; i < cards.length; i++) {
        // every time user click the contents it will open the recipe details
        cards[i].addEventListener("click", function() {
            let recipeID = this.getAttribute("value");
            // xmlhttp.onreadystatechange will execute when the response is ready.
            xmlhttp.onreadystatechange = function () {
                // and when request finished and response is ready and the status is "OK"
                if (this.readyState == 4 && this.status == 200) {
                    let container = document.getElementById("id02");
                    container.innerHTML = "Fetching data...";
                    let response = this.responseText;
                    container.innerHTML = response;
                    // after load it will call changetoInput function
                    this.addEventListener("load", changetoInput);
                }
            }
            // To send a request to a server, we use xmlhttp.open to Specifies the request to the file location 
            // We set true this means that the server requests should be sent asynchronously.
            // From this file location whatever is displayed according to the input search keyword performed by the user
            xmlhttp.open("GET", "../AAR/ajax/getrecipe.php?keyword=" + recipeID, true);
            // and finally Sends the request to the server
            // we used empty inside method send() because we using GET
            xmlhttp.send();
        });
    }
}



////////////////////////////////////////////////////////////////////////////////////////////////////
// ----------------------------- LIVE SEARCH ----------------------------- 

// every time we put the contents in a seacrh input
// every time there is a change in the content it will make changes in this ajax
// even if the changes are small it will change the content because it will read the keywords
search.addEventListener("input", () => {
    // and then it will execute when the response is ready (xmlhttp.onreadystatechange )
    // onreadystatechange 
    // and the function is called every time the readyState changes.
    xmlhttp.onreadystatechange = function () {
        // and when request finished and response is ready and the status is "OK"
        if (this.readyState == 4 && this.status == 200) {
            // it will Returns the response data as a string from resipeCards
            recipeCards.innerHTML = this.responseText;
            // and then after load it will call functiion openDetails
            this.addEventListener("load", openDetails);
        }
    }
    // To send a request to a server, we use xmlhttp.open to Specifies the request to the file location 
    // We set true this means that the server requests should be sent asynchronously.
    // From this file location whatever is displayed according to the input search keyword performed by the user
    xmlhttp.open("GET", "../AAR/ajax/recipecards.php?keyword=" + search.value + "&username=" + username, true);
    // and finally Sends the request to the server
    //... we used empty inside method send() because we using GET
    xmlhttp.send();
});
