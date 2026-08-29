document.addEventListener('DOMContentLoaded', () => {
    initEcho();
    initForm();
});

function initEcho() {
    console.log('initEcho called');
    console.log('Echo:', window.Echo);

    if (!window.Echo) {
        console.error('Echo not ready');
        return;
    }

    window.Echo.channel('chat')
        .listen('.message.sent', (data) => {
            console.log('MESSAGE RECEIVED:', data);

            appendMessage(data.message);
        });
}

function initForm() {
    const form = document.getElementById('form');
    const input = document.getElementById('message');

    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const message = input.value.trim();

        if (!message) return;

        input.value = '';

        const response = await fetch('/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message }),
        });

        const data = await response.json();

        console.log('SEND RESPONSE:', data);
    });
}

function appendMessage(message) {
    const ul = document.getElementById('messages');

    if (!ul) return;

    const li = document.createElement('li');

    li.textContent = message;

    ul.prepend(li);
}