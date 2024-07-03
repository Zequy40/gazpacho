let cursor1 = document.querySelector(".cursor--1");
let cursor2 = document.querySelector(".cursor--2");
let cursor3 = document.querySelector(".cursor--3");
let cursor4 = document.querySelector(".cursor--4");


function changeText(){
    if(cursor1.classList.contains('block')){
       cursor2.classList.add('block');
       cursor1.classList.remove('block');
    }else if(cursor2.classList.contains('block')){
       cursor3.classList.add('block');
       cursor2.classList.remove('block');
    }else if(cursor3.classList.contains('block')){
       cursor4.classList.add('block');
       cursor3.classList.remove('block');
    }
    else if(cursor4.classList.contains('block')){
      cursor1.classList.add('block');
      cursor4.classList.remove('block');
   }
 }
 
 setInterval(changeText, 6000);

