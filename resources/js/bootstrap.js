/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
window.BaseURL = 'http://127.0.0.1:8000/';
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'be54cbf1ddfcb66d423f',
    wsHost: window.location.hostname,
    cluster: 'mt1',
    wsPort: 6001,
    wssPort: 443,
    forceTLS: false,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});
