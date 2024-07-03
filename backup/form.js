let title = document.getElementById('title');
let title1 = document.getElementById('title1');
let title2 = document.getElementById('title2');
let title3 = document.getElementById('title3');
let title4 = document.getElementById('title4');
let title5 = document.getElementById('title5');
let title6 = document.getElementById('title6');
let title7 = document.getElementById('title7');
let title8 = document.getElementById('title8');
let menu_check = document.getElementById('menu_check');
let pre = document.getElementById('pr');
let pre1 = document.getElementById('pr1');
let pre2 = document.getElementById('pr2');
let option = document.getElementById('option');
let option2 = document.getElementById('option2');
let option3 = document.getElementById('option3');


let btn = document.getElementById('command-btn');
let result = document.getElementById('result');
let result2 = document.getElementById('result2');
let result3 = document.getElementById('result3');


title.addEventListener("change", validateOrder);
function validateOrder() {
 let checked = title.checked;

    if(checked){
        btn.classList.add('visible');
        result.innerHTML = pre.value;
       
    }else{
        result.innerHTML = "Vide";
    }
    
} 

title1.addEventListener("change", validateOrder1);
function validateOrder1() {
 let checked1 = title1.checked;

    if(checked1){
        btn.classList.add('visible');
        result2.innerHTML = pre1.value;
        console.log(pre1.value);
       
    }else{
        result2.innerHTML = "";
    
    }
    
} 

title2.addEventListener("change", validateOrder2);
function validateOrder2() {
 let checked2 = title2.checked;

    if(checked2){
        btn.classList.add('visible');
        result3.innerHTML = pre2.value;
       
    }else{
        result3.innerHTML = "";
    }
    
} 




// title3.addEventListener("change", validateOrder3);
// function validateOrder3() {
//  let checked3 = title3.checked;

//     if(checked3){
//         btn.classList.add('visible');
//     }
    
// } 

// title4.addEventListener("change", validateOrder4);
// function validateOrder4() {
//  let checked4 = title4.checked;

//     if(checked4){
//         btn.classList.add('visible');
//     }
    
// } 

// title5.addEventListener("change", validateOrder5);
// function validateOrder5() {
//  let checked5 = title5.checked;

//     if(checked5){
//         btn.classList.add('visible');
//     }
    
// } 

// title6.addEventListener("change", validateOrder6);
// function validateOrder6() {
//  let checked6 = title6.checked;

//     if(checked6){
//         btn.classList.add('visible');
//     }
    
// } 

// title7.addEventListener("change", validateOrder7);
// function validateOrder7() {
//  let checked7 = title7.checked;

//     if(checked7){
//         btn.classList.add('visible');
//     }
    
// } 

// title8.addEventListener("change", validateOrder8);
// function validateOrder8() {
//  let checked8 = title8.checked;

//     if(checked8){
//         btn.classList.add('visible');
//     }
    
// } 



    