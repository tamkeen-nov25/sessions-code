<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-app.js";
    import {
        getMessaging,
        getToken,
        onMessage
    } from "https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging.js";

    const firebaseConfig = {

        apiKey: "AIzaSyA6eEtqfbKUPJq1ciX0zgv2Z0qp6paaEx8",
        authDomain: "e-commerce-8e065.firebaseapp.com",
        projectId: "e-commerce-8e065",
        storageBucket: "e-commerce-8e065.firebasestorage.app",
        messagingSenderId: "881645690401",
        appId: "1:881645690401:web:d0f1bdf65b68f158768d60"

    };

    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);

    Notification.requestPermission().then(permission => {
        if (permission === 'granted') {
            console.log('indise')
            getToken(messaging, {
                vapidKey: "BA2zfGTqbaxol7BU2L7t97cnPX6NGyjlvuzu_LkrHlLDLYZtC49wIgKaFf9lPkFN_I8JIFNw6Hd400p7qpzFAlA"
            }).then(token => {
                console.log('FCM Token:', token);

                fetch('/fcm/register-token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json', // 🔥 IMPORTANT
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            token
                        })
                    })
                    .then(async res => {
                        const text = await res.text(); // see raw response
                        console.log('RAW RESPONSE:', text);
                        return JSON.parse(text);
                    })
                    .then(data => console.log('OK:', data))
                    .catch(err => console.error('ERROR:', err));

            });
        } else {
            console.log('Permission not granted for notifications');
        }
    });

    // Foreground handler
    onMessage(messaging, payload => {
        console.log('FCM Foreground:', payload);

        // ✅ عرض notification في foreground
        if (Notification.permission === 'granted') {
            new Notification(payload.notification.title, {
                body: payload.notification.body,
                icon: '/logo.png'
            });
        }

        // (اختياري) event
        window.dispatchEvent(new CustomEvent('fcm-message', {
            detail: payload
        }));
    });

    navigator.serviceWorker.register('/firebase-messaging-sw.js')
        .then(registration => {
            console.log('SW registered');
        })
        .catch(err => console.error('SW failed', err));
</script>
