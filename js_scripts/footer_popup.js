class FooterPopup {
    constructor() {
        this.popup = document.getElementById('footer-text-popup');
    }

    show = () => {
        this.popup.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    hide = () => {
        this.popup.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

const footer_popup = new FooterPopup();