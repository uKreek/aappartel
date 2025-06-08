class FooterPopup {
    constructor() {
        this.popup = document.getElementById('footer-text-popup');
    }

    show = () => {
        this.popup.style.display = 'flex';
    }

    hide = () => {
        this.popup.style.display = 'none';
    }
}

const footer_popup = new FooterPopup();