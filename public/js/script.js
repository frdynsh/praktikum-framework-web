const cards = document.querySelectorAll(".framework-item");
const popup = document.getElementById("imgPopup");
const popupImg = document.getElementById("imgPreview");
const closeBtn = document.querySelector(".close");

cards.forEach(card => {
    card.addEventListener("click", () => {
    popup.style.display = "flex";
    popupImg.src = card.dataset.img;
    });
});

closeBtn.onclick = () => popup.style.display = "none";
popup.onclick = (e) => { if (e.target === popup) popup.style.display = "none"; };