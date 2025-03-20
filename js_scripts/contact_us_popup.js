class ContactUsPopup {
    constructor() {
        this.wrapper = document.getElementById('contact-us-background')
        this.popup_contact_us = document.getElementById('contact-us-popup')
    }

    show_contact_us = () => {
        this.wrapper.style.display = 'flex';
        this.popup_contact_us.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    hide_contact_us = () => {
        this.wrapper.style.display = 'none';
        this.popup_contact_us.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

const contact_us_popup = new ContactUsPopup();