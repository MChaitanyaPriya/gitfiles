const cost=15999;
let discount=20;
const c=9999;
let d=50;
document.getElementById("cost").textContent=cost;
document.getElementById("discount").textContent=discount + "%";
// function diclaration
function Discount(tax){
    discount=10999;
    tax=15;
    document.getElementById("discount").textContent=tax+"%";
    document.getElementById("display").textContent=discount;
}

// function expression
document.getElementById("c").textContent=c;
document.getElementById("d").textContent=d + "%";

const Dis=function(){
    d=5999;
    document.getElementById("r").textContent=d;
}
Dis();

let Disc=()=>{
    discount=19999
    document.getElementById("disp").textContent=discount;
}
Disc();
// return a statement
function Booking(){
    document.getElementById("res").textContent="Thanks For Booking 💖"
}
function Booking(){
    let conf=confirm("Do you want to book The Hotel ?")
    if(conf){
         alert("thanks For Booking 💖");
    }
}
function search(){
    let place=prompt("Enter place to search hotel:");
    if(place){
        alert("Sorry  hotel  is not available");
    }
}


