document.addEventListener('DOMContentLoaded', function() {
    let currentIndex = 0;
    const slide = document.querySelector('#top_img'); // Используем querySelector для одного элемента

    const images = [
        "./apartments/apartment/0.jpg",
        "./apartments/apartment-family/apart0.jpg",
        "./apartments/apartment-raum/0.jpg"
    ];

    function showSlide(index) {
        slide.style.backgroundImage = `url(${images[index]})`;
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length; // Изменено на images.length
        showSlide(currentIndex);
    }

    // Инициализация слайдов
    showSlide(currentIndex);
    // Переключение изображений каждые 3 секунды
    setInterval(nextSlide, 3000);
});

