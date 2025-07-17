const galerieImage = document.getElementById("allImages");

let titre = 'https://app.studi.fr/v3/medialibrary/lib';
let imgSource = "/assets/images/galerie1.jpg";

let monImage = getImage(titre, imgSource);

// ✅ Añadir sin reemplazar el contenido existente
galerieImage.innerHTML += monImage;
// Alternativamente (más seguro):
// galerieImage.insertAdjacentHTML("beforeend", monImage);



function getImage(titre, urlImage){
    titre = sanitizeHtml(titre);
    urlImage = sanitizeHtml(urlImage);
 

   return `
    <div class="col-6 col-lg-4">
      <div class="image-card text-white">
        <img src="${urlImage}" alt="${titre}" class="galerie-img" />
        <div class="titre-image">${titre}</div>
        <div class="action-image-buttons" data-show="admin">
          <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#EditionPhotoModal">
            <i class="bi bi-pencil-square"></i>
          </button>
          <button type="button" class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#DeletePhotoModal">
            <i class="bi bi-trash"></i>
          </button>
        </div>
      </div>
    </div>
  `;
}