// apercu image - text in add - edit 

const categoryH1 = document.getElementById("category_label");
const ambianceH1 = document.getElementById("ambiance_label");

const resourceTrackname = document.getElementById("resource_trackname");
const resourceArtistname = document.getElementById("resource_artistname");
const resourceDescription = document.getElementById("resource_description");

const readerImg = new FileReader();
const fileInputCategory = document.getElementById("category_picture");
const fileInputAmbiance = document.getElementById("ambiance_picture");
const fileInputResource = document.getElementById("resource_cover");


/* preview des textes sur les ajouts / editions */

if (categoryH1) {
    categoryH1.addEventListener('keyup', e => {
        const h1 = e.target.value;
        document.getElementById("input-label").innerText = h1;
    })
}

if (ambianceH1) {
    ambianceH1.addEventListener('keyup', e => {
        const h1 = e.target.value;
        document.getElementById("input-label").innerText = h1;
    })
}

if (resourceTrackname) {
    resourceTrackname.addEventListener('keyup', e => {
        const h1 = e.target.value;
        document.getElementById("input-trackname").innerText = h1;
    })
}

if (resourceArtistname) {
    resourceArtistname.addEventListener('keyup', e => {
        const h2 = e.target.value;
        document.getElementById("input-artistname").innerText = h2;
    })
}

if (resourceDescription) {
    resourceDescription.addEventListener('keyup', e => {
        const p = e.target.value;
        document.getElementById("input-description").innerText = p;
    })
}

/* preview des images sur les ajouts / editions */

readerImg.onload = e => {
    img.src = e.target.result;
}

if (fileInputCategory) {
    fileInputCategory.addEventListener('change', e => {
        const picture = e.target.files[0];
        readerImg.readAsDataURL(picture);
    })
}

if (fileInputAmbiance) {
    fileInputAmbiance.addEventListener('change', e => {
        const picture = e.target.files[0];
        readerImg.readAsDataURL(picture);
    })
}

if (fileInputResource) {
    fileInputResource.addEventListener('change', e => {
        const cover = e.target.files[0];
        readerImg.readAsDataURL(cover);
    })
}