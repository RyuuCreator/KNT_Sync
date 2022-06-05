// apercu image - text in add - edit 

const categoryH1 = document.getElementById("category_label");
const ambianceH1 = document.getElementById("ambiance_label");
const readerImg = new FileReader();
const fileInputCategory = document.getElementById("category_picture");
const fileInputAmbiance = document.getElementById("ambiance_picture");
const fileInputResource = document.getElementById("resource_cover");

if (categoryH1) {
    categoryH1.addEventListener('change', e => {
        const h1 = e.target.value;
        document.getElementById("input-label").innerText = h1;
    })
} else if (ambianceH1) {
    ambianceH1.addEventListener('change', e => {
        const h1 = e.target.value;
        document.getElementById("input-label").innerText = h1;
    })
}

readerImg.onload = e => {
    img.src = e.target.result;
}

if (fileInputCategory) {
    fileInputCategory.addEventListener('change', e => {
        const picture = e.target.files[0];
        readerImg.readAsDataURL(picture);
    })
} else if (fileInputAmbiance) {
    fileInputAmbiance.addEventListener('change', e => {
        const picture = e.target.files[0];
        readerImg.readAsDataURL(picture);
    })
} else if (fileInputResource) {
    fileInputResource.addEventListener('change', e => {
        const cover = e.target.files[0];
        readerImg.readAsDataURL(cover);
    })
}