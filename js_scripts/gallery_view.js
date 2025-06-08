// esc_url($gall_url)
class GalleryPopup {
    constructor() {
        this.popup = document.getElementById('gallery-popup-wrapper');
        this.image = document.getElementById('gallery-popup-image');
    }

    show = (uri) => {
        this.popup.style.display = 'flex';
        this.image.style.display = 'flex';
        this.image.setAttribute('src', uri);
    }

    hide = () => {
        this.popup.style.display = 'none';
        this.image.style.display = 'none';
    }
}

const gallery_popup = new GalleryPopup();