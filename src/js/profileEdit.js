import { createPond } from "./_filepond";

document.addEventListener("DOMContentLoaded", initPage);
function initPage() {
  createFiles();
}

function createFiles() {
  const imageBackground = createPond(
    document.querySelector("#imageBackground"),
    JSON.parse(document.querySelector("#imageBackgroundConfig").value),
    "imageBackground"
  );
  imageBackground.labelIdle =
  'Arrastra y suelta tu foto de portada o <u style="cursor:pointer;">Selecciona</u>';
  imageBackground.imageCropAspectRatio = "18:9";
  imageBackground.stylePanelLayout = "integrated"

  const imageProfile = createPond(
    document.querySelector("#imageProfile"),
    JSON.parse(document.querySelector("#imageProfileConfig").value),
    "imageProfile"
  );
  imageProfile.stylePanelLayout = "integrated circle";
  imageProfile.imageCropAspectRatio = "1:1";
  imageProfile.labelIdle =
    'Arrastra y suelta tu foto de perfil o <u style="cursor:pointer;">Selecciona</u>';
}
