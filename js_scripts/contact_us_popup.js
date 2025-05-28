class ContactUsPopup {
    constructor() {
        this.wrapper = document.getElementById('contact-us-background')
        this.popup_contact_us = document.getElementById('contact-us-popup')

        this.contact_us_name = document.getElementById('contact-us-name')
        this.contact_us_email = document.getElementById('contact-us-email')
        this.contact_us_subject = document.getElementById('contact-us-subject')
        this.contact_us_message = document.getElementById('contact-us-message')
        this.contact_us_form = document.getElementById('contact-us-form')

        this.name = ""
        this.email = ""
        this.mailto = ""
        this.subject = ""
        this.message = ""
        this.send_copy = false
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

    update_name = () => {
        this.name = this.contact_us_name.value;
        this.submit();
        console.log("Name:", this.name)
    }
    update_email = () => {
        this.email = this.contact_us_email.value;
        this.submit();
        console.log("Email:", this.email)
    }
    update_subject = () => {
        this.subject = this.contact_us_subject.value;
        this.submit();
        console.log("Subject:", this.subject)
    }
    update_message = () => {
        this.message = this.contact_us_message.value;
        this.submit();
        console.log("Message:", this.message)
    }

    checked = () => {
        this.send_copy = !this.send_copy;
    }

    submit = () => {
        /*
        $.ajax({
            url: '/email-service',
            method: "POST",
            data: {subject: this.subject, message: this.message},
        })
        */

        var link = `mailto:${this.mailto}?cc=${this.email}&subject=${toString(this.subject)}&body=${toString(this.message)}`

        this.contact_us_form.action = link;

        if (this.send_copy) {
            this.send_copy_to_me();
        }
    }

    send_copy_to_me = () => {
        var link = "mailto:" + this.email
            + "?cc=" + this.email
            + "&subject=" + this.subject
            + "&body=" + this.message

        this.contact_us_form.action = link;
    }
}

const contact_us_popup = new ContactUsPopup();