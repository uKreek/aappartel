(function () {
    var rects = document.querySelectorAll('.title-line');

    for (let i = 0; i < rects.length; i++) {

        var observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {

                    if (entry.isIntersecting) {
                        entry.target.style.width = '130px';
                    }
                });
            }, {
                threshold: 1
            }
        );
        observer.observe(rects[i]);
    }
})();


(function () {
    var rects = document.querySelectorAll('.title, #contact-map');

    for (let i = 0; i < rects.length; i++) {

        var observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {

                if (entry.isIntersecting) {
                    entry.target.style.scale = '1 1';
                }
            });
        }, {
            threshold: 1
        });
        observer.observe(rects[i]);
    }

})();


let lastScrollY = window.scrollY;
const header = document.getElementsByTagName('header')[0];

window.addEventListener('scroll', () => {
    if (window.scrollY > lastScrollY && window.scrollY > header.offsetHeight) {
        header.classList.add('hidden-header');
    }
    else {
        header.classList.remove('hidden-header');
    }
    lastScrollY = window.scrollY;
})
