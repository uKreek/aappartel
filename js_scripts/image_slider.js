class Slider {
    constructor() {
        this.currentIndex = 0; // начинаем с первого слайда
        this.slides = document.querySelectorAll('.top-img-slide');
        //this.buttons = document.querySelectorAll('.slider-button');

        this.init();
    }

    init() {
        //this.addEventListeners();
        this.startAutoSlide();
        this.updateActiveButton();
    }

    // добавление листенеров для кнопок
    // addEventListeners() {
    //     this.buttons.forEach(button => {
    //         button.addEventListener('click', () => {
    //             const index = parseInt(button.getAttribute('data-index'));
    //             this.changeSlide(index);
    //         });
    //     });
    // }

    // зменение текущего изображения по индексу
    changeSlide(index) {
        this.currentIndex = index; // переход к следующему слайду
        const offset = -this.currentIndex * 100; // смещение для слайдов
        for (let i = 0; i < this.slides.length; i++) {
            this.slides[i].style.transform = `translateX(${offset}%)`;
        }
        this.updateActiveButton();
    }

    // выделяет кнопку, соответствующую картинке по индексу
    // updateActiveButton() {
    //     this.buttons.forEach((button, i) => {
    //         if (i === this.currentIndex) {
    //             button.classList.add('active');
    //         } else {
    //             button.classList.remove('active');
    //         }
    //     });
    // }

    // автоматическая прокрутка картинок
    startAutoSlide() {
        setInterval(() => {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length; // Переход к следующему слайду
            this.changeSlide(this.currentIndex);
        }, 5000);
    }
}

const image_slider = new Slider();

document.addEventListener('DOMContentLoaded', function() {
    image_slider;
});