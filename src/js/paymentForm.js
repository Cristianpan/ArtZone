import Swal from "sweetalert2";

document
  .querySelector(".payment-form")
  .addEventListener("submit", processPayment);
document
  .querySelector(".payment-buttons__button--cancel")
  .addEventListener("click", showModal);

async function processPayment(e) {
  e.preventDefault();
  removeErrorMessages();
  const result = await Swal.fire({
    html: `<h1 class="sweet__logo">Art Zone</h1>
          <h2 class="sweet__title sweet__title--success">Realizar Compra</h2>
          <p class="sweet__text">¿Estás seguro de realizar la compra?<p>
          `,
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonText: "De Acuerdo",
  });

  if (result.isConfirmed) {
    sendData(getFormDataAsJson(e.target));
  }
}

async function sendData(formData) {
  const url = "/store/payment";
  const data = location.href.includes("artItem")
    ? JSON.parse(localStorage.getItem("artItem"))
    : JSON.parse(localStorage.getItem("cartItems"));

  const result = await fetch(url, {
    method: "POST",
    body: JSON.stringify({ items: data, details: formData }),
    headers: {
      "Content-Type": "application/json",
    },
  });

  const response = await result.json();

  await Swal.fire({
    html: `<h1 class="sweet__logo">Art Zone</h1>
            <h2 class="sweet__title sweet__title--success">${
              response.ok ? "¡Compra exitosa!" : "Oops! Algo ha salido mal"
            }</h2>
            <p class="sweet__text">${response.message}<p>
            `,
    confirmButtonText: "De Acuerdo",
  });
  if (response.ok) {
    if (location.href.includes('shoppingCart')){
      localStorage.removeItem('cartItems');
    } else {
      localStorage.removeItem('artItem');
    }
    location.reload();
  } else {
    generateErrorMessages(response.body);
  }
}

function showModal() {
  const modal = document.querySelector(".modal");
  modal.classList.toggle("modal--visible");
  modal.classList.toggle("modal--none");
}

function getFormDataAsJson(form) {
  const formData = new FormData(form);
  const jsonData = {};

  formData.forEach((value, key) => {
    jsonData[key] = value;
  });

  return jsonData;
}

let alerts = []
function generateErrorMessages(errorMessages) {
  for (const key in errorMessages) {
    const inputReference = document.getElementsByName(key)[0];
    const alert = document.createElement("div");
    alert.classList.add("alert");
    alert.classList.add("alert-danger");
    alert.textContent = errorMessages[key];

    alerts = [...alert, alert];
    inputReference.before(alert);
  }
}

function  removeErrorMessages() {
  alerts.forEach(alert => alert.remove()); 
  alerts = [];
}
