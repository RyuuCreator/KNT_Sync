
// Sets variables 
const carouselSlideCat = document.querySelector('.container-content-category');
const carouselCat = document.querySelectorAll('.container-content-category .content-category');
const carouselSlideAmb = document.querySelector('.container-content-ambiance');
const carouselAmb = document.querySelectorAll('.container-content-ambiance .content-ambiance');

const prevBtnCat = document.querySelector('#previous-cat');
const nextBtnCat = document.querySelector('#next-cat');
const prevBtnAmb = document.querySelector('#previous-amb');
const nextBtnAmb = document.querySelector('#next-amb');

let counterCat = 0;
let counterAmb = 0;
const sizeCat = carouselCat[0].clientWidth;
const sizeAmb = carouselCat[0].clientWidth;
carouselSlideCat.style.transform = 'translateX(' + -sizeCat * counterCat + 'px)';
carouselSlideAmb.style.transform = 'translateX(' + -sizeAmb * counterAmb + 'px)';

// FUNCTIONS

nextBtnCat.addEventListener('click', function () {
	if (counterCat >= carouselCat.length - 1) return;
    carouselSlideCat.style.transition = 'transform 0.4s ease-in-out';
    counterCat++;
    carouselSlideCat.style.transform = 'translateX(' + -sizeCat * counterCat + 'px)';
});

nextBtnAmb.addEventListener('click', function () {
	if (counterAmb >= carouselAmb.length - 1) return;
    carouselSlideAmb.style.transition = 'transform 0.4s ease-in-out';
    counterAmb++;
    carouselSlideAmb.style.transform = 'translateX(' + -sizeAmb * counterAmb + 'px)';
});

prevBtnCat.addEventListener('click', () => {
	if (counterCat <= 0) return;
	carouselSlideCat.style.transition = 'transform 0.4s ease-in-out';
	counterCat--;
	carouselSlideCat.style.transform = 'translateX(' + -sizeCat * counterCat + 'px)';
});

prevBtnAmb.addEventListener('click', () => {
	if (counterAmb <= 0) return;
	carouselSlideAmb.style.transition = 'transform 0.4s ease-in-out';
	counterAmb--;
	carouselSlideAmb.style.transform = 'translateX(' + -sizeAmb * counterAmb + 'px)';
});

carouselSlideCat.addEventListener('transitionend', () => {
	if (carouselCat[counterCat].id === 'lastClone') {
		carouselSlideCat.style.transition = 'none';
		counterCat = carouselCat.length - 2;
		carouselSlideCat.style.transform = 'translateX(' + -sizeCat * counterCat + 'px)';
	}
	if (carouselCat[counterCat].id === 'firstClone') {
		carouselSlideCat.style.transition = 'none';
		counterCat = carouselCat.length - counterCat;
		carouselSlideCat.style.transform = 'translateX(' + -sizeCat * counterCat + 'px)';
	}
});

carouselSlideAmb.addEventListener('transitionend', () => {
	if (carouselAmb[counterAmb].id === 'lastClone') {
		carouselSlideAmb.style.transition = 'none';
		counterAmb = carouselAmb.length - 2;
		carouselSlideAmb.style.transform = 'translateX(' + -sizeAmb * counterAmb + 'px)';
	}
	if (carouselAmb[counterAmb].id === 'firstClone') {
		carouselSlideAmb.style.transition = 'none';
		counterAmb = carouselAmb.length - counterAmb;
		carouselSlideAmb.style.transform = 'translateX(' + -sizeAmb * counterAmb + 'px)';
	}
});