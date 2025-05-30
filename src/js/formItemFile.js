import { createPond } from "./_filepond";
import Swal from "sweetalert2";

document.addEventListener("DOMContentLoaded", initPage);

function initPage() {
  createFiles();
  document
    .querySelector(".buttons__button--delete")
    .addEventListener("click", askToDelete);
}

function createFiles() {
  const artItemFiles = createPond(
    document.querySelector("#artItemFile"),
    JSON.parse(document.querySelector("#artItemFilesConfig").value),
    "artItemFile"
  );

  artItemFiles.imagePreviewHeight = 500;
  artItemFiles.stylePanelLayout = "integrated";
  artItemFiles.labelIdle =
    'Arrastra y suelta una foto para tu obra o <u style="cursor:pointer;">Selecciona</u>';
}

async function askToDelete(e) {
  e.preventDefault();
  const confirm = await Swal.fire({
    html: `<h1 class="sweet__logo">Art Zone</h1>
      <h2 class="sweet__title sweet__title--success">Eliminar Obra</h2>
      <p class="sweet__text">¿Está seguro de eliminar esta obra? Está acción no se podrá deshacer<p>
      `,
    showCancelButton: true,
    cancelButtonText: "Cancelar",
    confirmButtonText: "De Acuerdo",
  });

  if (confirm.isConfirmed) {
    window.location.href = e.target.href;
  }
}
