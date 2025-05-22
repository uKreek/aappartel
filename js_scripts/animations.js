(function () {
    var rects = document.querySelectorAll('.tittle-line');

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
    var rects = document.querySelectorAll('.tittle, #contact-map');

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
