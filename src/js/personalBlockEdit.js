import Swal from "sweetalert2";
import Swiper from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

let personalBlock = {
  id: 0,
  title: "",
  description: "",
};

let swiper;

document.addEventListener("DOMContentLoaded", addEventListeners);

function addEventListeners() {
  document
    .querySelector(".personals-block-edit__add")
    .addEventListener("click", showModal);
  document
    .querySelector(".buttons__button--cancelar")
    .addEventListener("click", showModal);
  const editBtns = document.querySelectorAll(
    ".personal-blocks-buttons__button--edit"
  );
  const deleteBtns = document.querySelectorAll(
    ".personal-blocks-buttons__button--delete"
  );

  document.querySelector(".modal-form").addEventListener("submit", sendData);
  createCarrusel();

  editBtns.forEach((element) => {
    element.addEventListener("click", (e) => {
      showModal();
      setData(e.target);
    });
  });

  deleteBtns.forEach((element) => {
    element.addEventListener("click", (e) => {
      deletePersonalBlock(e);
    });
  });
}

function showModal() {
  const modal = document.querySelector(".modal");
  modal.classList.toggle("modal--visible");
  modal.classList.toggle("modal--none");
}

function setData(target) {
  const id = target.getAttribute("data-id");
  const element = document.querySelector(`#block-${id}`);
  const blockName = element.querySelector(".personal-blocks__title").innerText;
  const blockDescription = element.querySelector(
    ".personal-blocks__text"
  ).innerText;

  personalBlock = { ...personalBlock, id };

  document.querySelector(".modal #block-name").value = blockName;
  document.querySelector(".modal #block-description").value = blockDescription;
}

async function sendData(e) {
  e.preventDefault();
  removeErrorMessages();
  const { target: form } = e;
  const title = form.title.value;
  const description = form.description.value;
  personalBlock = { ...personalBlock, title, description };

  const userId = document.querySelector("#userId").value;

  const result = personalBlock.id
    ? await updatePersonalBlock(personalBlock, userId)
    : await createPersonalBlock(personalBlock, userId);

    if (result) {
      e.target.reset();
    }
}

async function updatePersonalBlock(personalBlock, userId) {
  const result = await fetch(
    `/profile/${userId}/personalBlock/${personalBlock.id}`,
    {
      method: "PUT",
      body: JSON.stringify(personalBlock),
      headers: {
        "Content-Type": "application/json",
      },
    }
  );

  const response = await result.json();

  if (response.ok) {
    createAlert("success", "¡Actualización Exitosa!", response.message);
    updateElementPersonalBlock(response.body);
    showModal();
    return true;
  } else {
    createAlert(
      "error",
      "¡Oops! Ha ocurrido un error al actualizar tu historia",
      response.message
    );

    generateErrorMessages(response.body);
    return false;
  }
}

async function createPersonalBlock(personalBlock, userId) {
  const result = await fetch(`/profile/${userId}/personalBlock`, {
    method: "POST",
    body: JSON.stringify(personalBlock),
    headers: {
      "Content-Type": "application/json",
    },
  });

  const response = await result.json();

  if (response.ok) {
    createAlert("success", "¡Registro Exitoso!", response.message);
    insertPersonalBlock(response.body);
    showModal();
    return true;
  } else {
    createAlert(
      "error",
      "¡Oops! Ha ocurrido un error al crear tu historia",
      response.message
    );
    generateErrorMessages(response.body);
    return false;
  }
}

async function deletePersonalBlock(e) {
  e.preventDefault();

  const confirm = await Swal.fire({
    html: `<h1 class="sweet__logo">Art Zone</h1>
      <h2 class="sweet__title sweet__title--success">Eliminar bloque personal</h2>
      <p class="sweet__text">¿Estás seguro de realizar esta acción? Una vez realizada no se podrá deshacer<p>
      `,
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonText: "De Acuerdo",
  });
  if (confirm.isConfirmed) {
    const userId = document.querySelector("#userId").value;
    const id = e.target.getAttribute("data-id");

    const result = await fetch(`/profile/${userId}/personalBlock/${id}`, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
    });

    const response = await result.json();

    if (response.ok) {
      createAlert(
        "success",
        "¡Eliminación Exitosa!",
        "Tu historia ha sido eliminada con éxito"
      );
      document
        .querySelector(`#block-${response.body.personalBlockId}`)
        .remove();
      swiper.update();
    } else {
      createAlert(
        "error",
        "¡Oops ha ocurrido un error al eliminar tu historia!",
        response.message
      );
    }
  }
}

