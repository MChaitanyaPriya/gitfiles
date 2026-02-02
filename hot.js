function search(){
    const place=document.getElementById("place").value;
    if(place===""){
        alert("⚠ Please enter a place to search hotels");
    }
    else{
        alert("🔍 Seaching hotels in "+place);

    }
}
function bookHotel(){
    if(confirm("Do you want to confirm your bookin?")){
        alert("✅ Booking successful! \n Thank you for choosing us 💖");
    }
    else{
        alert("❌ Booking cancelled");
    }
}
const cards=document.querySelectorAll(".middle");
cards.forEach(card=>{
    card.addEventListener("mouseenter",()=>{
        card.style.boxShadow="0 10px 25px rgba(0,0,0,0.2)";
        card.style.transform="translateY(-5px)";
        card.style.transition="0.3s";
    });
    card.addEventListener("mouseleave",()=>{
        card.style.boxShadow="0 4px 10px rgba(0,0,0,0.08)";
        card.style.transform="translateY(0)";
    });
});
function likeHotel(icon){
    icon.classList.toggle("liked");
    if(icon.classList.contains("liked")){
        icon.innerHTML="🧡";
    }
    else{
        icon.innerHTML="🤍";
    }
}