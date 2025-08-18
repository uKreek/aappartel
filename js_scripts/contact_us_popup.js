class ContactUsPopup {
    constructor() {
        this.wrapper = document.getElementById('contact-us-background');
        this.popup_contact_us = document.getElementById('contact-us-popup');
        this.contact_us_form = document.getElementById('contact-us-form');
        this.contact_us_message_div = document.getElementById('contact-us-message');
        this.contact_us_checkbox = document.getElementById('contact-us-checkbox');
        this.aappartel_email = 'ruslik2806@gmail.com'; // Замените на ваш email

        this.send_copy = false;

        // Привязка обработчика отправки формы
        this.contact_us_form.addEventListener('submit', this.submit.bind(this));
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
        this.contact_us_message_div.innerHTML = ''; // Очистка сообщений
    }

    checked = () => {
        this.send_copy = this.contact_us_checkbox.checked;
        console.log("Send copy:", this.send_copy);
    }

    submit = (event) => {
        event.preventDefault();

        const data = {
            action: 'send_contact_form',
            nonce: contact_form_vars.nonce,
            contact_name: document.getElementById('contact-us-name').value,
            contact_email: document.getElementById('contact-us-email').value,
            contact_subject: document.getElementById('contact-us-subject').value,
            contact_message: document.getElementById('contact-us-message').value,
            send_copy: this.contact_us_checkbox.checked ? '1' : '0'
        };

        console.log('Sending data:', data); // Отладка: что отправляется

        this.contact_us_message_div.innerHTML = '<p style="color: #2A2722;">Sending...</p>';

        fetch(contact_form_vars.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(data)
        })
            .then(response => {
                console.log('Response status:', response.status); // Отладка статуса
                return response.json();
            })
            .then(data => {
                console.log('Server response:', data); // Отладка ответа сервера
                if (data.success) {
                    this.contact_us_message_div.innerHTML = '<p style="color: green;">Thank you! Your message has been sent.</p>';
                    this.contact_us_form.reset();
                    this.send_copy = false;
                    this.contact_us_checkbox.checked = false;
                    setTimeout(() => {
                        this.hide_contact_us();
                    }, 2000);
                } else {
                    this.contact_us_message_div.innerHTML = '<p style="color: red;">Error: ' + (data.data.message || 'Failed to send message.') + '</p>';
                }
            })
            .catch(error => {
                this.contact_us_message_div.innerHTML = '<p style="color: red;">Error: An unexpected error occurred.</p>';
                console.error('Fetch Error:', error); // Отладка ошибок сети
            });
    }
}

const contact_us_popup = new ContactUsPopup();