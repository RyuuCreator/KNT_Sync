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

// add js personalized
import FilterSearch from './js/filter-search';
import FilterCheck from './js/filter-check';

new FilterSearch(document.querySelector('.js-filter'));
new FilterCheck(document.querySelector('.js-filter'));

import './js/carousel';
import './js/previous';
import './js/slide-cat-amb';

// For toggling and finding number of children and other stuff is done here!

const navigation = document.getElementById("nav");
const menu = document.getElementById("menu");

menu.addEventListener("click", () => {
  // The navigation.children.length means the following :-
  // The children inside a parent are basically an array of elements; So, here I'm finding the length of the array aka how many children are inside the nav bar.
  //   Yup That's all.
    navigation.style.setProperty("--childenNumber", navigation.children.length);

  //    Casually Toggling Classes to make them animate on click
  //   Regular stuff ;)
    navigation.classList.toggle("active");
    menu.classList.toggle("active");
});
