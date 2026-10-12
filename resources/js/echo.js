import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
Pusher.logToConsole = true;

const echoConfig = {
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
};

if (import.meta.env.VITE_PUSHER_HOST) {
    echoConfig.wsHost = import.meta.env.VITE_PUSHER_HOST;
    echoConfig.wsPort = import.meta.env.VITE_PUSHER_PORT ?? 80;
    echoConfig.wssPort = import.meta.env.VITE_PUSHER_PORT ?? 443;
    echoConfig.enabledTransports = ['ws', 'wss'];
}

window.Echo = new Echo(echoConfig);