let alerts = [];

function generateErrorMessages(errorMessages) {
  const form = document.querySelector(".modal-form");
  for (const key in errorMessages) {
    const inputReference = form[key];
    const alert = document.createElement("div");
    alert.classList.add("alert");
    alert.classList.add("alert-danger");
    alert.textContent = errorMessages[key];

    alerts = [...alerts, alert];
    inputReference.before(alert);
  }
}

function removeErrorMessages() {
  alerts.forEach((alert) => alert.remove());
  alerts = []
}

function insertPersonalBlock({ personalBlockId, title, description }) {
  document.querySelector(".personal-block-none")?.remove();
  const container = document.querySelector(
    ".personal-block-wrapper > .swiper-wrapper"
  );
  let numberElements = container.children.length;

  const div = document.createElement("div");
  div.id = `block-${personalBlockId}`;
  div.classList.add(
    "swiper-slide",
    "personal-blocks__block",
    `personal-blocks__block--${(++numberElements % 3) + 1}`
  );
  div.innerHTML = `
  <h3 class="personal-blocks__title">${title}</h3>
  <p class="personal-blocks__text">
      ${description}
  </p>
  `;
  const personalBlocksButtonsContainer = document.createElement("div");
  personalBlocksButtonsContainer.className = "personal-blocks-buttons";

  const editButton = document.createElement("button");
  editButton.setAttribute("data-id", personalBlockId);
  editButton.className =
    "personal-blocks-buttons__button personal-blocks-buttons__button--edit";
  const editIcon = document.createElement("img");
  editIcon.setAttribute("data-id", personalBlockId);
  editIcon.setAttribute("src", "/assets/images/edit-icon.svg");
  editIcon.setAttribute("alt", "edit-icon");
  editButton.appendChild(editIcon);
  editButton.addEventListener("click", (e) => {
    showModal();
    setData(e.target);
  });

  const deleteButton = document.createElement("a");
  deleteButton.setAttribute("data-id", personalBlockId);
  deleteButton.className =
    "personal-blocks-buttons__button personal-blocks-buttons__button--delete";
  const deleteIcon = document.createElement("img");
  deleteIcon.setAttribute("data-id", personalBlockId);
  deleteIcon.setAttribute("src", "/assets/images/delete-icon.svg");
  deleteIcon.setAttribute("alt", "delete-icon");
  deleteButton.appendChild(deleteIcon);
  deleteButton.addEventListener("click", (e) => {
    deletePersonalBlock(e);
  });

  personalBlocksButtonsContainer.appendChild(editButton);
  personalBlocksButtonsContainer.appendChild(deleteButton);
  div.appendChild(personalBlocksButtonsContainer);

  container.appendChild(div);
  swiper.update();
  resetData();
}

function updateElementPersonalBlock({ personalBlockId, title, description }) {
  const element = document.querySelector(`#block-${personalBlockId}`);
  element.querySelector(".personal-blocks__title").textContent = title;
  element.querySelector(".personal-blocks__text").textContent = description;

  resetData();
}

function createAlert(type, title, message) {
  Swal.fire({
    html: `<h1 class="sweet__logo">Art Zone</h1>
            <h2 class="sweet__title sweet__title--${type}">${title}</h2>
            <p class="sweet__text">${message}<p>
        `,
    confirmButtonText: "De Acuerdo",
  });
}

function createCarrusel() {
  const { length: elements } = document.querySelectorAll(
    ".personal-blocks__block"
  );

  swiper = new Swiper(".personal-blocks", {
    el: ".personal-block-wrapper",
    slideClass: "personal-blocks__block",
    createElements: true,
    autoplay: {
      delay: 5000,
    },
    loop: true,
    modules: [Navigation, Pagination, Autoplay],
    navigation: true,
    pagination: true,
    spaceBetween: 20,
    breakpoints: {
      768: {
        slidesPerView: elements >= 2 ? 2 : "auto",
      },
    },
  });
}

function resetData() {
  personalBlock = { title: "", description: "", id: 0 };
}
