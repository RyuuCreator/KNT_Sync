import { Flipper, spring } from 'flip-toolkit';

/**
 * @property {HTMLElement} content
 * @property {HTMLFormElement} form
 */
export default class FilterSearch {
	/**
	 * @param {HTMLElement|null} element
	 */
	constructor(element) {
        if (element === null) {
			return;
		}

		if (element.querySelector('.js-filter-form-search') != null) {
			this.content = element.querySelector('.js-filter-content');
			this.form = element.querySelector('.js-filter-form-search');
			this.bindEvents();
		}
	}

	/**
	 * Ajoute les comportements aux différents éléments
	 */
	bindEvents() {
		this.form.querySelector('input').addEventListener('keyup', this.loadForm.bind(this));
	}

	async loadForm() {
		const data = new FormData(this.form);
		const url = new URL(this.form.getAttribute('action') || window.location.href);
		const params = new URLSearchParams();
		data.forEach((value, key) => {
			params.append(key, value);
		});
		return this.loadUrl(url.pathname + '?' + params.toString());
	}

	async loadUrl(url, append = false) {
		this.showLoader();
		const params = new URLSearchParams(url.split('?')[1] || '');
		params.set('ajax', 1);
		const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
			},
		});
		if (response.status >= 200 && response.status < 300) {
			const data = await response.json();
			this.flipContent(data.content, append);
            params.delete('ajax');
            history.replaceState({}, '', url.split('?')[0] + '?' + params.toString());
		} else {
			console.error(response);
		}
		this.hideLoader();
	}

	showLoader() {
		// Code à écrire
	}

	hideLoader() {
		// Code à écrire
	}

	/**
	 * Remplace les éléments de la grille avec un effet d'animation flip
	 * @param {string} content
	 * @param {boolean} append le contenu doit être ajouté ou remplacé ?
	 */
	flipContent(content, append) {
		const springConfig = 'gentle';
		const exitSpring = function (element, index, onComplete) {
			spring({
				config: 'stiff',
				values: {
					translateY: [0, -20],
					opacity: [1, 0],
				},
				onUpdate: ({ translateY, opacity }) => {
					element.style.opacity = opacity;
					element.style.transform = `translateY(${translateY}px)`;
				},
				onComplete,
			});
		};
		const appearSpring = function (element, index) {
			spring({
				config: 'stiff',
				values: {
					translateY: [20, 0],
					opacity: [0, 1],
				},
				onUpdate: ({ translateY, opacity }) => {
					element.style.opacity = opacity;
					element.style.transform = `translateY(${translateY}px)`;
				},
				delay: index * 20,
			});
		};
		const flipper = new Flipper({
			element: this.content,
		});
		[...this.content.children].forEach((element) => {
			flipper.addFlipped({
				element,
				spring: springConfig,
				flipId: element.id,
				shouldFlip: false,
				onExit: exitSpring,
			});
		});
		flipper.recordBeforeUpdate();
		if (append) {
			this.content.innerHTML += content;
		} else {
			this.content.innerHTML = content;
		}
		[...this.content.children].forEach((element) => {
			flipper.addFlipped({
				element,
				spring: springConfig,
				flipId: element.id,
				onAppear: appearSpring,
			});
		});
		flipper.update();
	}
}
