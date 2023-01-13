//Target DOM elements
// const inpUser = document.querySelector('#utilisateur');
// const inpEmail = document.querySelector('#email');
// const inpPassword = document.querySelector('#password');
// const inpConfirm = document.querySelector('#passwordconf');
// const allImg = document.querySelectorAll('.icone-verif');
// const allSpan = document.querySelectorAll('.message-alerte');
// const allLigne = document.querySelectorAll('.ligne div');
// const numInput=document.querySelector('#numInput')

// numInput.addEventListener('input', (e)=>{

//     if(e.target.value.length >= 8) {
//         allImg[4].style.display = "inline";
//         allImg[4].src = "../ressources/svg/check.svg";
//         allSpan[4].style.display = "none";
//     }   
//     else {
//         allImg[4].style.display = "inline";
//         allImg[4].src = "../ressources/svg/error.svg";
//         allSpan[4].style.display = "inline";
//     }
// })

// //check username length
// inpUser.addEventListener('input', (e) => {
//     if(e.target.value.length >= 3) {
//         allImg[0].style.display = "inline";
//         allImg[0].src = "../ressources/svg/check.svg";
//         allSpan[0].style.display = "none";
//     }   
//     else {
//         allImg[0].style.display = "inline";
//         allImg[0].src = "../ressources/svg/error.svg";
//         allSpan[0].style.display = "inline";
//     }
// })

// //check email
// inpEmail.addEventListener('input', (e) => {
//     const regexEmail = /\S+@\S+\.\S+/;
//     //search methods will search for regexEmail in the input value and return the position of the match, if it is 0 it is a valid match
//     if(e.target.value.search(regexEmail) === 0){

//         allImg[1].style.display = "inline";
//         allImg[1].src = "../ressources/svg/check.svg";
//         allSpan[1].style.display = "none";

//     //if the position is -1 it means that there is no match, the input value doesn't contain regexEmail
//     } else if(e.target.value.search(regexEmail) === -1) {

//         allImg[1].style.display = "inline";
//         allImg[1].src = "../ressources/svg/error.svg";
//         allSpan[1].style.display = "inline";

//     }
// })

// //check password, if it contains at least 1 special character, 1 letter, 1 number
// let inpValue;
// const specialCar = /[^a-zA-Z0-9]/;
// const letters = /[a-z]/i;
// const numbers = /[0-9]/;

// let objValidation = {
//     symbole : 0,
//     letter : 0,
//     number : 0
// }

// inpPassword.addEventListener('input', (e) => {

//     inpValue = e.target.value;

//     if(inpValue.search(specialCar) !== -1){
//         objValidation.symbole = 1;
//     }
//     if(inpValue.search(letters) !== -1){
//         objValidation.letter = 1;
//     }
//     if(inpValue.search(numbers) !== -1){
//         objValidation.number = 1;
//     }

//     //the inputType property returns the type of change that was done by the event
//     if(e.inputType = 'deleteContentBackward'){
//         if(inpValue.search(specialCar) === -1){
//             objValidation.symbole = 0;
//         }
//         if(inpValue.search(letters) === -1){
//             objValidation.letter = 0;
//         }
//         if(inpValue.search(numbers) === -1){
//             objValidation.number = 0;
//         }
//     } 

//     let testAll = 0;
//     for(const property in objValidation){
//         if(objValidation[property] > 0){
//             testAll++;
//         }
//     }
//     if(testAll < 3){
//         allSpan[2].style.display = "inline";
//         allImg[2].style.display = "inline";
//         allImg[2].src = "../ressources/svg/error.svg";
//     } else {
//         allSpan[2].style.display = "none";
//         allImg[2].src = "../ressources/svg/check.svg";
//     }


//     // test if password strong and indicate to user
//     if(inpValue.length <= 6 && inpValue.length > 0){
//         allLigne[0].style.display = 'block';
//         allLigne[1].style.display = 'none';
//         allLigne[2].style.display = 'none';
//     }
//     else if (inpValue.length > 6 && inpValue.length <= 9) {
//         allLigne[0].style.display = 'block';
//         allLigne[1].style.display = 'block';
//         allLigne[2].style.display = 'none';
//     }
//     else if (inpValue.length > 9) {
//         allLigne[0].style.display = 'block';
//         allLigne[1].style.display = 'block';
//         allLigne[2].style.display = 'block';
//     }
//     else if (inpValue.length === 0) {
//         allLigne[0].style.display = 'none';
//         allLigne[1].style.display = 'none';
//         allLigne[2].style.display = 'none';
//     }


// })

// //password confirmation
// inpConfirm.addEventListener('input', (e) => {

//     if(e.target.value.length === 0){
//         allImg[3].style.display = "inline";
//         allImg[3].src = "../ressources/svg/error.svg";
//         allSpan[3].style.display = "block";
//     }
//     else if(e.target.value === inpValue){
//         allImg[3].style.display = "inline";
//         allImg[3].src = "../ressources/svg/check.svg";
//         allSpan[3].style.display = "none";

//     } else {
//         allImg[3].style.display = "inline";
//         allImg[3].src = "../ressources/svg/error.svg";
//         allSpan[3].style.display = "block";
//     }

// })

//Ajax check inscription validation

// let res=document.querySelector("#res");
let register_form=document.querySelector("#addToCard");
// let result=document.querySelector(".resultt");
// let iconeverify=document.querySelector('.icone-verify')

//Une fonction qui retourne les elements soumis a travers le formulaire sauf ceux ayant 
//un attribut de type viewport ou sumit
function serialize(form){
    let requestArray=[];
    form.querySelectorAll('[name]').forEach((element) => {
        if(element.name!=="viewport" && element.name!=="submit"){
            requestArray.push(element.name+ '=' + element.value);
        }
    });

    if(requestArray.length>0){
        return requestArray.join('&');
    }else{
        return false;
    }
}

//Code ajax;
register_form.addEventListener('submit', function(event){
    event.preventDefault();
    let xhttp= new XMLHttpRequest();
    let form_url="CardController/addToCard";
    let parameters=serialize(register_form);
    console.log(parameters);
    xhttp.open("POST", form_url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.onreadystatechange=function(){
        //En cas d'erreur
        
        if(xhttp.readyState==4 && xhttp.status==200){
            //message retourner par le serveur , ici le fichier php
            // this.setCustomValidity(xhttp.responseText);
            console.log(xhttp.responseText);
            res.innerHTML=xhttp.responseText;     
            
            // if(xhttp.responseText=="Inscription réussi"){
            //     iconeverify.setAttribute('src', "../ressources/svg/check.svg ")
            //     setTimeout(() => {
            //         window.location.href="/customers/login";
            //     }, 2000);
            // }
        }
    }
    xhttp.send(parameters);
    // result.style.display="inline-block";

});


/***********form inscription validation check */


/***********form validation check end */






