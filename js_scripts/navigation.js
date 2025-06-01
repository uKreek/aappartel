class Navigation {
    constructor() {
        this.nav_container = document.getElementById('nav_container');
        this.btn = document.getElementById('slider-top-image');
    }

    show_navigation = () => {
        this.nav_container.style.display = 'flex';
    }

    hide_navigation = () => {
        this.nav_container.style.display = 'none';
    }
}

const navigation = new Navigation();