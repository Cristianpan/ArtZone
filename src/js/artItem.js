import Swal from "sweetalert2";
let hola = "Mundo"; 

document.addEventListener("DOMContentLoaded", addEventListeners);

function addEventListeners() {
  const navigationButtons = document.querySelectorAll(
    ".art-item__btn-navigation"
  );

  navigationButtons.forEach((element) => {
    element.addEventListener("click", (e) => {
      showSection(e);
      activeButtons(e);
    });
  });

  document
    .querySelector(".art-item__button--add-cart")
    .addEventListener("click", addToShoppingCart);

  document
    .querySelector(".art-item__button--buy")
    .addEventListener("click", (e) => {showModal(e); createItemToBuy(e)});
}

function activeButtons({ target: button }) {
  document
    .querySelector(".art-item__btn-navigation--active")
    .classList.remove("art-item__btn-navigation--active");
  button.classList.add("art-item__btn-navigation--active");
}

function showSection(e) {
  const sections = document.querySelectorAll(".art-item__section");

  sections.forEach((section) => {
    if (!section.classList.contains(e.target.id)) {
      section.classList.remove("art-item__section--active");
    } else {
      section.classList.add("art-item__section--active");
    }
  });
}

async function addToShoppingCart({ target: button }) {
  const confirm = await Swal.fire({
    html: `<h1 class="sweet__logo">Art Zone</h1>
      <h2 class="sweet__title sweet__title--success">Añadir al Carrito</h2>
      <p class="sweet__text">¿Desea agregar esta obra a su carrito?<p>
      `,
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonText: "De Acuerdo",
  });

  if (confirm.isConfirmed) {
    const artItemId = button.getAttribute("data-artItemId");
    const userId = button.getAttribute("data-userId");
    const name = document.querySelector(".art-item__title").textContent;
    const autor = document.querySelector(".art-item__autor").textContent;
    const price = document.querySelector(".art-item__price").textContent;
    const image = document.querySelector(".art-item__image").src;
    const description = document.querySelector(
      ".art-item__description"
    ).textContent;
    const cartItems = JSON.parse(localStorage.getItem("cartItems")) ?? [];

    if (!cartItems.some((item) => item.artItemId == artItemId)) {
      localStorage.setItem(
        "cartItems",
        JSON.stringify([
          ...cartItems,
          {userId, artItemId, name, autor, price, description, image },
        ])
      );
    }
  }
}

function showModal() {
  const modal = document.querySelector(".modal");
  modal.classList.toggle("modal--visible");
  modal.classList.toggle("modal--none");
}

function createItemToBuy({target:button}) {
  const artItemId = button.getAttribute("data-artItemId");
  const userId = button.getAttribute("data-userId");
  const price = button.getAttribute("data-price");

  localStorage.setItem('artItem', JSON.stringify([{artItemId, userId, price}]));
}
