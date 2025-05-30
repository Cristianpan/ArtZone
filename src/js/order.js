const viewDetailsBtns = document.querySelectorAll(".order-card__button");

viewDetailsBtns.forEach((viewDetailsBtn) =>
  viewDetailsBtn.addEventListener("click", showDetailsData)
);

function  showDetailsData({target:button}) {
  const id = button.getAttribute('data-orderId'); 

  
  document.getElementById(id).classList.toggle("order-card__body--none")
  if (button.textContent == "Ver más") {
    button.textContent = "Ver menos"
  } else {
    button.textContent = "Ver más"
  }
}