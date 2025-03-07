aparts = {
	"apart0": ["./apartments/apartment/0.jpg", "./apartments/apartment/1.jpg", "./apartments/apartment/2.jpg", "./apartments/apartment/3.jpg", "./apartments/apartment/4.jpg"],
	"apart1": ["./apartments/apartment-raum/o.jpg"],
	"apart2": ["./apartments/apartment-family/apart0.jpg", "./apartments/apartment-family/apart0.jpg"]
}
images = aparts["apart0"];

// анимация для линий
(function () {
	var rects = document.querySelectorAll('.tittle-line');

	for (let i = 0; i < rects.length; i++){

		var observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {

				if (entry.isIntersecting) {
					entry.target.style.width = '130px';
				}
			});
		});

		observer.observe(rects[i]);
	}

})();

// анимация для текста артиклей
(function () {
	var rects = document.querySelectorAll('.tittle, #contact-map');

	for (let i = 0; i < rects.length; i++){

		var observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {

				if (entry.isIntersecting) {
					entry.target.style.scale = '1 1';
				}
			});
		});

		observer.observe(rects[i]);
	}

})();
