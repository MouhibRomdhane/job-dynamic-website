// add hovered class to selected list item


// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};
//pour afficher les detailes de loffre

let arrow = document.querySelector(".arrow");
let detail = document.querySelector(".details");
const arrows = document.querySelectorAll(".arrow");
arrows.forEach((arrow) => {
  arrow.addEventListener("click", (event) => {
    const details = event.target.nextElementSibling;
    event.target.classList.toggle("show");
    details.classList.toggle("show");
  });
});







