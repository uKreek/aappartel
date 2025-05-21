class Slider {
    constructor() {
        this.currentIndex = 0;
        this.slides = document.querySelectorAll('.landing-image-slide');
        //this.buttons = document.querySelectorAll('.slider-button');

        this.init();
    }

    init() {
        //this.addEventListeners();
        this.startAutoSlide();
        //this.updateActiveButton();
    }

    /*
    adding listeners for buttons
    addEventListeners() {
        this.buttons.forEach(button => {
            button.addEventListener('click', () => {
                const index = parseInt(button.getAttribute('data-index'));
                this.changeSlide(index);
            });
        });
    }
    */

    // changing current image by index
    changeSlide(index) {
        this.currentIndex = index;

        const offset = -this.currentIndex * 100;
        for (let i = 0; i < this.slides.length; i++) {
            this.slides[i].style.transform = `translateX(${offset}%)`;
        }
        //this.updateActiveButton();
    }

    /*
    selects the button corresponding to the image by index
    updateActiveButton() {
        this.buttons.forEach((button, i) => {
            if (i === this.currentIndex) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });
    }
    */

    // automatic scrolling of pictures
    startAutoSlide() {
        setInterval(() => {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length; // Переход к следующему слайду
            this.changeSlide(this.currentIndex);
        }, 5000);
    }
}

const image_slider = new Slider();

document.addEventListener('DOMContentLoaded', function () {
    image_slider;
});