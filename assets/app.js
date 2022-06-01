/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import '@fortawesome/fontawesome-free/css/all.min.css';

// start the Stimulus application
import './bootstrap';
import '@fortawesome/fontawesome-free/js/all.js';

// carousel

window.onload = function() {

    let slider = document.querySelector('#slider');
    let moveLi = Array.from(document.querySelectorAll('#slider #move li'));
    let forword = document.querySelector('#slider #forword');
    let back = document.querySelector('#slider #back');
    let counter = 1;
    let time = 12000;
    let line = document.querySelector('#slider #line');
    let dots = document.querySelector('#slider #dots');
    let dot;

    for (let i = 0; i < moveLi.length; i++) {
        dot = document.createElement('li');
        dots.appendChild(dot);
        dot.value = i;
    }

    dot = dots.getElementsByTagName('li');

    line.style.animation = 'line ' + (time / 1000) + 's linear infinite';
    dot[0].classList.add('active');

    function moveUP() {
        if (counter == moveLi.length) {
            moveLi[0].style.marginLeft = '0%';
            counter = 1;

        } else if (counter >= 1) {
            moveLi[0].style.marginLeft = '-' + counter * 100 + '%';
            counter++;
        } 

        if (counter == 1) {
            dot[moveLi.length - 1].classList.remove('active');
            dot[0].classList.add('active');

        } else if (counter > 1) {
            dot[counter - 2].classList.remove('active');
            dot[counter - 1].classList.add('active');
        }
    }

    function moveDOWN() {

        if (counter == 1) {
            moveLi[0].style.marginLeft = '-' + (moveLi.length - 1) * 100 + '%';
            counter = moveLi.length;
            dot[0].classList.remove('active');
            dot[moveLi.length - 1].classList.add('active');

        } else if (counter <= moveLi.length) {
            counter = counter - 2;
            moveLi[0].style.marginLeft = '-' + counter * 100 + '%';   
            counter++;

            dot[counter].classList.remove('active');
            dot[counter - 1].classList.add('active');
        }  
    }

    for (let i = 0; i < dot.length; i++) {

        dot[i].addEventListener('click', function(e) {
            dot[counter - 1].classList.remove('active');
            counter = e.target.value + 1;
            dot[e.target.value].classList.add('active');
            moveLi[0].style.marginLeft = '-' + (counter - 1) * 100 + '%';
        });
    }

    forword.onclick = moveUP;
    back.onclick = moveDOWN;

    let autoPlay = setInterval(moveUP, time);

    slider.onmouseover = function() {
        autoPlay = clearInterval(autoPlay);
        line.style.animation = '';
    }

    slider.onmouseout = function() {
        autoPlay = setInterval(moveUP, time);
        line.style.animation = 'line ' + (time / 1000) + 's linear infinite';
    }
}

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

// carousel filter category - ambiance

const $carouselCat = document.querySelector('.container-category');
const $seatsCat = document.querySelectorAll('.content-category');

const $carouselAmb = document.querySelector('.container-ambiance');
const $seatsAmb = document.querySelectorAll('.content-ambiance');
document.addEventListener("click", delegate(toggleFilter, toggleHandler));

// Common helper for event delegation.
function delegate(criteria, listener) {
    return function(e) {
        const el = e.target;
        do {
            if (!criteria(el)) {
                continue;
            }
            e.delegateTarget = el;
            listener.call(this, e);
            return;
        } while ((el = el.parentNode));
    };
}

// Custom filter to check for required DOM elements
function toggleFilter(elem) {
    return (elem instanceof HTMLElement) && elem.matches(".toggleCat");
    // OR
    // For < IE9
    // return elem.classList && elem.classList.contains('btn');
}

// Custom event handler function
function toggleHandler(e) {
    var $newSeat;
    const $el = document.querySelector('.is-ref');
    const $currSliderControl = e.delegateTarget;
    // Info: e.target is what triggers the event dispatcher to trigger and e.currentTarget is what you assigned your listener to.

    $el.classList.remove('is-ref');
    if ($currSliderControl.getAttribute('data-toggle') === 'next') {
        $newSeat = next($el);
        $carouselCat.classList.remove('is-reversing');
    } else {
        $newSeat = prev($el);
        $carouselCat.classList.add('is-reversing');
    }

    $newSeat.classList.add('is-ref');
    $newSeat.style.order = 1;
    for (var i = 2; i <= $seatsCat.length; i++) {
        $newSeat = next($newSeat);
        $newSeat.style.order = i;
    }

    $carouselCat.classList.remove('is-set');
    return setTimeout(function() {
        return $carouselCat.classList.add('is-set');
    }, 50);

    function next($el) {
        if ($el.nextElementSibling) {
            return $el.nextElementSibling;
        } else {
            return $carouselCat.firstElementChild;
        }
    }

    function prev($el) {
        if ($el.previousElementSibling) {
            return $el.previousElementSibling;
        } else {
            return $carouselCat.lastElementChild;
        }
    }
}





