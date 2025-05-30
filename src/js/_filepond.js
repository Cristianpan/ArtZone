import * as FilePond from "filepond";

import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
import FilePondPluginFileEncode from "filepond-plugin-file-encode";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';


FilePond.registerPlugin(
  FilePondPluginFileEncode,
  FilePondPluginImageValidateSize,
  FilePondPluginImageExifOrientation,
  FilePondPluginImagePreview,
  FilePondPluginFileValidateType,
  FilePondPluginFileValidateSize,
  FilePondPluginImageCrop
);

export function createPond(input, config, name) {
  const pond = FilePond.create(input, {
    imagePreviewHeight: 240,
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
    labelFileTypeNotAllowed: "Archivo no valido",
    fileValidateTypeLabelExpectedTypes: `Se espera {allTypes}`,
    chunkUploads: true,
    chunkSize: 1000000,
    ...config,
    server: getServerOptions(name),

  });

  return pond;
}

function getServerOptions(nameInput, baseUrl = "/api/files") {
  return {
    url: baseUrl,
    process: {
      url: "/process",
      method: "POST",
      headers: {
        input: nameInput,
      },
      onload: (response) => {
        const result =
          response instanceof XMLHttpRequest
            ? JSON.parse(response.responseText)
            : JSON.parse(response);
        return result.key;
      },
    },
    patch: {
      url: "/process?patch=",
      headers: {
        input: nameInput,
      },
    },
    restore: "/restore?file=",
    revert: "/delete",
    load: "/load?file=",
    remove: (source, load) => {
      addFileToDelete(nameInput, source);
      load();
    },
  };
}

function addFileToDelete(nameInput, source) {
  const deleteFileContainer = document.querySelector(`#delete-${nameInput}`);
  const fileToDelete = document.createElement("INPUT");
  fileToDelete.name = `delete-${nameInput}[]`;
  fileToDelete.type = "hidden";
  fileToDelete.value = source;
  deleteFileContainer.appendChild(fileToDelete);
}
